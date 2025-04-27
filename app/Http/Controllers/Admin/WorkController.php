<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Slider;
use App\Models\Work;
use App\Traits\SaveImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WorkController extends Controller
{
    use SaveImageTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('admin.works.index');
    }
    public function datatable(Request $request)
    {
        $items = Work::query()->orderBy('id', )->search($request);
        return $this->filterDataTable($items, $request);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $data['service']=Service::all();
        return view('admin.works.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // استقبال البيانات العامة والقابلة للترجمة
        $dataR = $request->only('image', 'status', 'price', 'service_id');
        $dataTrans = $request->only('title_ar', 'title_en', 'description_ar', 'description_en', 'location_ar', 'location_en', 'client_name_ar', 'client_name_en', 'overview_ar', 'overview_en');

        try {
            DB::beginTransaction();

            // تحميل الصورة إذا كانت موجودة
            if ($request->hasFile('image')) {
                $dataR['image'] = $this->uploadImage($request->file('image'), 'works_images');
            }


            // إنشاء العمل
            $work = Work::create($dataR);

            // إضافة الترجمات
            $work->createTranslation($dataTrans);

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
        $data['service']=Service::all();
        $data['work']=Work::findorfail($id);
        return view('admin.works.create',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        // استقبال البيانات العامة والقابلة للترجمة
        $dataR = $request->only('image', 'status', 'price', 'service_id');
        $dataTrans = $request->only('title_ar', 'title_en', 'description_ar', 'description_en', 'location_ar', 'location_en', 'client_name_ar', 'client_name_en', 'overview_ar', 'overview_en');

        try {
            DB::beginTransaction();

            // تحميل الصورة إذا كانت موجودة
            if ($request->hasFile('image')) {
                $dataR['image'] = $this->uploadImage($request->file('image'), 'works_images');
            }


            // إنشاء العمل
            $work = Work::findorfail($id);
            $work->update($dataR);
            // إضافة الترجمات
            $work->createTranslation($dataTrans);

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
    public function destroy(string $id)
    {
        //
    }
}
