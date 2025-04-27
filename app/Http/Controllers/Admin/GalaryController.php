<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galary;
use App\Traits\SaveImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GalaryController extends Controller
{
    use SaveImageTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.galary.index');
    }
    public function datatable(Request $request)
    {
        $items = Galary::query()->orderBy('id', )->search($request);
        return $this->filterDataTable($items, $request);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.galary.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $dataR = $request->only('image', 'status','type','sub_type');

        try {
            DB::beginTransaction();
            if (request()->has('image')) {
                $dataR['image'] = $this->uploadImage($request->image, 'galary_images');

            }
            $slider = Galary::create($dataR);

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
        $data['galary'] = Galary::findOrFail($id);
        return view('admin.galary.create', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $dataR = $request->only('image', 'status','type','sub_type');
        try {
            DB::beginTransaction();
            if (request()->has('image')) {
                $dataR['image'] = $this->uploadImage($request->image, 'galary_images');
            }


            $slider =Galary::findOrFail($id);
            $slider->update($dataR);
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
        $item = Galary::findOrFail($id);
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
        Galary::destroy($id);
        return $this->response_api(200, __('admin.form.deleted_successfully'), '');

    }
    public function bluckDestroy(Request $request)
    {
        $ids = $request->id;
        foreach ($ids as $row) {
            $item = Galary::find($row);
            if(!$item) {
                return $this->response_api(400 ,  __('admin.form.not_existed') , '');
            }
            $item->delete();
        }
        return $this->response_api(200 ,  __('admin.form.deleted_successfully') , '');
    }
}
