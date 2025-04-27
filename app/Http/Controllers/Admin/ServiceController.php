<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galary;
use App\Models\Service;
use App\Models\Slider;
use App\Traits\SaveImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
{
    use SaveImageTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.service.index');
    }
    public function datatable(Request $request)
    {
        $items = Service::query()->orderBy('id', )->search($request);
        return $this->filterDataTable($items, $request);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.service.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $dataR = $request->only('image', 'status','icon');
        $dataTrans = $request->only('title_ar', 'title_en', 'description_ar', 'description_en' ,'short_description_ar', 'short_description_en');

        try {
            DB::beginTransaction();
            if (request()->has('image')) {
                $dataR['image'] = $this->uploadImage($request->image, 'service_images');

            }
            $slider = Service::create($dataR);
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
        $data['service']=Service::findorfail($id);
        return view('admin.service.create',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $dataR = $request->only('image', 'status','icon');
        $dataTrans = $request->only('title_ar', 'title_en', 'description_ar', 'description_en','short_description_ar', 'short_description_en');
        try {
            DB::beginTransaction();
            if (request()->has('image')) {
                $dataR['image'] = $this->uploadImage($request->image, 'serives_images');
            }


            $slider =Service::findOrFail($id);
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
        $item = Service::findOrFail($id);
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
        Service::destroy($id);
        return $this->response_api(200, __('admin.form.deleted_successfully'), '');

    }
    public function bluckDestroy(Request $request)
    {
        $ids = $request->id;
        foreach ($ids as $row) {
            $item = Service::find($row);
            if(!$item) {
                return $this->response_api(400 ,  __('admin.form.not_existed') , '');
            }
            $item->delete();
        }
        return $this->response_api(200 ,  __('admin.form.deleted_successfully') , '');
    }
}
