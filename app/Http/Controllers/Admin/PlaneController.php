<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plane;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlaneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('admin.plans.index');
    }
    public function datatable(Request $request)
    {
        $items = Plane::query()->orderBy('id', )->search($request);
        return $this->filterDataTable($items, $request);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.plans.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        $dataR = $request->only('type', 'price', 'status');
        $dataTrans = $request->only('title_ar', 'title_en', 'description_ar', 'description_en');
        $features = $request->input('features', []);

        try {
            DB::beginTransaction();

            // إنشاء الخطة
            $plan = Plane::create($dataR);

            // إضافة الترجمات للخطة
            $plan->createTranslation($dataTrans);

            // إضافة المميزات
            foreach ($features as $index => $feature) {
                $newFeature = $plan->features()->create([]);

                // إضافة الترجمات للميزة
                $newFeature->createTranslation([
                    'title_ar' => $feature['title_ar'] ?? '',
                    'title_en' => $feature['title_en'] ?? ''
                ]);
            }

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
    public function show( $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $data['plane'] = Plane::with('features')->findOrFail($id);
        return view('admin.plans.create',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        //
        $dataR = $request->only('type', 'price', 'status');
        $dataTrans = $request->only('title_ar', 'title_en', 'description_ar', 'description_en');
        $features = $request->input('features', []);

        try {
            DB::beginTransaction();

            $plan=Plane::findorfail($id);
            $plan->update($dataR);

            // تحديث الترجمات للخطة
            $plan->createTranslation($dataTrans);

            // حذف المميزات القديمة وإضافة مميزات جديدة
            $plan->features()->delete();
            foreach ($features as $index => $feature) {
                $newFeature = $plan->features()->create([]);

                // إضافة الترجمات للميزة الجديدة
                $newFeature->createTranslation([
                    'title_ar' => $feature['title_ar'] ?? '',
                    'title_en' => $feature['title_en'] ?? ''
                ]);
            }

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
        $item = Plane::findOrFail($id);
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
    public function destroy( $id)
    {
        //
        Plane::destroy($id);
        return $this->response_api(200, __('admin.form.deleted_successfully'), '');

    }
    public function bluckDestroy(Request $request)
    {
        $ids = $request->id;
        foreach ($ids as $row) {
            $item = Plane::find($row);
            if(!$item) {
                return $this->response_api(400 ,  __('admin.form.not_existed') , '');
            }
            $item->delete();
        }
        return $this->response_api(200 ,  __('admin.form.deleted_successfully') , '');
    }
}
