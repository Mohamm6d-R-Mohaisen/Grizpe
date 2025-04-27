@extends('admin.layouts.master', ['is_active_parent' => 'products','is_active'=> 'products'])
@section('title')
    {{ __('admin.global.add_new_product') }}
@endsection
@section('content')
    <form id="kt_form" class="form row" data-kt-redirect="{{ route('admin.products.index') }}"
            action="{{ isset($product) ? route('admin.products.update' ,  $product->id) : route('admin.products.store') }}">
        @csrf
        @isset($product)
            @method('PATCH')
        @endif

        <div class="">
            <div class="page-content-header d-flex" style="justify-content: end;">
                <div class="mr-5 ml-5">
                    <a href="{{ route('admin.products.index') }}" id="kt_ecommerce_add_product_cancel" class="btn btn-outline btn-outline-dashed me-2 mb-2 cancel px-18">
                        {{ __('admin.form.cancel') }}
                    </a>
                    <button type="submit" id="kt_submit" class="btn btn-primary px-18">
                        <span class="indicator-label">{{ __('admin.admins.save') }}</span>
                        <span class="indicator-progress">{{ __('admin.admins.please_wait') }}
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                    </button>
                </div>
            </div>
        </div>
        
        <div class="d-flex flex-column gap-5 col-lg-3 mb-7">
            <div class="card card-flush">
                <div class="card-header">
                    <div class="card-title" style="width: 100%">
                        <ul class="nav nav-tabs nav-pills border-0 flex-row flex-md-column mb-3 mb-md-0 fs-6 py-5" style="width: 100%">
                            <li class="nav-item" style="list-style-type: none;">
                                <a class="nav-link active" data-bs-toggle="tab" href="#text">الاسم والوصف</a>
                            </li>
                            <li class="nav-item" style="list-style-type: none;">
                                <a class="nav-link" data-bs-toggle="tab" href="#basic">المعلومات الأساسية</a>
                            </li>
                            <li class="nav-item" style="list-style-type: none;">
                                <a class="nav-link" data-bs-toggle="tab" href="#seo">السيو</a>
                            </li>
                            <li class="nav-item" style="list-style-type: none;">
                                <a class="nav-link" data-bs-toggle="tab" href="#media">الصور</a>
                            </li>
                            
                            <li class="nav-item" style="list-style-type: none;">
                                <a class="nav-link" data-bs-toggle="tab" href="#attributes">الخصائص</a>
                            </li>
                            {{-- <li class="nav-item" style="list-style-type: none;">
                                <a class="nav-link" data-bs-toggle="tab" href="#price">السعر</a>
                            </li> --}}
                        </ul>
                        
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-content col-lg-9">
            <div class="tab-pane fade mb-5" id="basic" role="tab-panel">
                <div class="card card-flush">
                    <div class="card-body">
                        <div>
                            <div class="new-user-form mt-5">
                                <div class="formContent">
                                    <div class="row g-9">
                                        <div class="fv-row fv-plugins-icon-container">
                                            <label class="required fs-6 fw-semibold mb-2">Product type</label>
                                            <select class="form-select mb-2" id="select2_product_type"  name="type" data-kt-repeater="select2"
                                                data-placeholder="{{ __('admin.global.type') }}" data-allow-clear="true">
                                                <option value="variant">Variant</option>
                                                <option value="normal">Normal</option>
                                            </select>                                        
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="new-user-form mt-5">
                                <div class="formContent">
                                    <div class="row g-9">
                                        <div class=" fv-row fv-plugins-icon-container">
                                            <label class="required fs-6 fw-semibold mb-2">التصنيف</label>
                                            <select class="form-select mb-2" id="select2_category" name="categories[]" data-kt-repeater="select2"
                                                data-placeholder="{{ __('admin.global.category') }}" data-allow-clear="true">
                                                <option></option>
                                                @if(isset($product))
                                                    @foreach($categories as $category)
                                                        <option value="{{ $category->id }}" 
                                                            {{ in_array($category->id, $product->categories->pluck('id')->toArray()) ? 'selected' : '' }}>
                                                            {{ $category->name }}
                                                        </option>
                                                    @endforeach
                                                @else
                                                    @foreach($categories as $category)
                                                        <option value="{{ $category->id }}">
                                                            {{ $category->name }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>                                     
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="new-user-form mt-5">
                                <div class="formContent">
                                    <div class="row g-9">
                                        <div class=" fv-row fv-plugins-icon-container">
                                            <label class="required fs-6 fw-semibold mb-2">{{ __('admin.global.inventory_quantity') }}</label>
                                            <input class="form-control" placeholder="{{ __('admin.global.inventory_quantity') }}" name="quantity" value="{{ isset($product) ? $product->inventory->quantity:'' }}">
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade show active" id="text" role="tab-panel">
                <div class="d-flex flex-column gap-5 mb-5">
                    <div class="card card-flush generalDataTap">
                        <div class="salesTitle">
                            <h3>{{__('admin.global.name_and_description')}}</h3>
                        </div>
                        <div class="card-body pt-0">
                            <ul class="nav nav-tabs nav-line-tabs nav-line-tabs-2x border-bottom fs-4 fw-semibold {{($lang == 'ar') ? '' : 'flex-row-reverse  justify-content-end'}}" role="tablist">
                                <li class="nav-item mx-3" role="presentation">
                                    <a class="nav-link text-active-primary m-0 {{($lang == 'ar') ? 'active' : ''}} " data-bs-toggle="tab"
                                        href="#name_and_description_ar" aria-selected="true" role="tab">
                                        {{__('admin.form.arabic')}}
                                    </a>
                                </li>
                                <li class="nav-item mx-3" role="presentation">
                                    <a class="nav-link text-active-primary m-0 {{($lang == 'ar') ? '' : 'active'}}" data-bs-toggle="tab"
                                        href="#name_and_description_en" aria-selected="false" role="tab" tabindex="-1">
                                        {{__('admin.form.english')}}
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content mt-5" id="myTabContent">
                                <div class="tab-pane fade generalTap-pane {{($lang == 'ar') ? 'active show ar' : ''}}" id="name_and_description_ar"
                                    role="tabpanel">
                                    <div class="row">
                                        <div class="col-md-12 fv-row fv-plugins-icon-container ">
                                            <div class="mb-5 fv-row">
                                                <label class="required form-label">{{ __('admin.global.product_name') }}</label>
                                                <input type="text" name="name_ar" class="form-control mb-2 w-100"
                                                    placeholder="{{ __('admin.global.product_name') }}"
                                                    value="{{ isset($product) ? $product->translate('ar')->name : '' }}" />
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <label class="form-label">{{ __('admin.global.short_description') }} </label>
                                        <textarea name="short_description_ar" class="summernote" id="summernote_s_desc_ar">{{ isset($product) ? $product->translate('ar')->short_description : '' }}</textarea>
                                    </div>
                                    <div>
                                        <label class="form-label">{{ __('admin.global.long_description') }} </label>
                                        <textarea name="long_description_ar" class="summernote"  id="summernote_l_desc_ar">{{ isset($product) ? $product->translate('ar')->long_description : '' }}</textarea>
                                    </div>
                                </div>
                                <div class="tab-pane fade arabic-tab {{($lang == 'ar') ? '' : 'active show en'}}" id="name_and_description_en" role="tabpanel">
                                    <div class="row">
                                        <div class="col-md-12 fv-row fv-plugins-icon-container ">
                                            <div class="mb-5 fv-row">
                                                <label class="required form-label">
                                                    {{ __('admin.global.product_name') }}
                                                </label>
                                                <input type="text" name="name_en" class="form-control mb-2"
                                                    placeholder="{{ __('admin.global.product_name') }}"
                                                    value="{{ isset($product) ? $product->translate('en')->name : '' }}" />
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div>
                                        <label class="form-label">{{ __('admin.global.short_description') }}</label>
                                        <textarea name="short_description_en" class="summernote" id="summernote_s_desc_en">{{ isset($product) ? $product->translate('en')->short_description : '' }}</textarea>
                                    </div>
                                    <div>
                                        <label class="form-label">{{ __('admin.global.long_description') }}</label>
                                        <textarea name="long_description_en" class="summernote" id="summernote_l_desc_en">{{ isset($product) ? $product->translate('en')->long_description : '' }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="media" role="tab-panel">
                <div class="d-flex flex-column gap-5 mb-5">
                    <div class="card card-flush generalDataTap draggable-zone">
                        <div class="salesTitle">
                            <h3>إضافة صور للمنتج</h3>
                        </div>

                        <!--begin::Repeater-->
                        <div class="mx-5 " id="media_repeater">
                            <div class="form-group draggable">
                                <div data-repeater-list="media_repeater">
                                    @if(isset($product))
                                        @foreach ($product->images as $product_image)
                                            <div data-repeater-item class="draggable" style="border: 1px solid #988f8f40;border-radius: 10px;margin: 20px;padding: 15px; width: fit-content;">
                                                <div class="form-group row mb-5 ">
                                                    <div class="card-toolbar">
                                                        <a href="#" class="btn btn-icon btn-hover-light-primary draggable-handle">
                                                            <!--begin::Svg Icon | path: icons/duotune/abstract/abs015.svg-->
                                                            <span class="svg-icon svg-icon-2x">
                                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z" fill="currentColor"></path>
                                                                    <path opacity="0.3" d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z" fill="currentColor"></path>
                                                                </svg>
                                                            </span>
                                                            <!--end::Svg Icon-->
                                                        </a>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="image-input image-input-empty" data-kt-image-input="true" style="background-image: url({{ getImageUrl($product_image->path, 'medium') }})">
                                                            <div class="image-input-wrapper w-125px h-125px"></div>
                                                            <input name="id" value="{{ $product_image->id }}" type="hidden"/>
                                                            <label class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                                                data-kt-image-input-action="change" data-bs-toggle="tooltip" data-bs-dismiss="click" title="Change avatar">
                                                                <i class="bi bi-pencil-fill fs-7"></i>
                                                                <input type="file" name="image" accept=".png, .jpg, .jpeg" />
                                                                {{-- <input type="hidden" name="avatar_remove" /> --}}
                                                            </label>
                                                            <span class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                                                data-kt-image-input-action="cancel" data-bs-toggle="tooltip" data-bs-dismiss="click" title="Cancel avatar">
                                                                <i class="bi bi-x fs-2"></i>
                                                            </span>
                                                            <span class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                                                data-kt-image-input-action="remove" data-bs-toggle="tooltip" data-bs-dismiss="click" title="Remove avatar">
                                                                <i class="bi bi-x fs-2"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    {{-- <div class="col-md-6">
                                                        <label class="form-label">عنوان الصورة</label>
                                                        <input class="form-control" name="image_title" class="form-control mb-2 w-100" value="{{ $product_image->image_title ?? '' }}"  placeholder="أضف عنوان للسيو (اختياري)" />
                                                    </div> --}}
                                                    <div class="col-md-6">
                                                        <a href="javascript:;" data-repeater-delete class="btn btn-sm btn-light-danger mt-3 mt-md-9">
                                                            <i class="la la-trash-o fs-3"></i>حذف
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div data-repeater-item class="draggable" style="border: 1px solid #988f8f40;border-radius: 10px;margin: 20px;padding: 15px; width: fit-content;">
                                            <div class="form-group row mb-5 ">
                                                <div class="card-toolbar">
                                                    <a href="#" class="btn btn-icon btn-hover-light-primary draggable-handle">
                                                        <!--begin::Svg Icon | path: icons/duotune/abstract/abs015.svg-->
                                                        <span class="svg-icon svg-icon-2x">
                                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z" fill="currentColor"></path>
                                                                <path opacity="0.3" d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z" fill="currentColor"></path>
                                                            </svg>
                                                        </span>
                                                        <!--end::Svg Icon-->
                                                    </a>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="image-input image-input-empty" data-kt-image-input="true" style="background-image: url({{ asset('admin_assets/media/svg/avatars/blank.svg') }})">
                                                        <div class="image-input-wrapper w-125px h-125px"></div>
                                                        <label class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                                            data-kt-image-input-action="change" data-bs-toggle="tooltip" data-bs-dismiss="click" title="Change avatar">
                                                            <i class="bi bi-pencil-fill fs-7"></i>
                                                            <input type="file" name="image" accept=".png, .jpg, .jpeg" />
                                                            {{-- <input type="hidden" name="avatar_remove" /> --}}
                                                        </label>
                                                        <span class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                                            data-kt-image-input-action="cancel" data-bs-toggle="tooltip" data-bs-dismiss="click" title="Cancel avatar">
                                                            <i class="bi bi-x fs-2"></i>
                                                        </span>
                                                        <span class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                                            data-kt-image-input-action="remove" data-bs-toggle="tooltip" data-bs-dismiss="click" title="Remove avatar">
                                                            <i class="bi bi-x fs-2"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                {{-- <div class="col-md-6">
                                                    <label class="form-label">عنوان الصورة</label>
                                                    <input class="form-control" name="image_title" class="form-control mb-2 w-100"  placeholder="" />
                                                </div> --}}
                                                <div class="col-md-6">
                                                    <a href="javascript:;" data-repeater-delete class="btn btn-sm btn-light-danger mt-3 mt-md-9">
                                                        <i class="la la-trash-o fs-3"></i>حذف
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    
                                </div>
                            </div>

                            <div class="form-group mb-5">
                                <a href="javascript:;" data-repeater-create class="btn btn-primary px-18">
                                    <i class="la la-plus"></i>إضافة
                                </a>
                            </div>
                        </div>
                        <!--end::Repeater-->
                    </div>
                    {{-- <div class="card card-flush generalDataTap draggable-zone">
                        <div class="salesTitle">
                            <h3>إضافة فيديو للمنتج</h3>
                        </div>
                        <!--begin::Repeater-->
                        <div class="mx-5">
                            <div class="form-group">
                                <div data-repeater-item style="border: 1px solid #988f8f40;border-radius: 10px;margin: 20px;padding: 15px;">
                                    <div class="form-group row mb-5">
                                        <div class="col-md-12">
                                            <label class="form-label">الفيديو</label>
                                            <input type="file" class="form-control" name="video" value="{{ isset($product) ? $product->video: '' }}" class="form-control mb-2 w-100" accept="video/*" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end::Repeater-->
                    </div> --}}
                </div>
            </div>
            <div class="tab-pane fade" id="seo" role="tab-panel">
                <div class="d-flex flex-column gap-5 mb-5">
                    <div class="card card-flush generalDataTap">
                        <div class="salesTitle">
                            <h3>إضافة نصوص السيو</h3>
                        </div>

                        <!--begin::Repeater-->
                        <div class="mx-5 " id="seo">
                            <div class="form-group row mb-5 ">
                                <div class="col-md-8">
                                    <label class="form-label">Meta title</label>
                                    <input class="form-control" name="meta_title" class="form-control mb-2 w-100" value="{{ isset($product) ? $product->meta_title : '' }}"  placeholder="" />
                                </div>
                            </div>
                            {{-- <div class="form-group row mb-5 ">
                                <div class="col-md-8">
                                    <label class="form-label">Meta keywords</label>
                                    <input class="form-control"  class="form-control mb-2 w-100"  placeholder="" />
                                </div>
                            </div> --}}
                            <div class="form-group row mb-5 ">
                                <div class="col-md-8">
                                    <label class="form-label">Meta description</label>
                                    <textarea class="form-control mb-2 w-100" name="meta_description" id="" cols="30" rows="10" value="{{ isset($product) ? $product->meta_description : '' }}"> {{ isset($product) ? $product->meta_title : '' }}</textarea>
                                </div>
                            </div>
                        </div>
                        <!--end::Repeater-->
                    </div>
                </div>
            </div>
            {{-- <div class="tab-pane fade" id="price" role="tab-panel">
                <div class="d-flex flex-column gap-5 mb-5">
                    <div class="card card-flush generalDataTap">
                        <div class="salesTitle">
                            <h3>إضافة سعر للمنتج</h3>
                        </div>

                        <!--begin::Repeater-->
                        <div class="mx-5">
                            <div class="form-group">
                                <div data-repeater-item style="border: 1px solid #988f8f40;border-radius: 10px;margin: 20px;padding: 15px;">
                                    <div class="form-group row mb-5 ">
                                        <div class="col-md-6">
                                            <label class="form-label">سعر المنتج</label>
                                            <input class="form-control" name="price" value="{{ isset($product) ? $product->price: '' }}" class="form-control mb-2 w-100" placeholder="" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                           
                        </div>
                        <!--end::Repeater-->
                    </div>
                </div>
            </div> --}}
            <div class="tab-pane fade" id="attributes" role="tab-panel">
                <div class="d-flex flex-column gap-5 mb-5">
                    <div class="card card-flush generalDataTap">
                        <div class="salesTitle">
                            <h3>إدارة المتغيرات (Variants)</h3>
                        </div>
                        
                        <!--begin::Repeater للمتغيرات -->
                        <div class="mx-5" id="variants_repeater">
                            <div class="form-group">
                                <div data-repeater-list="variants">
                                    @if(isset($product) && $product->variants->count() > 0)
                                        @foreach($product->variants as $key => $variant)
                                            <div data-repeater-item class="variant-item mb-5 p-4 border rounded">
                                                <input type="hidden" name="variants[{{ $key }}][id]" value="{{ $variant->id }}">
                                                <div class="row mb-4">
                                                    <div class="col-md-3">
                                                        <label class="form-label">السعر</label>
                                                        <input type="number" 
                                                               name="variants[{{ $key }}][price]" 
                                                               class="form-control"
                                                               value="{{ $variant->price }}">
                                                    </div>
                                                    
                                                    <div class="col-md-3">
                                                        <label class="form-label">SKU</label>
                                                        <input type="text" 
                                                               name="variants[{{ $key }}][sku]" 
                                                               class="form-control"
                                                               value="{{ $variant->sku }}">
                                                    </div>
                                                    
                                                    <div class="col-md-3">
                                                        <label class="form-label">الكمية</label>
                                                        <input type="number" 
                                                               name="variants[{{ $key }}][quantity]" 
                                                               class="form-control"
                                                               value="{{ $variant->inventory->quantity ?? 0 }}">
                                                    </div>
                                                    
                                                    <div class="col-md-3 d-flex align-items-end">
                                                        <button type="button" 
                                                                data-repeater-delete 
                                                                class="btn btn-danger">
                                                            <i class="la la-trash-o"></i> حذف
                                                        </button>
                                                    </div>
                                                </div>
                                                
                                                <!-- Attributes Section -->
                                                <div class="attributes-section border-top pt-4">
                                                    <div class="row mb-3">
                                                        @foreach($attributes as $attribute)
                                                            <div class="col-md-4 mb-3">
                                                                <label class="form-label">{{ $attribute->name }}</label>
                                                                <select class="form-select attribute-select"
                                                                        name="variants[{{ $key }}][attribute_values][{{ $attribute->id }}]" 
                                                                        data-attribute-id="{{ $attribute->id }}">
                                                                    <option value="">اختر {{ $attribute->name }}</option>
                                                                    @foreach($attribute->attributeValues as $value)
                                                                        <option value="{{ $value->id }}"
                                                                            {{ $variant->attributeValues->contains($value->id) ? 'selected' : '' }}>
                                                                            {{ $value->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div data-repeater-item class="variant-item mb-5 p-4 border rounded">
                                            <div class="row mb-4">
                                                <div class="col-md-3">
                                                    <label class="form-label">السعر</label>
                                                    <input type="number" 
                                                           name="variants[0][price]" 
                                                           class="form-control"
                                                           step="1">
                                                </div>
                                                
                                                <div class="col-md-3">
                                                    <label class="form-label">SKU</label>
                                                    <input type="text" 
                                                           name="variants[0][sku]" 
                                                           class="form-control">
                                                </div>
                                                
                                                <div class="col-md-3">
                                                    <label class="form-label">الكمية</label>
                                                    <input type="number" 
                                                           name="variants[0][quantity]" 
                                                           class="form-control"
                                                           value="0">
                                                </div>
                                                
                                                <div class="col-md-3 d-flex align-items-end">
                                                    <button type="button" 
                                                            data-repeater-delete 
                                                            class="btn btn-danger">
                                                        <i class="la la-trash-o"></i> حذف
                                                    </button>
                                                </div>
                                            </div>
                                            
                                            <!-- Attributes Section -->
                                            <div class="attributes-section border-top pt-4">
                                                <div class="row mb-3">
                                                    @foreach($attributes as $attribute)
                                                        <div class="col-md-4 mb-3">
                                                            <label class="form-label">{{ $attribute->name }}</label>
                                                            <select class="form-select attribute-select"
                                                                    name="variants[0][attribute_values][{{ $attribute->id }}]" 
                                                                    data-attribute-id="{{ $attribute->id }}">
                                                                <option value="">اختر {{ $attribute->name }}</option>
                                                                @foreach($attribute->attributeValues as $value)
                                                                    <option value="{{ $value->id }}">
                                                                        {{ $value->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="form-group mb-5">
                                <button type="button" data-repeater-create class="btn btn-primary">
                                    <i class="la la-plus"></i> إضافة متغير جديد
                                </button>
                            </div>
                        </div>
                        <!--end::Repeater -->
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
@push('scripts')
    {{-- <script src="{{ asset('admin_assets/js/dashboard/save-product-attributes.js') }}"></script> --}}
    <script src="{{ asset('admin_assets/js/dashboard/handleSubmitForm.js') }}"></script>
    <script src="{{ asset('admin_assets/js/summernote-lite.min.js') }}"></script>

    <script>
        $('.summernote').summernote({
            placeholder: '{{__('admin.global.type_your_text_here')}}',
            tabsize: 2,
            height: 120,
            lang: 'ar-AR',
            toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
    </script>
    <script src="{{ asset('admin_assets/plugins/custom/formrepeater/formrepeater.bundle.js') }}"></script>
    <script src="{{ asset('admin_assets/js/custom/documentation/forms/formrepeater/advanced.js') }}"></script>
    <script src="{{ asset('admin_assets/plugins/custom/draggable/draggable.bundle.js') }}"></script>
    <script>
        // ---------------------draggable script--------------
        var containers = document.querySelectorAll(".draggable-zone");

        // if (containers.length === 0) {
        //     return false;
        // }

        var swappable = new Swappable.default(containers, {
            draggable: ".draggable",
            handle: ".draggable .draggable-handle",
            mirror: {
                //appendTo: selector,
                appendTo: "body",
                constrainDimensions: true
            }
        });
        // ---------------------draggable script--------------
    </script>
    <script>
        $(document).on('change', '.attributes', function (e) {
            // let $this = $(e.currentTarget);
            let id = $(this).val();
            let attribute_value_url = $(this).data('attribute_value_url');
            let target_url = attribute_value_url.replace('id', id);
            
            var $currentRepeaterItem = $(this).closest('.data-repeater-item');
            var $attributeValues = $currentRepeaterItem.find('.attribute_values');

            axios.get(`${target_url}`).then(response => {
            if (response.data.status == 200) {
                $attributeValues.empty();
                $.each(response.data.item.attribute_values, function(key,val){
                    var newOption = new Option(val.name, val.id, false, false);
                    $attributeValues.append(newOption);
                });
                $attributeValues.trigger('change');
            }
            }).catch(err => {
                alert(err)
            });
        });
    </script>   
    <script>
        $(function () {
            $("#select2_category").select2();
        });
    </script>
@endpush
