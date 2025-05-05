@extends('admin.layouts.master', ['is_active_parent' => 'works','is_active'=> 'works'])
@section('title')
    {{ isset($work) ? __('admin.global.edit_work') : __('admin.global.add_new_work') }}
@endsection
@section('content')
    <form id="kt_form" class="form row d-flex flex-column flex-lg-row addForm" data-kt-redirect="{{ route('admin.works.index') }}"
          action="{{ isset($work) ? route('admin.works.update', $work->id) : route('admin.works.store') }}">
        @csrf
        @isset($work)
            @method('PATCH')
        @endif
        <!-- Header Buttons -->
        <div class="page-content-header d-flex" style="justify-content: end;">
            <div class="mr-5 ml-5">
                <a href="{{ route('admin.works.index') }}" id="kt_ecommerce_add_product_cancel" class="btn btn-outline btn-outline-dashed me-2 mb-2 cancel px-18">
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
        <!-- Sidebar Column -->
        <div class="d-flex flex-column gap-5 col-lg-3 mb-7">
            <!-- Status Field -->
            <div class="card card-flush">
                <div class="card-header">
                    <div class="card-title">
                        <h3>{{__('admin.form.status')}}</h3>
                    </div>
                    <div class="card-toolbar">
                        <label class="form-check form-switch form-check-custom form-check-solid">
                            <input type="hidden" name="status" value="inactive">
                            <input class="form-check-input btn active_operation" style="margin: 0 auto;" type="checkbox"
                                   name="status" @if(isset($work) && $work->status == 'active') checked="checked" @endif value="active">
                            <span class="form-check-label fw-bold text-muted"></span>
                        </label>
                    </div>
                </div>
            </div>
            <!-- Main Image Field -->
            <div class="card card-flush">
                <div class="card-header card-header justify-content-center p-5">
                    <div class="card-toolbar">
                        <div class="image-input image-input-outline image-input-placeholder image-input-empty" data-kt-image-input="true">
                            <div class="image-input-wrapper w-200px h-200px" style="background-image: url(@if(isset($work) && $work->image !== null) {{ asset($work->image) }} @else {{ asset('admin_assets/media/svg/avatars/blank.svg') }} @endif)"></div>
                            <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                                <i class="bi bi-pencil-fill fs-7"></i>
                                <input type="file" name="image" accept=".png, .jpg, .jpeg" />
                            </label>
                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
                                <i class="bi bi-x fs-2"></i>
                            </span>
                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
                                <i class="bi bi-x fs-2"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Price Field -->
            <div class="card card-flush">
                <div class="card-header">
                    <div class="card-title">
                        <h3>{{__('admin.form.price')}}</h3>
                    </div>
                    <div class="card-body">
                        <input type="number" name="price" class="form-control" placeholder="{{ __('admin.form.price') }}" value="{{ isset($work) ? $work->price : '' }}" />
                    </div>
                </div>
            </div>
            <!-- Service Type Field -->
            <div class="card card-flush">
                <div class="card-header">
                    <div class="card-title">
                        <h3>{{__('admin.form.service_type')}}</h3>
                    </div>
                    <div class="card-body">
                        <select name="service_id" class="form-select">
                            @foreach($service as $service)
                                <option value="{{ $service->id }}" @if(isset($work) && $work->service_id == $service->id) selected @endif>
                                    {{ $service->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <!-- Main Content Column -->
        <div class="d-flex flex-column flex-row-fluid gap-3 col-lg-9">
            <!-- Tabs Navigation -->
            <div class="card card-flush">
                <div class="card-header">
                    <ul class="nav nav-tabs nav-line-tabs nav-line-tabs-2x border-bottom fs-4 fw-semibold" role="tablist">
                        <li class="nav-item mx-3" role="presentation">
                            <a class="nav-link text-active-primary m-0 active" data-bs-toggle="tab" href="#name_and_description" aria-selected="true" role="tab">
                                {{__('admin.global.name_and_description')}}
                            </a>
                        </li>
                        <!-- New Media Tab -->
                        <li class="nav-item mx-3" role="presentation">
                            <a class="nav-link text-active-primary m-0" data-bs-toggle="tab" href="#media" aria-selected="false" role="tab" tabindex="-1">
                                {{__('admin.form.media')}}
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- Tabs Content -->
            <div class="tab-content mt-5" id="myTabContent">
                <!-- Name and Description Tab -->
                <div class="tab-pane fade show active" id="name_and_description" role="tabpanel">
                    <div class="card card-flush generalDataTap">
                        <div class="salesTitle">
                            <h3>{{__('admin.global.name_and_description')}}</h3>
                        </div>
                        <div class="card-body pt-0">
                            <ul class="nav nav-tabs nav-line-tabs nav-line-tabs-2x border-bottom fs-4 fw-semibold {{($lang == 'ar') ? '' : 'flex-row-reverse  justify-content-end'}}" role="tablist">
                                <li class="nav-item mx-3" role="presentation">
                                    <a class="nav-link text-active-primary m-0 {{($lang == 'ar') ? 'active' : ''}}" data-bs-toggle="tab"
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
                            <!-- Tab Content -->
                            <div class="tab-content mt-5">
                                <!-- Arabic Tab -->
                                <div class="tab-pane fade generalTap-pane {{($lang == 'ar') ? 'active show ar' : ''}}" id="name_and_description_ar" role="tabpanel">
                                    <div class="row">
                                        <div class="col-md-12 fv-row fv-plugins-icon-container">
                                            <div class="mb-5 fv-row">
                                                <label class="required form-label">{{ __('admin.global.title') }}</label>
                                                <input type="text" name="title_ar" class="form-control mb-2 w-100"
                                                       placeholder="{{ __('admin.global.title') }}"
                                                       value="{{ isset($work) ? $work->translate('ar')->title : '' }}" />
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <label class="form-label">{{ __('admin.global.description') }}</label>
                                        <textarea name="description_ar" id="summernote">{{ isset($work) ? $work->translate('ar')->description : '' }}</textarea>
                                    </div>
                                    <div>
                                        <label class="form-label">{{ __('admin.global.location') }}</label>
                                        <input type="text" name="location_ar" class="form-control mb-2 w-100"
                                               value="{{ isset($work) ? $work->translate('ar')->location : '' }}" />
                                    </div>
                                    <div>
                                        <label class="form-label">{{ __('admin.global.client_name') }}</label>
                                        <input type="text" name="client_name_ar" class="form-control mb-2 w-100"
                                               value="{{ isset($work) ? $work->translate('ar')->client_name : '' }}" />
                                    </div>
                                    <div>
                                        <label class="form-label">{{ __('admin.global.overview') }}</label>
                                        <textarea name="overview_ar" id="summernote1">{{ isset($work) ? $work->translate('ar')->overview : '' }}</textarea>
                                    </div>
                                </div>
                                <!-- English Tab -->
                                <div class="tab-pane fade arabic-tab {{($lang == 'ar') ? '' : 'active show en'}}" id="name_and_description_en" role="tabpanel">
                                    <div class="row">
                                        <div class="col-md-12 fv-row fv-plugins-icon-container">
                                            <div class="mb-5 fv-row">
                                                <label class="required form-label">{{ __('admin.global.title') }}</label>
                                                <input type="text" name="title_en" id="title_en" class="form-control mb-2"
                                                       placeholder="{{ __('admin.global.title') }}"
                                                       value="{{ isset($work) ? $work->translate('en')->title : '' }}" />
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <label class="form-label">{{ __('admin.global.description') }}</label>
                                        <textarea name="description_en" id="summernote_en">{{ isset($work) ? $work->translate('en')->description : '' }}</textarea>
                                    </div>
                                    <div>
                                        <label class="form-label">{{ __('admin.global.location') }}</label>
                                        <input type="text" name="location_en" class="form-control mb-2 w-100"
                                               placeholder="{{ __('admin.global.location') }}"
                                               value="{{ isset($work) ? $work->translate('en')->location : '' }}" />
                                    </div>
                                    <div>
                                        <label class="form-label">{{ __('admin.global.client_name') }}</label>
                                        <input type="text" name="client_name_en" class="form-control mb-2 w-100"
                                               placeholder="{{ __('admin.global.client_name') }}"
                                               value="{{ isset($work) ? $work->translate('en')->client_name : '' }}" />
                                    </div>
                                    <div>
                                        <label class="form-label">{{ __('admin.global.overview') }}</label>
                                        <textarea name="overview_en" id="summernote1_en">{{ isset($work) ? $work->translate('en')->overview : '' }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Media Upload Tab -->
                <div class="tab-pane fade" id="media" role="tabpanel">
                    <div class="d-flex flex-column gap-5 mb-5">
                        <div class="card card-flush generalDataTap draggable-zone">
                            <div class="salesTitle">
                                <h3>إضافة صور للمقال</h3>
                            </div>
                            <!--begin::Repeater-->
                            <div class="mx-5" id="media_repeater">
                                <div class="form-group draggable">
                                    <div data-repeater-list="media_repeater">
                                        @if(isset($work) && $work->images->count())
                                            @foreach ($work->images as $image)
                                                <div data-repeater-item class="draggable" style="border: 1px solid #988f8f40; border-radius: 10px; margin: 20px; padding: 15px; width: fit-content;">
                                                    <div class="form-group row mb-5">
                                                        <div class="card-toolbar">
                                                            <a href="#" class="btn btn-icon btn-hover-light-primary draggable-handle">
                                    <span class="svg-icon svg-icon-2x">
                                        <!-- أيقونة السحب -->
                                    </span>
                                                            </a>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="image-input image-input-empty" data-kt-image-input="true" style="background-image:  url({{ getImageUrl($image->path, 'medium') }})">
                                                                <div class="image-input-wrapper w-125px h-125px"></div>
                                                                <input name="id" value="{{ $image->id }}" type="hidden"/>
                                                                <label class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                                                       data-kt-image-input-action="change" data-bs-toggle="tooltip" data-bs-dismiss="click" title="Change avatar">
                                                                    <i class="bi bi-pencil-fill fs-7"></i>
                                                                    <input type="file" name="image" accept=".png, .jpg, .jpeg" />
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
                                                            <a href="javascript:;" data-repeater-delete class="btn btn-sm btn-light-danger mt-3 mt-md-9">
                                                                <i class="la la-trash-o fs-3"></i> حذف
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
                                        <i class="la la-plus"></i> إضافة
                                    </a>
                                </div>
                            </div>

                            <!--end::Repeater-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
    <script src="{{ asset('admin_assets/js/dashboard/handleSubmitForm.js') }}"></script>
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
        $(function () {
            $("#select2_category").select2();
        });
    </script>
@endpush
