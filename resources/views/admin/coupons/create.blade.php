@extends('admin.layouts.master', ['is_active_parent' => 'coupons','is_active'=> 'coupons'])
@section('title')
    {{ __('admin.global.add_new_coupon') }}
@endsection
@section('content')
    <form id="kt_form" class="form row" data-kt-redirect="{{ route('admin.coupons.index') }}"
            action="{{ isset($coupon) ? route('admin.coupons.update' ,  $coupon->id) : route('admin.coupons.store') }}">
        @csrf
        @isset($coupon)
            @method('PATCH')
        @endif

        <div class="page-content-header">
            <h2 class="table-title">{{ __('admin.global.add_new_coupon') }}</h2>
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
                                name="status" @if(isset($coupon) && $coupon->status == 1) checked="checked" @endif value="1" >
                            <span class="form-check-label fw-bold text-muted"></span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex flex-column flex-row-fluid gap-3 col-lg-9">
            <div class="d-flex flex-column gap-5">
                <div class="card card-flush generalDataTap">
                    {{-- <div class="salesTitle">
                        <h3>{{__('admin.global.name_and_description')}}</h3>
                    </div> --}}
                    <div class="card-body pt-0">
                        <div class="mt-5">
                            <div class="row">
                                <div class="col-md-12 fv-row fv-plugins-icon-container ">
                                    <div class="mb-5 fv-row">
                                        <label class="required form-label">{{ __('admin.global.coupon_name') }}</label>
                                        <input type="text" name="name" class="form-control mb-2 w-100"
                                            placeholder="{{ __('admin.global.coupon_name') }}"
                                            value="{{ isset($coupon) ? $coupon->name: '' }}" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 fv-row fv-plugins-icon-container ">
                                    <div class="mb-5 fv-row">
                                        <label class="required form-label">{{ __('admin.global.code') }}</label>
                                        <input type="text" name="code" class="form-control mb-2 w-100"
                                            placeholder="{{ __('admin.global.code') }}"
                                            value="{{ isset($coupon) ? $coupon->code: '' }}" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 fv-row fv-plugins-icon-container ">
                                    <div class="mb-5 fv-row">
                                        <label class="required form-label">{{ __('admin.global.start_date') }}</label>
                                        <input type="date" name="start_date" class="form-control mb-2 w-100"
                                            placeholder="{{ __('admin.global.start_date') }}"
                                            value="{{ isset($coupon) ? $coupon->start_date: '' }}" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 fv-row fv-plugins-icon-container ">
                                    <div class="mb-5 fv-row">
                                        <label class="required form-label">{{ __('admin.global.end_date') }}</label>
                                        <input type="date" name="end_date" class="form-control mb-2 w-100"
                                            placeholder="{{ __('admin.global.end_date') }}"
                                            value="{{ isset($coupon) ? $coupon->end_date: '' }}" />
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
                                                <option value="{{$discount_type}}" @isset($coupon) {{ $coupon->discount_type == $discount_type ? 'selected' : '' }} @endisset>
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
                                        <label class="required form-label">{{ __('admin.form.value') }}</label>
                                        <input type="text" name="discount_value" class="form-control mb-2 w-100"
                                            placeholder="{{ __('admin.form.value') }}"
                                            value="{{ isset($coupon) ? $coupon->discount_value:'' }}" />
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
                            <a href="{{ route('admin.coupons.index') }}" id="kt_ecommerce_add_product_cancel"
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

    <script>
        $(function () {
            $("#discount_type").select2();
        });
    </script>
@endpush
