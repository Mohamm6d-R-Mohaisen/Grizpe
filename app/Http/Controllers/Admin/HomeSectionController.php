<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\HomeSection\UpdateHomeSectionRequest;
use App\Http\Requests\HomeSection\CreateHomeSectionRequest;
use App\Models\Category;
use App\Models\HomeSection;
use App\Models\HomeSectionItem;
use App\Models\HomeSectionItemTranslation;
use App\Models\Product;
use App\Models\ProductHomeSection;
use App\Traits\SaveImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeSectionController extends Controller
{
    use SaveImageTrait;

    public function __construct()
    {
        $this->middleware('permission:view_home_sections|add_home_sections', ['only' => ['index','store']]);
        $this->middleware('permission:add_home_sections', ['only' => ['create','store']]);
        $this->middleware('permission:edit_home_sections', ['only' => ['edit','update']]);
        $this->middleware('permission:delete_home_sections', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.home_sections.index');
    }

    public function datatable(Request $request) 
    {
        $items = HomeSection::query()->orderBy('id', 'DESC'); 
        return $this->filterDataTable($items, $request);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.home_sections.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateHomeSectionRequest $request)
    {           
        $dataR = $request->only('type', 'status');
        $dataTrans = $request->only('name_ar', 'name_en', 'description_ar', 'description_en');

        try {
            DB::beginTransaction();
                $home_section = HomeSection::create($dataR);
                $home_section->createTranslation($dataTrans);

                foreach($request->section_items as $key => $item){
                    $image = null;
                    if (isset($item['image']) && $item['image'] !== null) {
                        $image = $this->uploadImage($item['image'], 'home_section_images');
                    }

                    $setion_item = HomeSectionItem::create([
                        'home_section_id' => $home_section->id,
                        'link' => $item['link'],
                        'order' => $key,
                        'image' => $image,
                    ]);
                    $setion_item->createTranslation([
                        'name_ar' => $item['name_ar'],
                        'name_en' => $item['name_en'],
                        'description_ar' => $item['description_ar'],
                        'description_en' => $item['description_en'],
                    ]);
                }
            DB::commit();
            return $this->response_api(200, __('admin.form.added_successfully'), '');
        } catch (\Exception $e) {
            DB::rollback();
            return $this->response_api(404, $this->exMessage($e));
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
        $data['home_section'] = HomeSection::findOrFail($id);
        return view('admin.home_sections.create', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateHomeSectionRequest $request, $id)
    {
        $dataR = $request->only('type', 'status');
        $dataTrans = $request->only('name_ar', 'name_en', 'description_ar', 'description_en');
    
        try {
            DB::beginTransaction();
    
            $home_section = HomeSection::findOrFail($id);
            $home_section->update($dataR);
            $home_section->createTranslation($dataTrans);
    
            // Update or create section items
            foreach ($request->section_items as $key => $item) {
                $image = null;
                if (isset($item['image']) && $item['image'] !== null) {
                    $image = $this->uploadImage($item['image'], 'home_section_images');
                }
    
                if (isset($item['id'])) {
                    // Update existing item
                    $section_item = HomeSectionItem::findOrFail($item['id']);
                    $section_item->update([
                        'link' => $item['link'],
                        'order' => $key,
                        'image' => $image ?? $section_item->image,
                    ]);
    
                    $section_item->createTranslation([
                        'name_ar' => $item['name_ar'],
                        'name_en' => $item['name_en'],
                        'description_ar' => $item['description_ar'],
                        'description_en' => $item['description_en'],
                    ]);
                } else {
                    // Create new item
                    $section_item = HomeSectionItem::create([
                        'home_section_id' => $home_section->id,
                        'link' => $item['link'],
                        'order' => $key,
                        'image' => $image,
                    ]);
    
                    $section_item->createTranslation([
                        'name_ar' => $item['name_ar'],
                        'name_en' => $item['name_en'],
                        'description_ar' => $item['description_ar'],
                        'description_en' => $item['description_en'],
                    ]);
                }
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
        $item = HomeSection::findOrFail($id);
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
        $home_section = HomeSection::findOrFail($id);

        foreach ($home_section->products as $product) {
            $product->home_section_price = 0;
            $product->save();
        }

        HomeSection::destroy($id);
        return $this->response_api(200, __('admin.form.deleted_successfully'), '');
    }
}
