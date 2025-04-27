<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentGateway\CreatePaymentGatewayRequest;
use App\Http\Requests\PaymentGateway\UpdatePaymentGatewayRequest;
use App\Models\PaymentGateway;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentGatewayController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view_payment_gateways|add_payment_gateways', ['only' => ['index','store']]);
        $this->middleware('permission:add_payment_gateways', ['only' => ['create','store']]);
        $this->middleware('permission:edit_payment_gateways', ['only' => ['edit','update']]);
        $this->middleware('permission:delete_payment_gateways', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.payment_gateways.index');
    }

    public function datatable(Request $request) 
    {
        $items = PaymentGateway::query()->orderBy('id', 'DESC')->search($request);
        return $this->filterDataTable($items, $request);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $gateway = PaymentGateway::first();
        $data['credentials'] = json_decode(decrypt($gateway->credentials), true);
        return view('admin.payment_gateways.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePaymentGatewayRequest $request)
    {            
        $dataR = $request->only('status');
        $dataTrans = $request->only('name_ar', 'name_en', 'description_ar', 'description_en');

        try {
            DB::beginTransaction();
                $payment_gateway = PaymentGateway::create($dataR);
                $payment_gateway->credentials = encrypt(json_encode([
                    'STRIPE_KEY' => $request->STRIPE_KEY,
                    'STRIPE_SECRET' => $request->STRIPE_SECRET,
                ]));
                $payment_gateway->save();
                
                $payment_gateway->createTranslation($dataTrans);
            DB::commit();
    
            return $this->response_api(200, __('admin.form.added_successfully'), '');
        } catch (\Exception $e) {
            DB::rollback();
            return $this->response_api(400, $this->exMessage($e));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['payment_gateway'] = PaymentGateway::findOrFail($id);
        $gateway = PaymentGateway::first();
        $data['credentials'] = json_decode(decrypt($gateway->credentials), true);
        return view('admin.payment_gateways.create', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePaymentGatewayRequest $request, $id)
    {
        $dataR = $request->only('status');
        $dataTrans = $request->only('name_ar', 'name_en', 'description_ar', 'description_en');
    
        try {
            DB::beginTransaction();
    
            $payment_gateway = PaymentGateway::findOrFail($id);
            $payment_gateway->update($dataR);
            $payment_gateway->createTranslation($dataTrans);
    
            $payment_gateway->credentials = encrypt(json_encode([
                'STRIPE_KEY' => $request->STRIPE_KEY,
                'STRIPE_SECRET' => $request->STRIPE_SECRET,
            ]));
            $payment_gateway->save();
        
            DB::commit();
    
            return $this->response_api(200, __('admin.form.updated_successfully'), '');
        } catch (\Exception $e) {
            DB::rollback();
            return $this->response_api(400, $this->exMessage($e));
        }
    }

    public function activate($id)
    {
        $item = PaymentGateway::findOrFail($id);
        if (empty($item)) {
            return $this->response_api(200, __('admin.form.not_existed'), '');
        }
        $item->status = 1 - $item->status;
        $item->save();
        return $this->response_api(200,  __('admin.form.status_changed_successfully'), '');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        PaymentGateway::destroy($id);
        return $this->response_api(200, __('admin.form.deleted_successfully'), '');
    }


    public function bluckDestroy(Request $request) 
    {
        $ids = $request->id;
        foreach ($ids as $row) {
            $item = PaymentGateway::find($row);
            if(!$item) {
                return $this->response_api(400 ,  __('admin.form.not_existed') , '');
            }
            $item->delete();
        }
        return $this->response_api(200 ,  __('admin.form.deleted_successfully') , '');
    }
}
