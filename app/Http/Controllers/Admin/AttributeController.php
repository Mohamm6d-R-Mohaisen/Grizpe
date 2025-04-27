<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Attribute\CreateAttributeRequest;
use App\Http\Requests\Attribute\UpdateAttributeRequest;
use App\Models\Attribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AttributeController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view_attributes|add_attributes', ['only' => ['index','store']]);
        $this->middleware('permission:add_attributes', ['only' => ['create','store']]);
        $this->middleware('permission:edit_attributes', ['only' => ['edit','update']]);
        $this->middleware('permission:delete_attributes', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.attributes.index');
    }

    public function datatable(Request $request) 
    {
        $items = Attribute::query()->orderBy('id', 'DESC')->search($request); 
        return $this->filterDataTable($items, $request);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.attributes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateAttributeRequest $request)
    { 
        $dataR = $request->only('status');
        $dataTrans = $request->only('name_ar', 'name_en', 'description_ar', 'description_ar');

        $dataR['slug'] = $this->generateAttributeSlug($request->name_en, $request->name_ar);

        try {
            DB::beginTransaction();
                $attribute = Attribute::create($dataR);
                $attribute->createTranslation($dataTrans);
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
        $data['attribute'] = Attribute::findOrFail($id);
        return view('admin.attributes.create', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAttributeRequest $request, $id)
    {
        $dataR = $request->only('status');
        $dataTrans = $request->only('name_ar', 'name_en', 'description_ar', 'description_ar');

        try {
            DB::beginTransaction();
                $attribute = Attribute::findOrFail($id);
                $attribute->update($dataR);
                $attribute->createTranslation($dataTrans);
            DB::commit();
            return $this->response_api(200, __('admin.form.updated_successfully'), '');
        } catch (\Exception $e) {
            DB::rollback();
            return $this->response_api(400, $this->exMessage($e));
        }
    }

    public function activate($id)
    {
        $item = Attribute::findOrFail($id);
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
        Attribute::destroy($id);
        return $this->response_api(200 , __('admin.form.deleted_successfully'), '');
    }


    public function bluckDestroy(Request $request) 
    {
        $ids = $request->id;
        foreach ($ids as $row) {
            $item = Attribute::find($row);
            if(!$item) {
                return $this->response_api(400 ,  __('admin.form.not_existed') , '');
            }
            $item->delete();
        }
        return $this->response_api(200,  __('admin.form.deleted_successfully'), '');
    }

    public function getAttributeValues($id)
    {
        $attribute = Attribute::find($id);
        $data['attribute_values'] = $attribute->attributeValues;
        return $this->response_api(200 , __('admin.form.success'), $data);
    }

    function generateAttributeSlug(?string $name, ?string $alternative = null): string
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
        while (Attribute::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}
