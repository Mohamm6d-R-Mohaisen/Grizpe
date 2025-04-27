@extends('admin.layouts.master', ['is_active_parent' => 'home_sections','is_active'=> 'home_sections'])
@section('title')
    {{ __('admin.global.add_new_home_section') }}
@endsection
@section('content')
    <form id="kt_form" class="form row" data-kt-redirect="{{ route('admin.home_sections.index') }}"
            action="{{ isset($home_section) ? route('admin.home_sections.update' ,  $home_section->id) : route('admin.home_sections.store') }}">
        @csrf
        @isset($home_section)
            @method('PATCH')
        @endif

        <div class="page-content-header">
            <h2 class="table-title">{{ __('admin.global.add_new_home_section') }}</h2>
        </div>

        <div class="d-flex flex-column gap-5 col-lg-3 mb-7 ">
            <div class="card card-flush">
                <div class="card-header">
                    <div class="card-title ">
                        <h3>{{__('admin.form.status')}}</h3>
                    </div>
                    <div class="card-toolbar">
                        <label class="form-check form-switch form-check-custom form-check-solid">
                            <input type="hidden" name="status" value="0">
                            <input class="form-check-input btn active_operation" style="margin: 0 auto;" type="checkbox"
                                name="status" @if(isset($home_section) && $home_section->status == 1) checked="checked" @endif value="1" >
                            <span class="form-check-label fw-bold text-muted"></span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex flex-column flex-row-fluid gap-3 col-lg-9">
            <div class="d-flex flex-column gap-5">
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
                                            <label class="required form-label">{{ __('admin.global.section_name') }}</label>
                                            <input type="text" name="name_ar" class="form-control mb-2 w-100"
                                                placeholder="{{ __('admin.global.section_name') }}"
                                                value="{{ isset($home_section) ? optional($home_section)->translate('ar')->name ?? '' : '' }}" />
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <label class="form-label">{{ __('admin.global.home_section_content') }} </label>
                                    <textarea name="content_ar" id="summernote1">{{ isset($home_section) ? optional($home_section)->translate('ar')->content ?? '' : '' }}</textarea>
                                </div>
                            </div>
                            <div class="tab-pane fade arabic-tab {{($lang == 'ar') ? '' : 'active show en'}}" id="name_and_description_en" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-12 fv-row fv-plugins-icon-container ">
                                        <div class="mb-5 fv-row">
                                            <label class="required form-label">
                                                {{ __('admin.global.home_section_name') }}
                                            </label>
                                            <input type="text" name="title_en" id="title_en" class="form-control mb-2"
                                                placeholder="{{ __('admin.global.home_section_name') }}"
                                                value="{{ isset($home_section) ? optional($home_section)->translate('en')->title ?? '' : '' }}" />
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <label class="form-label">{{ __('admin.global.home_section_content') }}</label>
                                    <textarea name="content_en" id="summernote1_en">{{ isset($home_section) ? optional($home_section)->translate('en')->content ?? '' : '' }}</textarea>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
                <div class="card card-flush generalDataTap">
                    <div class="card-body pt-0">
                        <div class="mt-5">
                            <div class="row">
                                <div class="col-md-12 fv-row fv-plugins-icon-container ">
                                    <div class="mb-5 fv-row">
                                        <label class="required form-label">{{ __('admin.global.section_type') }}</label>
                                        <input type="text" name="type" class="form-control mb-2 w-100"
                                            placeholder="{{ __('admin.global.section_type') }}"
                                            value="{{ isset($home_section) ? $home_section->type:'' }}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card card-flush generalDataTap draggable-zone">
                    <div class="salesTitle">
                        <h3>إضافة عناصر القسم</h3>
                    </div>

                    <!--begin::Repeater-->
                    <div class="mx-5 " id="section_item_repeater">
                        <div class="form-group draggable">
                            <div data-repeater-list="section_items">
                                @if(isset($home_section))
                                    @foreach ($home_section->items as $section_item)
                                        <div data-repeater-item class="draggable" style="border: 1px solid #988f8f40;border-radius: 10px;margin: 20px;padding: 15px;">
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
                                                <div class="col-md-3">
                                                    <div class="image-input image-input-empty" data-kt-image-input="true" style="background-image: url({{ $section_item->image ?? asset('admin_assets/media/svg/avatars/blank.svg') }})">
                                                        <div class="image-input-wrapper w-125px h-125px"></div>
                                                        <input name="id" value="{{ $section_item->id }}" type="hidden"/>
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
                                                <div class="col-md-6">
                                                    <label class="form-label">رابط (اختياري)</label>
                                                    <input class="form-control" name="link" class="form-control mb-2 w-100" value="{{ $section_item->link ?? '' }}"  placeholder="أضف رابط (اختياري)" />
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">اسم العنصر بالعربي</label>
                                                    <input class="form-control" name="name_ar" class="form-control mb-2 w-100" value="{{ $section_item->translate('ar')->name ?? '' }}"  placeholder="اسم العنصر بالعربي" />
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">اسم العنصر بالإنجليزي</label>
                                                    <input class="form-control" name="name_en" class="form-control mb-2 w-100" value="{{ $section_item->translate('en')->name ?? '' }}"  placeholder="اسم العنصر بالإنجليزي" />
                                                </div>
                                                <div class="row mt-8">
                                                    <div class="col-md-6">
                                                        <label class="form-label">وصف العنصر بالعربي</label>
                                                        <textarea class="form-control" name="description_ar" class="form-control mb-2 w-100" value="{{ $section_item->translate('ar')->description ?? '' }}"  placeholder="وصف العنصر بالعربي" rows="5" >{{ $section_item->translate('ar')->description ?? '' }}</textarea>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label">وصف العنصر بالإنجليزي</label>
                                                        <textarea class="form-control" name="description_en" class="form-control mb-2 w-100" value="{{ $section_item->translate('en')->description ?? '' }}"  placeholder="وصف العنصر بالإنجليزي" rows="5" >{{ $section_item->translate('en')->description ?? '' }}</textarea>
                                                    </div>
                                                </div>
                                                <div style="display: flex;justify-content: end;">
                                                    <a href="javascript:;" data-repeater-delete class="btn btn-sm btn-light-danger mt-3 mt-md-9">
                                                        <i class="la la-trash-o fs-3"></i>حذف
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div data-repeater-item class="draggable" style="border: 1px solid #988f8f40;border-radius: 10px;margin: 20px;padding: 15px;">
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
                                            <div class="col-md-3">
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
                                            <div class="col-md-6">
                                                <label class="form-label">رابط (اختياري)</label>
                                                <input class="form-control" name="link" class="form-control mb-2 w-100" value=""  placeholder="أضف رابط (اختياري)" />
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">اسم العنصر بالعربي</label>
                                                <input class="form-control" name="name_ar" class="form-control mb-2 w-100" value=""  placeholder="اسم العنصر بالعربي" />
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">اسم العنصر بالإنجليزي</label>
                                                <input class="form-control" name="name_en" class="form-control mb-2 w-100" value=""  placeholder="اسم العنصر بالإنجليزي" />
                                            </div>
                                            <div class="row mt-8">
                                                <div class="col-md-6">
                                                    <label class="form-label">وصف العنصر بالعربي</label>
                                                    <textarea class="form-control" name="description_ar" class="form-control mb-2 w-100" value=""  placeholder="وصف العنصر بالعربي" rows="5" ></textarea>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">وصف العنصر بالإنجليزي</label>
                                                    <textarea class="form-control" name="description_en" class="form-control mb-2 w-100" value=""  placeholder="وصف العنصر بالإنجليزي" rows="5" ></textarea>
                                                </div>
                                            </div>
                                            <div style="display: flex;justify-content: end;">
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
                <div class="page-buttuns mt-5">
                    <div class="row justify-content-between">
                        <div class="d-flex justify-content-end right">
                            <button type="submit" id="kt_submit" class="btn btn-primary">
                                <span class="indicator-label">{{ __('admin.admins.save') }}</span>
                                <span class="indicator-progress">{{ __('admin.admins.please_wait') }}
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                </span>
                            </button>
                            <a href="{{ route('admin.home_sections.index') }}" id="kt_ecommerce_add_product_cancel"
                                class="btn btn-light me-5 cancel">{{ __('admin.form.cancel') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </form>
@endsection
@push('scripts')
    <script src="{{ asset('admin_assets/js/dashboard/handleSubmitForm.js') }}"></script>
    <script src="{{ asset('admin_assets/js/summernote-lite.min.js') }}"></script>
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
        $('#summernote1').summernote({
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
        $('#summernote1_en').summernote({
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
    <script>
        $(function () {
            $("#discount_type").select2();
            $("#products").select2();
            $("#categories").select2();
        });
    </script>
@endpush
