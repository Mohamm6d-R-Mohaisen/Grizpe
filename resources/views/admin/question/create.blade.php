@extends('admin.layouts.master', ['is_active_parent' => 'questions','is_active'=> 'questions'])
@section('title')
    {{ __('admin.global.add_new_category') }}
@endsection
@section('content')
    <form id="kt_form" class="form row d-flex flex-column flex-lg-row addForm" data-kt-redirect="{{ route('admin.questions.index') }}"
            action="{{ isset($question) ? route('admin.questions.update' ,  $question->id) : route('admin.questions.store') }}">
        @csrf
        @isset($question)
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
                            <input type="hidden" name="status" value="0">
                            <input class="form-check-input btn active_operation" style="margin: 0 auto;" type="checkbox"
                                name="status" @if(isset($question) && $question->status == 'active') checked="checked" @endif value="1" >
                            <span class="form-check-label fw-bold text-muted"></span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="">
                <label class="form-label">Slecte Type</label>
                <select name="type" class="form-control">
                    @if(isset($question) && $question->type)
                        <option></option>
                        <option value="home" @selected($question->type == 'home')>Home</option>
                        <option value="about" @selected($question->type == 'about')>About</option>
                        <option value="service" @selected($question->type == 'service')>Service</option>
                        <option value="work" @selected($question->type == 'work')>Work</option>
                        <option value="fag" @selected($question->type == 'fag')>Fag</option>
                        <option value="pricing" @selected($question->type == 'pricing')>Pricing</option>
                        <option value="blog" @selected($question->type == 'blog')>Blog</option>
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
                                            <label class="required form-label">{{ __('admin.global.category_name') }}</label>
                                            <input type="text" name="title_ar" class="form-control mb-2 w-100"
                                                placeholder="{{ __('admin.global.category_name') }}"
                                                value="{{ isset($question) ? $question->translate('ar')->title : '' }}" />
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <label class="form-label">{{ __('admin.global.category_description') }} </label>
                                    <textarea name="description_ar" class="form-control" ">{{ isset($question) ? $question->translate('ar')->description : '' }}</textarea>
                                </div>
{{--                                <div class="">--}}
{{--                                    <label class="form-label">Slecte Type</label>--}}
{{--                                    <select name="type" class="form-control">--}}
{{--                                        @if(isset($slider) && $slider->type)--}}
{{--                                            <option></option>--}}
{{--                                            <option value="home" @selected($slider->type == 'home')>Home</option>--}}
{{--                                            <option value="about" @selected($slider->type == 'about')>About</option>--}}
{{--                                            <option value="service" @selected($slider->type == 'service')>Service</option>--}}
{{--                                            <option value="work" @selected($slider->type == 'work')>Work</option>--}}
{{--                                            <option value="fag" @selected($slider->type == 'fag')>Fag</option>--}}
{{--                                            <option value="pricing" @selected($slider->type == 'pricing')>Pricing</option>--}}
{{--                                            <option value="blog" @selected($slider->type == 'blog')>Blog</option>--}}
{{--                                        @else--}}
{{--                                            <option></option>--}}
{{--                                            <option value="home">Home</option>--}}
{{--                                            <option value="about">About</option>--}}
{{--                                            <option value="service">Service</option>--}}
{{--                                            <option value="work">Work</option>--}}
{{--                                            <option value="fag">Fag</option>--}}
{{--                                            <option value="pricing">Pricing</option>--}}
{{--                                            <option value="blog">Blog</option>--}}
{{--                                        @endif--}}
{{--                                    </select>--}}
{{--                                </div>--}}
                            </div>
                            <div class="tab-pane fade arabic-tab {{($lang == 'ar') ? '' : 'active show en'}}" id="name_and_description_en" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-12 fv-row fv-plugins-icon-container ">
                                        <div class="mb-5 fv-row">
                                            <label class="required form-label">
                                                {{ __('admin.global.category_name') }}
                                            </label>
                                            <input type="text" name="title_en" id="title_en" class="form-control mb-2"
                                                placeholder="{{ __('admin.global.category_name') }}"
                                                value="{{ isset($question) ? $question->translate('en')->title : '' }}" />
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <label class="form-label">{{ __('admin.global.category_description') }}</label>
                                    <textarea name="description_en" class="form-control">{{ isset($question) ? $question->translate('en')->description : '' }}</textarea>
                                </div>
{{--                                <div class="">--}}
{{--                                    <label class="form-label">Slecte Type</label>--}}
{{--                                    <select name="" class="form-control">--}}
{{--                                        @if(isset($slider) && $slider->type)--}}
{{--                                            <option></option>--}}
{{--                                            <option value="home" @selected($slider->type == 'home')>Home</option>--}}
{{--                                            <option value="about" @selected($slider->type == 'about')>About</option>--}}
{{--                                            <option value="service" @selected($slider->type == 'service')>Service</option>--}}
{{--                                            <option value="work" @selected($slider->type == 'work')>Work</option>--}}
{{--                                            <option value="fag" @selected($slider->type == 'fag')>Fag</option>--}}
{{--                                            <option value="pricing" @selected($slider->type == 'pricing')>Pricing</option>--}}
{{--                                            <option value="blog" @selected($slider->type == 'blog')>Blog</option>--}}
{{--                                        @else--}}
{{--                                            <option></option>--}}
{{--                                            <option value="home">Home</option>--}}
{{--                                            <option value="about">About</option>--}}
{{--                                            <option value="service">Service</option>--}}
{{--                                            <option value="work">Work</option>--}}
{{--                                            <option value="fag">Fag</option>--}}
{{--                                            <option value="pricing">Pricing</option>--}}
{{--                                            <option value="blog">Blog</option>--}}
{{--                                        @endif--}}
{{--                                    </select>--}}
{{--                                </div>--}}
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
                    <a href="{{ route('admin.questions.index') }}" id="kt_ecommerce_add_product_cancel"
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
