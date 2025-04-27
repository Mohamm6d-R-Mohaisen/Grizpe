@extends('admin.layouts.master', ['is_active_parent' => 'orders', 'is_active' => 'orders'])
@section('title')
    {{ __('admin.global.show_order') }}
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('frontend/assets/css/toastr.min.css')}}"/>
@endsection
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Post-->
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <!--begin::Container-->
            <div id="kt_content_container" class="container-xxl">
                <!--begin::Layout-->
                <div class="d-flex flex-column flex-lg-row">
                    <!--begin::Content-->
                    <div class="flex-lg-row-fluid me-lg-15 order-2 order-lg-1 mb-10 mb-lg-0">
                        <!--begin::Card-->
                        <div class="card card-flush pt-3 mb-5 mb-xl-10">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <!--begin::Card title-->
                                <div class="card-title">
                                    <h2 class="fw-bold">{{ __('admin.global.order_products') }}</h2>
                                </div>
                                <!--begin::Card title-->
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body pt-3">
                             
                                <!--begin::Section-->
                                <div class="mb-0">
                                    <!--begin::Title-->
                                    {{-- <h5 class="mb-4">Subscribed Products:</h5> --}}
                                    <!--end::Title-->
                                    <!--begin::Product table-->
                                    <div class="table-responsive">
                                        <!--begin::Table-->
                                        <table class="table align-middle table-row-dashed fs-6 gy-4 mb-0">
                                            <!--begin::Table head-->
                                            <thead>
                                                <!--begin::Table row-->
                                                <tr class="border-bottom border-gray-200 text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                                    <th class="min-w-150px">{{ __('admin.global.product') }}</th>
                                                    <th class="min-w-125px">{{ __('admin.global.qty') }}</th>
                                                    <th class="min-w-125px">{{ __('admin.form.price') }}</th>
                                                    <th class="min-w-125px">{{ __('admin.global.total') }}</th>
                                                </tr>
                                                <!--end::Table row-->
                                            </thead>
                                            <!--end::Table head-->
                                            <!--begin::Table body-->
                                            <tbody class="fw-semibold text-gray-800">
                                                @foreach ($order->products as $product)
                                                    <tr> 
                                                        <td>
                                                            <label class="w-150px">{{ $product->name }}</label>
                                                        </td>
                                                        <td>{{ $product->pivot->quantity }}</td>
                                                        <td>{{ $product->pivot->price }} ريال</td>
                                                        <td id="total_order">{{ $product->pivot->total }} ريال</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            <!--end::Table body-->
                                            <tfoot >
                                                <tr>
                                                    <th></th>
                                                    <th> </th>
                                                    <th class="text-center">قيمة الخصم</th>
                                                    <th class="text-center">{{ $order->discount }} ريال</th>
                                                </tr>
                                                <tr style="font-weight: 600;">
                                                    <th></th>
                                                    <th> </th>
                                                    <th class="text-center">المجموع النهائي</th>
                                                    <th class="text-center">{{ $order->total }} ريال</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                        <!--end::Table-->
                                    </div>
                                    <!--end::Product table-->
                                </div>
                                <!--end::Section-->
                            </div>
                            <!--end::Card body-->
                        </div>
                        <!--end::Card-->
                    </div>
                    <!--end::Content-->
                    <!--begin::Sidebar-->
                    <div class="flex-column flex-lg-row-auto w-lg-250px w-xl-300px mb-10 order-1 order-lg-2">
                        <!--begin::Card-->
                        <div class="card card-flush mb-0" data-kt-sticky="true"
                            data-kt-sticky-name="subscription-summary"
                            data-kt-sticky-offset="{default: false, lg: '200px'}"
                            data-kt-sticky-width="{lg: '250px', xl: '300px'}" data-kt-sticky-left="auto"
                            data-kt-sticky-top="150px" data-kt-sticky-animation="false" data-kt-sticky-zindex="95">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <!--begin::Card title-->
                                <div class="card-title">
                                    <h2>{{ __('admin.global.summary') }}</h2>
                                </div>
                                <!--end::Card title-->
                                
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body pt-0 fs-6">
                                <!--begin::Section-->
                                <div class="mb-7">
                                    <!--begin::Details-->
                                    <div class="d-flex align-items-center">
                                        <!--begin::Avatar-->
                                        <div class="symbol symbol-60px symbol-circle me-3">
                                            <img alt="Pic" src="{{ isset($order->user->image) ? $order->user->image:asset('admin_assets/media/svg/avatars/blank.svg') }}" />
                                        </div>
                                        <!--end::Avatar-->
                                        <!--begin::Info-->
                                        <div class="d-flex flex-column">
                                            <!--begin::Name-->
                                            <a href="#"
                                                class="fs-4 fw-bold text-gray-900 text-hover-primary me-2">{{ $order->user->full_name }}</a>
                                            <!--end::Name-->
                                            <!--begin::Email-->
                                            <a href="#"
                                                class="fw-semibold text-gray-600 text-hover-primary">{{ $order->user->email }}</a>
                                            <!--end::Email-->
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                    <!--end::Details-->
                                </div>
                                <!--end::Section-->
                                <!--begin::Seperator-->
                                {{-- <div class="separator separator-dashed mb-7"></div> --}}
                                <!--end::Seperator-->
                                <!--begin::Section-->
                                {{-- <div class="mb-7">
                                    <!--begin::Title-->
                                    <h5 class="mb-4">{{ __('admin.global.order_products') }}</h5>
                                    <!--end::Title-->
                                    <!--begin::Details-->
                                    <div class="mb-0">
                                        <!--begin::Plan-->
                                        <span class="badge badge-light-info me-2">ttt</span>
                                        <!--end::Plan-->
                                        <!--begin::Price-->
                                        <span class="fw-semibold text-gray-600">ttt ريال</span>
                                        <!--end::Price-->
                                    </div>
                                    <!--end::Details-->
                                </div> --}}
                                <!--end::Section-->
                                <!--begin::Seperator-->
                                <div class="separator separator-dashed mb-7"></div>
                                <!--end::Seperator-->
                                <!--begin::Section-->
                                <div class="mb-10">
                                    <!--begin::Title-->
                                    <h5 class="mb-4">{{ __('admin.global.payment_details') }}</h5>
                                    <!--end::Title-->
                                    <!--begin::Details-->
                                    <div class="mb-0">
                                        <!--begin::Card info-->
                                        <div class="fw-semibold text-gray-600 d-flex align-items-center">Mastercard
                                            <img src="{{ asset('admin_assets/media/svg/card-logos/mastercard.svg') }}" class="w-35px ms-2"
                                                alt="" />
                                        </div>
                                        <!--end::Card info-->
                                        <!--begin::Card expiry-->
                                        <div class="fw-semibold text-gray-600">Expires Dec 2024</div>
                                        <!--end::Card expiry-->
                                    </div>
                                    <!--end::Details-->
                                </div>
                                <!--end::Section-->
                                <!--begin::Seperator-->
                                <div class="separator separator-dashed mb-7"></div>
                                <!--end::Seperator-->
                                <!--begin::Section-->
                                <div class="mb-10">
                                    <!--begin::Title-->
                                    <h5 class="mb-4">{{ __('admin.global.other_details') }}</h5>
                                    <!--end::Title-->
                                    <!--begin::Details-->
                                    <table class="table fs-6 fw-semibold gs-0 gy-2 gx-2">
                                        <!--begin::Row-->
                                        <tr class="">
                                            <td class="text-gray-400" style="text-align: right;">{{ __('admin.global.order_id') }}:</td>
                                            <td class="text-gray-800" style="text-align: right;">{{ $order->id }}</td>
                                        </tr>
                                        <!--end::Row-->
                                        <!--begin::Row-->
                                        <tr class="">
                                            <td class="text-gray-400" style="text-align: right;">{{ __('admin.global.order_date') }}:</td>
                                            <td class="text-gray-800" style="text-align: right;">{{ $order->created_at->format('Y M D') }}</td>
                                        </tr>
                                        <!--end::Row-->
                                        <!--begin::Row-->
                                        <tr class="">
                                            <td class="text-gray-400" style="text-align: right;">{{ __('admin.form.status') }}:</td>
                                            <td style="text-align: right;">
                                                <span class="badge @if($order->status == 'paided' || $order->status == 'partial_paided') badge-light-success @else badge-light-danger @endif">{{ __('admin.global.' . $order->status ) }}</span>
                                            </td>
                                        </tr>
                                        <!--end::Row-->
                                    </table>
                                    <!--end::Details-->
                                </div>
                                <!--end::Section-->
                                
                            </div>
                            <!--end::Card body-->
                        </div>
                        <!--end::Card-->
                    </div>
                    <!--end::Sidebar-->
                </div>
                <!--end::Layout-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Post-->
    </div>
@endsection
@push('scripts')

@endpush
