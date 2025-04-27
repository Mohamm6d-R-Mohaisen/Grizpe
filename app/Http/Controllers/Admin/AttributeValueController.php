<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AttributeValue\CreateAttributeValueRequest;
use App\Http\Requests\AttributeValue\UpdateAttributeValueRequest;
use App\Models\Attribute;
use App\Models\AttributeValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AttributeValueController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view_attribute_values|add_attribute_values', ['only' => ['index','store']]);
        $this->middleware('permission:add_attribute_values', ['only' => ['create','store']]);
        $this->middleware('permission:edit_attribute_values', ['only' => ['edit','update']]);
        $this->middleware('permission:delete_attribute_values', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.attribute_values.index');
    }

    public function datatable(Request $request) 
    {
        $items = AttributeValue::query()->orderBy('id', 'DESC')->search($request); 
        return $this->filterDataTable($items, $request);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['attributes'] = Attribute::active()->get();
        return view('admin.attribute_values.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateAttributeValueRequest $request)
    { 
        $dataR = $request->only('status', 'attribute_id');
        $dataTrans = $request->only('name_ar', 'name_en', 'description_ar', 'description_ar');

        $dataR['slug'] = $this->generateAttributeValueSlug($request->name_en, $request->name_ar);

        try {
            DB::beginTransaction();
                $attribute_value = AttributeValue::create($dataR);
                $attribute_value->createTranslation($dataTrans);
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
        $data['attribute_value'] = AttributeValue::findOrFail($id);
        $data['attributes'] = Attribute::active()->get();
        return view('admin.attribute_values.create', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAttributeValueRequest $request, $id)
    {
        $dataR = $request->only('status', 'attribute_id');
        $dataTrans = $request->only('name_ar', 'name_en', 'description_ar', 'description_ar');

        try {
            DB::beginTransaction();
                $attribute_value = AttributeValue::findOrFail($id);
                $attribute_value->update($dataR);
                $attribute_value->createTranslation($dataTrans);
            DB::commit();
            return $this->response_api(200, __('admin.form.updated_successfully'), '');
        } catch (\Exception $e) {
            DB::rollback();
            return $this->response_api(400, $this->exMessage($e));
        }
    }

    public function activate($id)
    {
        $item = AttributeValue::findOrFail($id);
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
        AttributeValue::destroy($id);
        return $this->response_api(200 , __('admin.form.deleted_successfully'), '');
    }


    public function bluckDestroy(Request $request) 
    {
        $ids = $request->id;
        foreach ($ids as $row) {
            $item = AttributeValue::find($row);
            if(!$item) {
                return $this->response_api(400 ,  __('admin.form.not_existed') , '');
            }
            $item->delete();
        }
        return $this->response_api(200,  __('admin.form.deleted_successfully'), '');
    }

    function generateAttributeValueSlug(?string $name, ?string $alternative = null): string
    {
        if (empty($name)) {
            $name = $alternative;
        }

        if (empty($name)) {
            throw new \InvalidArgumentException("لم يتم توفير اسم صالح لتوليد الكود.");
        }

        $slug = Str::slug($name);

        if (empty($slug)) {
            $slug = substr(md5($name), 0, 8);
        }

        $originalSlug = $slug;
        $counter = 1;
        while (AttributeValue::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}
