@extends('admin.layouts.master', ['is_active_parent' => 'orders','is_active'=> 'orders'])
@section('title')
    {{ __('admin.global.add_new_order') }}
@endsection
@section('content')
    <form id="kt_form" class="form" data-kt-redirect="{{ route('admin.orders.index') }}"
            action="{{ isset($order) ? route('admin.orders.update' ,  $order->id) : route('admin.orders.store') }}">
        @csrf
        @isset($order)
            @method('PATCH')
        @endif

        <div class="">
            <div class="page-content-header">
                <h2 class="table-title">{{ __('admin.global.add_new_order') }}</h2>
            </div>
            <div class="card card-flush">
                <div class="card-body">
                    <div class="new-user-form" id="new-user-form">
                        <div class="formContent">
                            <div class="row g-9 mb-7">
                                <div class=" fv-row fv-plugins-icon-container">
                                    <label class="required fs-6 fw-semibold mb-2">{{ __('admin.global.user') }}</label>
                                    <select class="form-select mb-2" id="select2_user" name="user_id"
                                        data-placeholder="{{ isset($order) ? $order->user->full_name: __('admin.global.user') }}" data-allow-clear="true">
                                        <option></option>
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}" @isset($order) {{ $order->user_id == $user->id ? 'selected' : '' }} @endisset>
                                                {{ $user->full_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card card-flush mt-7">
                <div class="salesTitle">
                    <h3>إضافة منتجات للطلب</h3>
                </div>
                <!--begin::Repeater-->
                <div class="mx-5 " id="products_repeater">
                    @if(isset($order) && $order->products->count() > 0)
                        @foreach($order->products as $order_product) 
                            <div class="form-group">
                                <div data-repeater-list="products_repeater">
                                    <div data-repeater-item class="data-repeater-item" style="border: 1px solid #988f8f40;border-radius: 10px;margin: 20px;padding: 15px;">
                                        <div class="form-group row mb-5 ">
                                            <div class="col-md-4">
                                                <label class="form-label">المنتج</label>
                                                <select class="form-select mb-2 products" id="products" name="product_id" data-kt-repeater="select2" 
                                                    data-placeholder="{{ $order_product->name }}" data-allow-clear="true">
                                                    <option></option>
                                                    @foreach($products as $product)
                                                        <option value="{{$product->id}}" @isset($order) {{ $order_product->id == $product->id ? 'selected' : '' }} @endisset>
                                                            {{ $product->name }}
                                                        </option>
                                                    @endforeach
                                                </select>                                            
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">الكمية</label>
                                                <input type="text" name="quantity" class="form-control" id="">                                      
                                            </div>
                                            <div class="col-md-2">
                                                <a href="javascript:;" data-repeater-delete class="btn btn-sm btn-light-danger mt-3 mt-md-9">
                                                    <i class="la la-trash-o fs-3"></i>حذف
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="form-group">
                            <div data-repeater-list="products_repeater">
                                <div data-repeater-item class="data-repeater-item" style="border: 1px solid #988f8f40;border-radius: 10px;margin: 20px;padding: 15px;">
                                    <div class="form-group row mb-5 ">
                                        <div class="col-md-4">
                                            <label class="form-label">المنتج</label>
                                            <select class="form-select mb-2 products" id="products" name="product_id" data-kt-repeater="select2"
                                                data-placeholder="{{ __('admin.global.product') }}" data-allow-clear="true">
                                                <option></option>
                                                @foreach($products as $product)
                                                    <option value="{{$product->id}}" @isset($order) {{ $order->product->id == $product->id ? 'selected' : '' }} @endisset>
                                                        {{ $product->name }}
                                                    </option>
                                                @endforeach
                                            </select>                                            
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">الكمية</label>
                                            <input type="text" name="quantity" class="form-control" id="">                                            
                                        </div>
                                        <div class="col-md-2">
                                            <a href="javascript:;" data-repeater-delete class="btn btn-sm btn-light-danger mt-3 mt-md-9">
                                                <i class="la la-trash-o fs-3"></i>حذف
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
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
                        <a href="{{ route('admin.orders.index') }}" id="kt_ecommerce_add_order_cancel"
                            class="btn btn-light me-5 cancel">{{ __('admin.form.cancel') }}</a>
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

    <script>
        $(function () {
            $("#select2_user").select2();
        });
    </script>
    <script>
        $(function () {
            $('#products_repeater').repeater({
                initEmpty: false,
                show: function () {
                    $(this).slideDown();
                    $(this).find('.products').select2();
                },

                hide: function (deleteElement) {
                    $(this).slideUp(deleteElement);
                },

                ready: function(){
                    $(this).find('.products').select2();
                }
            });        
        });
    </script>
@endpush
