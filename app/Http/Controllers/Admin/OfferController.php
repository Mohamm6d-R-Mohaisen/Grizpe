<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Offer\UpdateOfferRequest;
use App\Http\Requests\Offer\CreateOfferRequest;
use App\Models\Category;
use App\Models\Offer;
use App\Models\Product;
use App\Models\ProductOffer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OfferController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view_offers|add_offers', ['only' => ['index','store']]);
        $this->middleware('permission:add_offers', ['only' => ['create','store']]);
        $this->middleware('permission:edit_offers', ['only' => ['edit','update']]);
        $this->middleware('permission:delete_offers', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.offers.index');
    }

    public function datatable(Request $request) 
    {
        $items = Offer::query()->orderBy('id', 'DESC')->search($request); 
        return $this->filterDataTable($items, $request);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['discount_types'] = Offer::DISCOUNT_TYPES;
        $data['products'] = Product::get();
        $data['categories'] = Category::get();
        return view('admin.offers.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateOfferRequest $request)
    {           
        $dataR = $request->only('discount_type', 'discount_value', 'start_date', 'end_date', 'status');
        $dataTrans = $request->only('name_ar', 'name_en', 'description_ar', 'description_en');

        try {
            DB::beginTransaction();
                $offer = Offer::create($dataR);
                $offer->createTranslation($dataTrans);
                $offer->categories()->attach($request->categories);

                foreach ($request->products as $product) {
                    $product = Product::find($product);
                    $price = $product->price;
                    $offer_price = $this->calculateOfferPrice($request->discount_type, $request->discount_value, $price);

                    $product->offer_price = $offer_price;
                    $product->save();
                    
                    ProductOffer::create([
                        'offer_id' => $offer->id,
                        'product_id' => $product->id,
                        'discount' => $offer_price,
                    ]); 
                }
            DB::commit();
            return $this->response_api(200, __('admin.form.added_successfully'), '');
        } catch (\Exception $e) {
            DB::rollback();
            return $this->response_api(404, $this->exMessage($e));
        }
    }

    public function calculateOfferPrice($discount_type,$discount_value, $price)
    {
        if ($discount_type === 'percentage') {
            return $price * ($discount_value / 100);
        } elseif ($discount_type === 'fixed') {
            return $price - $discount_value;
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
        $data['offer'] = Offer::findOrFail($id);
        $data['discount_types'] = Offer::DISCOUNT_TYPES;
        $data['products'] = Product::get();
        $data['categories'] = Category::get();
        return view('admin.offers.create', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOfferRequest $request, $id)
    {
        $dataR = $request->only('discount_type', 'discount_value', 'start_date', 'end_date', 'status');
        $dataTrans = $request->only('name_ar', 'name_en', 'description_ar', 'description_en');

        try {    
            DB::beginTransaction();
                $offer = Offer::findOrFail($id);
                $offer->update($dataR);
                $offer->createTranslation($dataTrans);
                $offer->categories()->sync($request->categories);
                
                $offer->products()->detach();
                foreach ($request->products as $product) {
                    $product = Product::find($product);
                    $price = $product->price;
                    $offer_price = $this->calculateOfferPrice($request->discount_type, $request->discount_value, $price);

                    $product->offer_price = $offer_price;
                    $product->save();

                    ProductOffer::create([
                        'offer_id' => $offer->id,
                        'product_id' => $product->id,
                        'discount' => $offer_price,
                    ]);
                }

            DB::commit();
            return $this->response_api(200, __('admin.form.updated_successfully'), '');
        } catch (\Exception $e) {
            DB::rollback();
            return $this->response_api(404, $this->exMessage($e));
        }
    }

    public function activate($id)
    {
        $item = Offer::findOrFail($id);
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
        $offer = Offer::findOrFail($id);

        foreach ($offer->products as $product) {
            $product->offer_price = 0;
            $product->save();
        }

        Offer::destroy($id);
        return $this->response_api(200, __('admin.form.deleted_successfully'), '');
    }


    // public function bluckDestroy(Request $request) 
    // {
    //     $ids = $request->id;
    //     foreach ($ids as $row) {
    //         $item = Offer::find($row);
    //         if(!$item) {
    //             return $this->response_api(404 ,  __('admin.form.not_existed') , '');
    //         }
    //         $item->delete();
    //     }
    //     return $this->response_api(200 ,  __('admin.form.deleted_successfully') , '');
    // }
}
