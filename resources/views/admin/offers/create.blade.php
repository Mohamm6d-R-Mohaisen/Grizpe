@extends('admin.layouts.master', ['is_active_parent' => 'offers','is_active'=> 'offers'])
@section('title')
    {{ __('admin.global.add_new_offer') }}
@endsection
@section('content')
    <form id="kt_form" class="form row" data-kt-redirect="{{ route('admin.offers.index') }}"
            action="{{ isset($offer) ? route('admin.offers.update' ,  $offer->id) : route('admin.offers.store') }}">
        @csrf
        @isset($offer)
            @method('PATCH')
        @endif

        <div class="page-content-header">
            <h2 class="table-title">{{ __('admin.global.add_new_offer') }}</h2>
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
                                name="status" @if(isset($offer) && $offer->status == 1) checked="checked" @endif value="1" >
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
                                            <label class="required form-label">{{ __('admin.global.offer_name') }}</label>
                                            <input type="text" name="name_ar" class="form-control mb-2 w-100"
                                                placeholder="{{ __('admin.global.offer_name') }}"
                                                value="{{ isset($offer) ? optional($offer)->translate('ar')->name ?? '' : '' }}" />
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <label class="form-label">{{ __('admin.global.offer_description') }} </label>
                                    <textarea name="description_ar" id="summernote1">{{ isset($offer) ? optional($offer)->translate('ar')->description ?? '' : '' }}</textarea>
                                </div>
                            </div>
                            <div class="tab-pane fade arabic-tab {{($lang == 'ar') ? '' : 'active show en'}}" id="name_and_description_en" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-12 fv-row fv-plugins-icon-container ">
                                        <div class="mb-5 fv-row">
                                            <label class="required form-label">
                                                {{ __('admin.global.offer_name') }}
                                            </label>
                                            <input type="text" name="name_en" id="name_en" class="form-control mb-2"
                                                placeholder="{{ __('admin.global.offer_name') }}"
                                                value="{{ isset($offer) ? optional($offer)->translate('en')->name ?? '' : '' }}" />
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <label class="form-label">{{ __('admin.global.offer_description') }}</label>
                                    <textarea name="description_en" id="summernote1_en">{{ isset($offer) ? optional($offer)->translate('en')->description ?? '' : '' }}</textarea>
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
                                        <label class="required form-label">{{ __('admin.global.start_date') }}</label>
                                        <input type="date" name="start_date" class="form-control mb-2 w-100"
                                            placeholder="{{ __('admin.global.start_date') }}"
                                            value="{{ isset($offer) ? $offer->start_date: '' }}" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 fv-row fv-plugins-icon-container ">
                                    <div class="mb-5 fv-row">
                                        <label class="required form-label">{{ __('admin.global.end_date') }}</label>
                                        <input type="date" name="end_date" class="form-control mb-2 w-100"
                                            placeholder="{{ __('admin.global.end_date') }}"
                                            value="{{ isset($offer) ? $offer->end_date: '' }}" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 fv-row fv-plugins-icon-container ">
                                    <div class="mb-5 fv-row">
                                        <label class="required form-label">{{ __('admin.global.discount_type') }}</label>
                                        <select class="form-select mb-2" id="discount_type" name="discount_type" data-kt-repeater="select2"
                                            data-placeholder="{{ __('admin.global.discount_type') }}" data-allow-clear="true">
                                            <option></option>
                                            @foreach($discount_types as $discount_type)
                                                <option value="{{$discount_type}}" @isset($offer) {{ $offer->discount_type == $discount_type ? 'selected' : '' }} @endisset>
                                                    {{ __('admin.global.' . $discount_type) }}
                                                </option>
                                            @endforeach
                                        </select> 
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 fv-row fv-plugins-icon-container ">
                                    <div class="mb-5 fv-row">
                                        <label class="required form-label">{{ __('admin.global.discount_value') }}</label>
                                        <input type="text" name="discount_value" class="form-control mb-2 w-100"
                                            placeholder="{{ __('admin.global.discount_value') }}"
                                            value="{{ isset($offer) ? $offer->discount_value:'' }}" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 fv-row fv-plugins-icon-container ">
                                    <div class="mb-5 fv-row">
                                        <label class="form-label">{{ __('admin.global.product') }}</label>
                                        <select class="form-select mb-2" id="products" multiple="multiple" name="products[]" data-kt-repeater="select2"
                                            data-placeholder="{{ __('admin.global.product') }}" data-allow-clear="true">
                                            <option></option>
                                            @if(isset($offer))
                                                @foreach($products as $product)
                                                    <option value="{{ $product->id }}" 
                                                        {{ in_array($product->id, $offer->products->pluck('id')->toArray()) ? 'selected' : '' }}>
                                                        {{ $product->name }}
                                                    </option>
                                                @endforeach
                                            @else
                                                @foreach($products as $product)
                                                    <option value="{{$product->id}}">
                                                        {{ $product->name }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select> 
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 fv-row fv-plugins-icon-container ">
                                    <div class="mb-5 fv-row">
                                        <label class="form-label">{{ __('admin.global.category') }}</label>
                                        <select class="form-select mb-2" id="categories" name="categories[]" multiple="multiple" data-kt-repeater="select2"
                                            data-placeholder="{{ __('admin.global.category') }}" data-allow-clear="true">
                                            <option></option>
                                            @if(isset($offer))
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}" 
                                                        {{ in_array($category->id, $offer->categories->pluck('id')->toArray()) ? 'selected' : '' }}>
                                                        {{ $category->name }}
                                                    </option>
                                                @endforeach
                                            @else
                                                @foreach($categories as $category)
                                                    <option value="{{$category->id}}">
                                                        {{ $category->name }}
                                                    </option>
                                                @endforeach
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
                            <a href="{{ route('admin.offers.index') }}" id="kt_ecommerce_add_product_cancel"
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
