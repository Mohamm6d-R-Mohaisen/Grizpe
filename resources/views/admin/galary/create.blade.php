@extends('admin.layouts.master', ['is_active_parent' => 'galaries','is_active'=> 'galaries'])
@section('title')
    {{ __('admin.global.add_new_category') }}
@endsection
@section('content')
    <form id="kt_form" class="form row d-flex flex-column flex-lg-row addForm" data-kt-redirect="{{ route('admin.galaries.index') }}"
            action="{{ isset($galary) ? route('admin.galaries.update' ,  $galary->id) : route('admin.galaries.store') }}">
        @csrf
        @isset($slider)
            @method('PATCH')
        @endif

        <div class="page-content-header">
            <h2 class="table-title">{{ __('admin.global.add_new_adds') }}</h2>
        </div>

        <div class="d-flex flex-column gap-5 col-lg-3 mb-7 ">
            <div class="card card-flush">
                <div class="card-header">
                    <div class="card-title ">
                        <h3>{{__('admin.form.status')}}</h3>
                    </div>
                    <div class="card-toolbar">
                        <label class="form-check form-switch form-check-custom form-check-solid">
                            <input type="hidden" name="status" value="inactive">
                            <input class="form-check-input btn active_operation" style="margin: 0 auto;" type="checkbox"
                                name="status" @if(isset($galary) && $galary->status == 'active') checked="checked" @endif value="active" >
                            <span class="form-check-label fw-bold text-muted"></span>
                        </label>
                    </div>
                </div>

            </div>

            <div class="card card-flush">
                <div class="card-header card-header justify-content-center p-5">
                    <div class="card-toolbar">
                        <div class="image-input image-input-outline image-input-placeholder image-input-empty" data-kt-image-input="true">
                            <!--begin::Preview existing avatar-->
                            <div class="image-input-wrapper w-200px h-200px" style="background-image: url(@if(isset($galary) && $galary->image !== null) {{ asset($galary->image) }} @else {{ asset('admin_assets/media/svg/avatars/blank.svg') }} @endif)"></div>
                            <!--end::Preview existing avatar-->
                            <!--begin::Edit-->
                            <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                                <i class="bi bi-pencil-fill fs-7"></i>
                                <!--begin::Inputs-->
                                <input type="file" name="image" accept=".png, .jpg, .jpeg" />
                                {{-- <input type="hidden" name="avatar_remove" /> --}}
                                <!--end::Inputs-->
                            </label>
                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
                                <i class="bi bi-x fs-2"></i>
                            </span>

                            <!--end::Edit-->
                            <!--begin::Cancel-->

                            <!--end::Cancel-->
                            <!--begin::Remove-->
                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
                                <i class="bi bi-x fs-2"></i>
                            </span>
                            <!--end::Remove-->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex flex-column flex-row-fluid gap-3 col-lg-9">
            <div class="d-flex flex-column gap-5">
                <div class="card card-flush generalDataTap">
                    <div class="">
                        <label class="form-label">Slecte Type</label>
                        <select name="type" class="form-control">
                            @if(isset($galary) && $galary->type)
                                <option></option>
                                <option value="home" @selected($galary->type == 'home')>Home</option>
                                <option value="about" @selected($galary->type == 'about')>About</option>
                                <option value="service" @selected($galary->type == 'service')>Service</option>
                                <option value="work" @selected($galary->type == 'work')>Work</option>
                                <option value="fag" @selected($galary->type == 'fag')>Fag</option>
                                <option value="pricing" @selected($galary->type == 'pricing')>Pricing</option>
                                <option value="blog" @selected($galary->type == 'blog')>Blog</option>
                            @else
                                <option></option>
                                <option value="home">Home</option>
                                <option value="about">About</option>
                                <option value="service">Service</option>
                                <option value="work">Work</option>
                                <option value="fag">Fag</option>
                                <option value="pricing">Pricing</option>
                                <option value="blog">Blog</option>
                            @endif
                        </select>
                    </div>
                    <div class="">
                        <label class="form-label">Slecte Sub Type</label>
                        <select name="sub_type" class="form-control">
                            @if(isset($galary) && $galary->type)
                                <option></option>
                                <option value="main" @selected($galary->sub_type == 'main')>Main</option>
                                <option value="slider" @selected($galary->sub_type == 'slider')>Slider</option>
                                <option value="aside" @selected($galary->sub_type == 'aside')>Aside</option>
                                <option value="footer" @selected($galary->sub_type == 'footer')>Footer</option>

                            @else
                                <option></option>
                                <option value="main">Main</option>
                                <option value="slider">Slider</option>
                                <option value="aside">Aside</option>
                                <option value="footer">Footer</option>

                            @endif
                        </select>
                    </div>


                        </div>
                    </div>
                </div>
            </div>
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
                    <a href="{{ route('admin.galaries.index') }}" id="kt_ecommerce_add_product_cancel"
                        class="btn btn-light me-5 cancel">{{ __('admin.form.cancel') }}</a>
                </div>
            </div>
        </div>
    </form>
@endsection
@push('scripts')
    <script src="{{ asset('admin_assets/js/dashboard/handleSubmitForm.js') }}"></script>
    <script src="{{ asset('admin_assets/js/summernote-lite.min.js') }}"></script>

    <script>
        $('#summernote').summernote({
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
        $('#summernote_en').summernote({
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
@endpush
