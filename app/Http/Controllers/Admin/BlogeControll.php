<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bloge;
use App\Models\Category;
use App\Models\Image;
use App\Models\ProductImage;
use App\Models\Slider;
use App\Traits\HasImages;
use App\Traits\SaveImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BlogeControll extends Controller
{
    use SaveImageTrait,HasImages;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('admin.blogs.index');
    }
    public function datatable(Request $request)
    {
        $items = Bloge::query()->orderBy('id', )->search($request);
        return $this->filterDataTable($items, $request);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $data['categories']=Category::all();
        return view('admin.blogs.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $dataR = $request->only('image', 'status','category_id');
        $dataTrans = $request->only('title_ar', 'title_en', 'author_name_ar', 'author_name_en','conclusions_ar','conclusions_en',
        'content_ar','content_en','lessons_ar','lessons_en','quotation_ar','quotation_en','short_description_ar','short_description_en',);

        try {
            DB::beginTransaction();
            if (request()->has('image')) {
                $dataR['image'] = $this->uploadImage($request->image, 'bloges_images');

            }

            $blog = Bloge::create($dataR);
            $blog->createTranslation($dataTrans);
            if (!empty($request->media_repeater)) {

            foreach ($request->media_repeater as $key => $media) {
                if (isset($media['image'])) {
                    $path = $this->saveImageWithSizes($media['image'], 'bloges_images' , $key);
                        $blog->images()->create([
                            'path' => $path['original'], // حفظ الصورة الأصلية فقط كمرجع
                            'pos' => $key,
                        ]);
                    }
            }
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
        $data['categories']=Category::all();
        $data['blog']=Bloge::findorfail($id);
        return view('admin.blogs.create',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $dataR = $request->only('image', 'status','category_id');
        $dataTrans = $request->only('title_ar', 'title_en', 'author_name_ar', 'author_name_en','conclusions_ar','conclusions_en',
            'content_ar','content_en','lessons_ar','lessons_en','quotation_ar','quotation_en','short_description_ar','short_description_en');

        try {
            DB::beginTransaction();
            if (request()->has('image')) {
                $dataR['image'] = $this->uploadImage($request->image, 'bloges_images');

            }

            $blog = Bloge::findorfail($id);
            $blog->update($dataR);
            $blog->createTranslation($dataTrans);
//
            // تحديث الصور الثانوية
            if ($request->has('media_repeater')) {
                // حذف الصور القديمة
                $blog->images()->delete();
                // حفظ الصور الجديدة
                foreach ($request->media_repeater as $key => $media) {
                    if (isset($media['image'])) {
                        $path = $this->saveImageWithSizes($media['image'], 'bloges_images' , $key);
                        $blog->images()->create([
                            'path' => $path['original'], // حفظ الصورة الأصلية فقط كمرجع
                            'pos' => $key,
                        ]);
                    }
                }
            }
            DB::commit();

            return $this->response_api(200, __('admin.form.added_successfully'), '');
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
        $item = Bloge::findOrFail($id);
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
        Bloge::destroy($id);
        return $this->response_api(200, __('admin.form.deleted_successfully'), '');

    }
    public function bluckDestroy(Request $request)
    {
        $ids = $request->id;
        foreach ($ids as $row) {
            $item = Bloge::find($row);
            if(!$item) {
                return $this->response_api(400 ,  __('admin.form.not_existed') , '');
            }
            $item->delete();
        }
        return $this->response_api(200 ,  __('admin.form.deleted_successfully') , '');
    }
}
