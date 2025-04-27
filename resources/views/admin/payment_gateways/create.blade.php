@extends('admin.layouts.master', ['is_active_parent' => 'payment_gateways','is_active'=> 'payment_gateways'])
@section('title')
    {{ __('admin.global.add_new_payment_gateway') }}
@endsection
@section('content')
    <form id="kt_form" class="form" data-kt-redirect="{{ route('admin.payment_gateways.index') }}"
            action="{{ isset($payment_gateway) ? route('admin.payment_gateways.update' ,  $payment_gateway->id) : route('admin.payment_gateways.store') }}">
        @csrf
        @isset($payment_gateway)
            @method('PATCH')
        @endif
        <div class="page-content-header">
            <h2 class="table-title">{{ __('admin.global.add_new_payment_gateway') }}</h2>
        </div>

        <div class="d-flex flex-column flex-row-fluid gap-3 col-lg-12">
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
                                            <label class="required form-label">{{ __('admin.global.payment_gateway_name') }}</label>
                                            <input type="text" name="name_ar" class="form-control mb-2 w-100"
                                                placeholder="{{ __('admin.global.payment_gateway_name') }}"
                                                value="{{ isset($payment_gateway) ? $payment_gateway->translate('ar')->name : '' }}" />
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <label class="form-label">{{ __('admin.global.payment_gateway_description') }} </label>
                                    <textarea name="description_ar" id="summernote">{{ isset($payment_gateway) ? $payment_gateway->translate('ar')->description : '' }}</textarea>
                                </div>
                            </div>
                            <div class="tab-pane fade arabic-tab {{($lang == 'ar') ? '' : 'active show en'}}" id="name_and_description_en" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-12 fv-row fv-plugins-icon-container ">
                                        <div class="mb-5 fv-row">
                                            <label class="required form-label">
                                                {{ __('admin.global.payment_gateway_name') }}
                                            </label>
                                            <input type="text" name="name_en" id="name_en" class="form-control mb-2"
                                                placeholder="{{ __('admin.global.payment_gateway_name') }}"
                                                value="{{ isset($payment_gateway) ? $payment_gateway->translate('en')->name : '' }}" />
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <label class="form-label">{{ __('admin.global.payment_gateway_description') }}</label>
                                    <textarea name="description_en" id="summernote_en">{{ isset($payment_gateway) ? $payment_gateway->translate('en')->description : '' }}</textarea>
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
                                        <label class="required form-label">STRIPE KEY</label>
                                        <input type="text" name="STRIPE_KEY" class="form-control mb-2 w-100"
                                            placeholder="STRIPE KEY"
                                            value="{{ isset($payment_gateway) ? $credentials['STRIPE_KEY']:'' }}" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 fv-row fv-plugins-icon-container ">
                                    <div class="mb-5 fv-row">
                                        <label class="required form-label">STRIPE SECRET</label>
                                        <input type="text" name="STRIPE_SECRET" class="form-control mb-2 w-100"
                                            placeholder="STRIPE SECRET"
                                            value="{{ isset($payment_gateway) ? $credentials['STRIPE_SECRET']:'' }}" />
                                    </div>
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
                    <a href="{{ route('admin.payment_gateways.index') }}" id="kt_ecommerce_add_product_cancel"
                        class="btn btn-light me-5 cancel">{{ __('admin.form.cancel') }}</a>
                </div>
            </div>
        </div>

    </form>
@endsection
@push('scripts')
    <script src="{{ asset('admin_assets/js/dashboard/handleSubmitForm.js') }}"></script>
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
