@extends('admin.layouts.master', ['is_active_parent' => 'blogs','is_active'=> 'blogs'])
@section('title')
    {{ isset($blog) ? __('admin.global.edit_post') : __('admin.global.add_new_post') }}
@endsection
@section('content')
    <form id="kt_form" class="form row d-flex flex-column flex-lg-row addForm" data-kt-redirect="{{ route('admin.blogs.index') }}"
          action="{{ isset($blog) ? route('admin.blogs.update', $blog->id) : route('admin.blogs.store') }}">
        @csrf
        @isset($blog)
            @method('PATCH')
        @endif
        <div class="page-content-header">
            <h2 class="table-title">{{ isset($blog) ? __('admin.global.edit_post') : __('admin.global.add_new_post') }}</h2>
        </div>
        <div class="d-flex flex-column gap-5 col-lg-3 mb-7 ">
            <!-- Status Field -->
            <div class="card card-flush">
                <div class="card-header">
                    <div class="card-title ">
                        <h3>{{__('admin.form.status')}}</h3>
                    </div>
                    <div class="card-toolbar">
                        <label class="form-check form-switch form-check-custom form-check-solid">
                            <input type="hidden" name="status" value="inactive">
                            <input class="form-check-input btn active_operation" style="margin: 0 auto;" type="checkbox"
                                   name="status" @if(isset($blog) && $blog->status == 'active') checked="checked" @endif value="active">
                            <span class="form-check-label fw-bold text-muted"></span>
                        </label>
                    </div>
                </div>
            </div>
            <!-- Image Field -->
            <div class="card card-flush">
                <div class="card-header card-header justify-content-center p-5">
                    <div class="card-toolbar">
                        <div class="image-input image-input-outline image-input-placeholder image-input-empty" data-kt-image-input="true">
                            <div class="image-input-wrapper w-200px h-200px" style="background-image: url(@if(isset($blog) && $blog->image !== null) {{ asset($blog->image) }} @else {{ asset('admin_assets/media/svg/avatars/blank.svg') }} @endif)"></div>
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
            <!-- Category Field -->
            <div class="card card-flush">
                <div class="card-header">
                    <div class="card-title ">
                        <h3>{{__('admin.form.category')}}</h3>
                    </div>
                    <div class="card-body">
                        <select name="category_id" class="form-select">
                            @foreach($categories as $category)
                                <option></option>
                                <option value="{{ $category->id }}" @if(isset($blog) && $blog->category_id == $category->id) selected @endif>
                                    {{ $category->translate(App::getLocale())->name }}
                                </option>
                            @endforeach
                        </select>
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
                        <div class="tab-content mt-5" id="myTabContent">
                            <!-- Arabic Tab -->
                            <div class="tab-pane fade generalTap-pane {{($lang == 'ar') ? 'active show ar' : ''}}" id="name_and_description_ar" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-12 fv-row fv-plugins-icon-container ">
                                        <div class="mb-5 fv-row">
                                            <label class="required form-label">{{ __('admin.global.author_name') }}</label>
                                            <input type="text" name="author_name_ar" class="form-control mb-2 w-100"
                                                   placeholder="{{ __('admin.global.author_name') }}"
                                                   value="{{ isset($blog) ? $blog->translate('ar')->author_name : '' }}" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 fv-row fv-plugins-icon-container ">
                                        <div class="mb-5 fv-row">
                                            <label class="required form-label">{{ __('admin.global.title') }}</label>
                                            <input type="text" name="title_ar" class="form-control mb-2 w-100"
                                                   placeholder="{{ __('admin.global.title') }}"
                                                   value="{{ isset($blog) ? $blog->translate('ar')->title : '' }}" />
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <label class="form-label">{{ __('admin.global.content') }}</label>
                                    <textarea name="content_ar" class="form-control">{{ isset($blog) ? $blog->translate('ar')->content : '' }}</textarea>
                                </div>
                                <div>
                                    <label class="form-label">{{ __('admin.global.quotation') }}</label>
                                    <textarea name="quotation_ar" class="form-control">{{ isset($blog) ? $blog->translate('ar')->quotation : '' }}</textarea>
                                </div>
                                <div>
                                    <label class="form-label">{{ __('admin.global.lessons') }}</label>
                                    <textarea name="lessons_ar" class="form-control">{{ isset($blog) ? $blog->translate('ar')->lessons : '' }}</textarea>
                                </div>
                                <div>
                                    <label class="form-label">{{ __('admin.global.short_description') }}</label>
                                    <textarea name="short_description_ar" class="form-control">{{ isset($blog) ? $blog->translate('en')->short_description: '' }}</textarea>
                                </div>
                                <div>
                                    <label class="form-label">{{ __('admin.global.conclusions') }}</label>
                                    <textarea name="conclusions_ar" class="form-control">{{ isset($blog) ? $blog->translate('en')->conclusions: '' }}</textarea>
                                </div>
                            </div>
                            <!-- English Tab -->
                            <div class="tab-pane fade arabic-tab {{($lang == 'ar') ? '' : 'active show en'}}" id="name_and_description_en" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-12 fv-row fv-plugins-icon-container ">
                                        <div class="mb-5 fv-row">
                                            <label class="required form-label">{{ __('admin.global.author_name') }}</label>
                                            <input type="text" name="author_name_en" class="form-control mb-2 w-100"
                                                   placeholder="{{ __('admin.global.author_name') }}"
                                                   value="{{ isset($blog) ? $blog->translate('en')->author_name : '' }}" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 fv-row fv-plugins-icon-container ">
                                        <div class="mb-5 fv-row">
                                            <label class="required form-label">{{ __('admin.global.title') }}</label>
                                            <input type="text" name="title_en" id="title_en" class="form-control mb-2"
                                                   placeholder="{{ __('admin.global.title') }}"
                                                   value="{{ isset($blog) ? $blog->translate('en')->title : '' }}" />
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <label class="form-label">{{ __('admin.global.content') }}</label>
                                    <textarea name="content_en" class="form-control">{{ isset($blog) ? $blog->translate('en')->content : '' }}</textarea>
                                </div>
                                <div>
                                    <label class="form-label">{{ __('admin.global.quotation') }}</label>
                                    <textarea name="quotation_en"class="form-control">{{ isset($blog) ? $blog->translate('en')->quotation : '' }}</textarea>
                                </div>
                                <div>
                                    <label class="form-label">{{ __('admin.global.lessons') }}</label>
                                    <textarea name="lessons_en" class="form-control">{{ isset($blog) ? $blog->translate('en')->lessons : '' }}</textarea>
                                </div>
                                <div>
                                    <label class="form-label">{{ __('admin.global.short_description') }}</label>
                                    <textarea name="short_description_en" class="form-control">{{ isset($blog) ? $blog->translate('en')->short_description : '' }}</textarea>
                                </div>
                                <div>
                                    <label class="form-label">{{ __('admin.global.conclusions') }}</label>
                                    <textarea name="conclusions_en" class="form-control">{{ isset($blog) ? $blog->translate('en')->conclusions: '' }}</textarea>
                                </div>

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
                    <a href="{{ route('admin.blogs.index') }}" id="kt_ecommerce_add_product_cancel"
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
            lang: 'en-US',
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
            lang: 'en-US',
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
