<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\CreateOrderRequest;
use App\Http\Requests\Order\UpdateOrderRequest;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Services\CheckoutService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $checkoutService;

    public function __construct(CheckoutService $checkoutService)
    {
        $this->middleware('permission:view_orders|add_orders', ['only' => ['index','store']]);
        $this->middleware('permission:add_orders', ['only' => ['create','store']]);
        $this->middleware('permission:edit_orders', ['only' => ['edit','update']]);
        $this->middleware('permission:delete_orders', ['only' => ['destroy']]);
        $this->checkoutService = $checkoutService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.orders.index');
    }

    public function datatable(Request $request) 
    {
        $items = Order::query()->orderBy('id', 'DESC')->search($request);
        return $this->filterDataTable($items, $request);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['users'] = User::active()->get();
        $data['products'] = Product::active()->get();
        return view('admin.orders.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateOrderRequest $request)
    {           
        try {
            $order = $this->checkoutService->checkout($request->products_repeater, $request->user_id);
            return $this->response_api(200, __('admin.form.success'), $order);
        } catch (\Exception $e) {
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
        $data['order'] = Order::findOrFail($id);
        return view('admin.orders.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $data['order'] = Order::findOrFail($id);
        // $data['users'] = User::active()->get();
        // return view('admin.orders.create', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOrderRequest $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Order::destroy($id);
        return $this->response_api(200, __('admin.form.deleted_successfully'), '');
    }
}
