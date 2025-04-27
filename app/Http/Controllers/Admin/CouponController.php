<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Coupon\UpdateCouponRequest;
use App\Http\Requests\Coupon\CreateCouponRequest;
use App\Models\Attribute;
use App\Models\Category;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view_coupons|add_coupons', ['only' => ['index','store']]);
        $this->middleware('permission:add_coupons', ['only' => ['create','store']]);
        $this->middleware('permission:edit_coupons', ['only' => ['edit','update']]);
        $this->middleware('permission:delete_coupons', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.coupons.index');
    }

    public function datatable(Request $request) 
    {
        $items = Coupon::query()->orderBy('id', 'DESC')->search($request); 
        return $this->filterDataTable($items, $request);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['discount_types'] = Coupon::DISCOUNT_TYPES;
        return view('admin.coupons.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCouponRequest $request)
    {            
        try {
            Coupon::create($request->validated());
            return $this->response_api(200, __('admin.form.added_successfully'), '');
        } catch (\Exception $e) {
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
        $data['coupon'] = Coupon::findOrFail($id);
        $data['discount_types'] = Coupon::DISCOUNT_TYPES;
        return view('admin.coupons.create', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCouponRequest $request, $id)
    {
        try {    
            $coupon = Coupon::findOrFail($id);
            $coupon->update($request->validated());
            return $this->response_api(200, __('admin.form.updated_successfully'), '');
        } catch (\Exception $e) {
            return $this->response_api(404, $this->exMessage($e));
        }
    }

    public function activate($id)
    {
        $item = Coupon::findOrFail($id);
        if (empty($item)) {
            return $this->response_api(400, __('admin.form.not_existed'), '');
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
        Coupon::destroy($id);
        return $this->response_api(200, __('admin.form.deleted_successfully'), '');
    }


    public function bluckDestroy(Request $request) 
    {
        $ids = $request->id;
        foreach ($ids as $row) {
            $item = Coupon::find($row);
            if(!$item) {
                return $this->response_api(404 ,  __('admin.form.not_existed') , '');
            }
            $item->delete();
        }
        return $this->response_api(200 ,  __('admin.form.deleted_successfully') , '');
    }
}
