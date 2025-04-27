@extends('admin.layouts.master', ['is_active_parent' => 'attributes','is_active'=> 'attributes'])
@section('title')
    {{ __('admin.global.add_new_attribute') }}
@endsection
@section('content')
    <form id="kt_form" class="form row" data-kt-redirect="{{ route('admin.attributes.index') }}"
            action="{{ isset($attribute) ? route('admin.attributes.update' ,  $attribute->id) : route('admin.attributes.store') }}">
        @csrf
        @isset($attribute)
            @method('PATCH')
        @endif

        <div class="page-content-header">
            <h2 class="table-title">{{ __('admin.global.add_new_attribute') }}</h2>
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
                                name="status" @if(isset($attribute) && $attribute->status == 1) checked="checked" @endif value="1" >
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
                                            <label class="required form-label">{{ __('admin.global.attribute_name') }}</label>
                                            <input type="text" name="name_ar" class="form-control mb-2 w-100"
                                                placeholder="{{ __('admin.global.attribute_name') }}"
                                                value="{{ isset($attribute) ? optional($attribute)->translate('ar')->name ?? '' : '' }}" />
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <label class="form-label">{{ __('admin.global.attribute_description') }} </label>
                                    <textarea name="description_ar" id="summernote1">{{ isset($attribute) ? optional($attribute)->translate('ar')->description ?? '' : '' }}</textarea>
                                </div>
                            </div>
                            <div class="tab-pane fade arabic-tab {{($lang == 'ar') ? '' : 'active show en'}}" id="name_and_description_en" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-12 fv-row fv-plugins-icon-container ">
                                        <div class="mb-5 fv-row">
                                            <label class="required form-label">
                                                {{ __('admin.global.attribute_name') }}
                                            </label>
                                            <input type="text" name="name_en" id="name_en" class="form-control mb-2"
                                                placeholder="{{ __('admin.global.attribute_name') }}"
                                                value="{{ isset($attribute) ? optional($attribute)->translate('en')->name ?? '' : '' }}" />
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <label class="form-label">{{ __('admin.global.attribute_description') }}</label>
                                    <textarea name="description_en" id="summernote1_en">{{ isset($attribute) ? optional($attribute)->translate('en')->description ?? '' : '' }}</textarea>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
                {{-- <div class="card card-flush">
                    <div class="card-body">
                        <div class="new-user-form" id="new-user-form">
                            <div class="formContent">
                                <div class="row g-9 mb-7">
                                    <div class=" fv-row fv-plugins-icon-container">
                                        <label class="required fs-6 fw-semibold mb-2">{{ __('admin.global.price') }}</label>
                                        <input class="form-control form-control-solid"  placeholder="{{ __('admin.global.price') }}" name="price" value="{{ isset($attribute) ? $attribute->price:'' }}">
                                    </div>
                                     
                                    <div class=" fv-row fv-plugins-icon-container">
                                        <label class="required fs-6 fw-semibold mb-2">{{ __('admin.form.duration') }}</label>
                                        <input class="form-control form-control-solid" placeholder="{{ __('admin.form.duration') }}" name="duration" value="{{ isset($attribute) ? $attribute->duration:'' }}">
                                    </div>
                                     
                                     
                                     
                                    <div class=" fv-row fv-plugins-icon-container">
                                        <label class="required fs-6 fw-semibold mb-2">{{ __('admin.form.introduction_video') }}</label>
                                        <input type="text" class="form-control form-control-solid" placeholder="انسخ عنوان الفيديو من الفيمو وألصقه هنا" value="{{ isset($attribute) ? $attribute->introduction_video:'' }}" name="introduction_video" >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}

                <div class="page-buttuns mt-5">
                    <div class="row justify-content-between">
                        <div class="d-flex justify-content-end right">
                            <button type="submit" id="kt_submit" class="btn btn-primary">
                                <span class="indicator-label">{{ __('admin.admins.save') }}</span>
                                <span class="indicator-progress">{{ __('admin.admins.please_wait') }}
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                </span>
                            </button>
                            <a href="{{ route('admin.attributes.index') }}" id="kt_ecommerce_add_product_cancel"
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

    {{-- <script src="{{ asset('admin_assets/js/image-input.js') }}"></script> --}}

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
            $("#lc_select2_int").select2();
            $("#i_select2_int").select2();
        });
    </script>
@endpush
