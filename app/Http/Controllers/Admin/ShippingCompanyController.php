<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShippingCompany\CreateShippingCompanyRequest;
use App\Http\Requests\ShippingCompany\UpdateShippingCompanyRequest;
use App\Models\Product;
use App\Models\ShippingCompany;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShippingCompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view_shipping_companies|add_shipping_companies', ['only' => ['index','store']]);
        $this->middleware('permission:add_shipping_companies', ['only' => ['create','store']]);
        $this->middleware('permission:edit_shipping_companies', ['only' => ['edit','update']]);
        $this->middleware('permission:delete_shipping_companies', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.shipping_companies.index');
    }

    public function datatable(Request $request) 
    {
        $items = ShippingCompany::query()->orderBy('id', 'DESC')->search($request); 
        return $this->filterDataTable($items, $request);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.shipping_companies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateShippingCompanyRequest $request)
    {            
        $dataR = $request->only('cost', 'tracking_url', 'status');
        $dataTrans = $request->only('name_ar', 'name_en');

        try {
            DB::beginTransaction();
                $shipping_company = ShippingCompany::create($dataR);
                $shipping_company->createTranslation($dataTrans);
            DB::commit();
            return $this->response_api(200, __('admin.form.added_successfully'), '');
        } catch (\Exception $e) {
            DB::rollback();
            return $this->response_api(404, $this->exMessage($e));
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
        $data['shipping_company'] = ShippingCompany::findOrFail($id);
        return view('admin.shipping_companies.create', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateShippingCompanyRequest $request, $id)
    {
        $dataR = $request->only('cost', 'tracking_url', 'status');
        $dataTrans = $request->only('name_ar', 'name_en');

        try {    
            DB::beginTransaction();
                $shipping_company = ShippingCompany::findOrFail($id);
                $shipping_company->update($dataR);
                $shipping_company->createTranslation($dataTrans);
            DB::commit();
            return $this->response_api(200, __('admin.form.updated_successfully'), '');
        } catch (\Exception $e) {
            DB::rollback();
            return $this->response_api(404, $this->exMessage($e));
        }
    }

    public function activate($id)
    {
        $item = ShippingCompany::findOrFail($id);
        if (empty($item)) {
            return $this->response_api(404, __('admin.form.not_existed'), '');
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
        ShippingCompany::destroy($id);
        return $this->response_api(200, __('admin.form.deleted_successfully'), '');
    }
}
