<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Traits\SaveImageTrait;

class SliderController extends Controller
{
    use SaveImageTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.slider.index');
    }
    public function datatable(Request $request)
    {
        $items = Slider::query()->orderBy('id', )->search($request);
        return $this->filterDataTable($items, $request);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $dataR = $request->only('image', 'status');
        $dataTrans = $request->only('title_ar', 'title_en', 'description_ar', 'description_en' ,'type_ar','type_er');

        try {
            DB::beginTransaction();
            if (request()->has('image')) {
                $dataR['image'] = $this->uploadImage($request->image, 'sliders_images');

            }
            $slider = Slider::create($dataR);
            $slider->createTranslation($dataTrans);
            DB::commit();

            return $this->response_api(200, __('admin.form.added_successfully'), '');
        } catch (\Exception $e) {
            DB::rollback();
            return $this->response_api(400, $this->exMessage($e));
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $data['slider'] = Slider::findOrFail($id);
        return view('admin.slider.create', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $dataR = $request->only('image', 'status');
        $dataTrans = $request->only('title_ar', 'title_en', 'description_ar', 'description_en','type_ar','type_er');
        try {
            DB::beginTransaction();
            if (request()->has('image')) {
                $dataR['image'] = $this->uploadImage($request->image, 'adds_images');
            }


            $slider =Slider::findOrFail($id);
            $slider->update($dataR);
            $slider->createTranslation($dataTrans);
            DB::commit();

            return $this->response_api(200, __('admin.form.updated_successfully'), '');
        } catch (\Exception $e) {
            DB::rollback();
            return $this->response_api(400, $this->exMessage($e));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function activate($id)
    {
        $item = Slider::findOrFail($id);
        if (empty($item)) {
            return $this->response_api(400, __('admin.form.not_existed'), '');
        }
        if($item->status == 'inactive') {
            $item->status = 'active';
            $item->save();
        }elseif ($item->status == 'active') {
            $item->status = 'inactive';
            $item->save();
        }
        return $this->response_api(200,  __('admin.form.status_changed_successfully'), '');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        Slider::destroy($id);
        return $this->response_api(200, __('admin.form.deleted_successfully'), '');

    }
    public function bluckDestroy(Request $request)
    {
        $ids = $request->id;
        foreach ($ids as $row) {
            $item = Slider::find($row);
            if(!$item) {
                return $this->response_api(400 ,  __('admin.form.not_existed') , '');
            }
            $item->delete();
        }
        return $this->response_api(200 ,  __('admin.form.deleted_successfully') , '');
    }
}
