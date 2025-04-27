@extends('admin.layouts.master', ['is_active_parent' => 'settings', 'is_active' => 'settings'])
@section('title')
    {{ __('admin.form.settings') }}
@endsection
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="d-flex flex-column-fluid">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-custom card-stretch gutter-b">
                            <div class="card card-custom">
                                {{-- <div class="card-header">
                                    <h3 class="card-title">
                                        إعدادات الموقع
                                    </h3>
                                </div> --}}
                                {{-- <form class="form" id="kt_form" action="{{ route('admin.settings.update') }}" method="POST" enctype='multipart/form-data'>
                                    @csrf
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <label class="col-form-label text-right col-lg-3 col-sm-12 mb-3">الهاتف</label>
                                            <div class="col-lg-4 col-md-9 col-sm-12">
                                                <div class="typeahead">
                                                    <input class="form-control" type="text" name="phone" placeholder="الهاتف" value="{{ $settings->valueOf('phone') }}"/>
                                                    @error('phone')
                                                        <span class="text-danger d-flex">
                                                            <span>{{ $message }}</span>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label text-right col-lg-3 col-sm-12 mb-3">الإيميل</label>
                                            <div class="col-lg-4 col-md-9 col-sm-12">
                                                <div class="typeahead">
                                                    <input class="form-control" type="email" name="email" placeholder="الإيميل" value="{{ $settings->valueOf('email') }}"/>
                                                    @error('email')
                                                        <span class="text-danger d-flex">
                                                            <span>{{ $message }}</span>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label text-right col-lg-3 col-sm-12 mb-3">Linkedin Link</label>
                                            <div class="col-lg-4 col-md-9 col-sm-12">
                                                <div class="typeahead">
                                                    <input class="form-control" type="text" name="linkedin" placeholder="Linkedin Link" value="{{ $settings->valueOf('linkedin') }}"/>
                                                    @error('linkedin')
                                                        <span class="text-danger d-flex">
                                                            <span>{{ $message }}</span>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label text-right col-lg-3 col-sm-12 mb-3">twitter Link</label>
                                            <div class="col-lg-4 col-md-9 col-sm-12">
                                                <div class="typeahead">
                                                    <input class="form-control" type="text" name="twitter" placeholder="twitter Link" value="{{ $settings->valueOf('twitter') }}"/>
                                                    @error('twitter')
                                                        <span class="text-danger d-flex">
                                                            <span>{{ $message }}</span>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label text-right col-lg-3 col-sm-12 mb-3">instagram Link</label>
                                            <div class="col-lg-4 col-md-9 col-sm-12">
                                                <div class="typeahead">
                                                    <input class="form-control" type="text" name="instagram" placeholder="instagram Link" value="{{ $settings->valueOf('instagram') }}"/>
                                                    @error('instagram')
                                                        <span class="text-danger d-flex">
                                                            <span>{{ $message }}</span>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label text-right col-lg-3 col-sm-12 mb-3">facebook Link</label>
                                            <div class="col-lg-4 col-md-9 col-sm-12">
                                                <div class="typeahead">
                                                    <input class="form-control" type="text" name="facebook" placeholder="facebook Link" value="{{ $settings->valueOf('facebook') }}"/>
                                                    @error('facebook')
                                                        <span class="text-danger d-flex">
                                                            <span>{{ $message }}</span>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label text-right col-lg-3 col-sm-12 mb-3">عنوان الشركة</label>
                                            <div class="col-lg-4 col-md-9 col-sm-12">
                                                <div class="typeahead">
                                                    <input class="form-control" type="text" name="address" placeholder="عنوان الشركة" value="{{ $settings->valueOf('address') }}"/>
                                                    @error('address')
                                                        <span class="text-danger d-flex">
                                                            <span>{{ $message }}</span>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label text-right col-lg-3 col-sm-12 mb-3">رابط موقع الشركة</label>
                                            <div class="col-lg-4 col-md-9 col-sm-12">
                                                <div class="typeahead">
                                                    <input class="form-control" type="text" name="web_address" placeholder="رابط موقع الشركة" value="{{ $settings->valueOf('web_address') }}"/>
                                                    @error('web_address')
                                                        <span class="text-danger d-flex">
                                                            <span>{{ $message }}</span>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                     
                                    <div class="card-footer">
                                        <div class="row justify-content-end">
                                            <div >
                                                <button type="submit" id="kt_submit" class="btn btn-primary mr-2">حفظ</button>
                                            </div>
                                        </div>
                                    </div>
                                </form> --}}
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title fs-3 fw-bold">إعدادات الموقع</div>
                                    </div>
                                    <form id="kt_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" action="{{ route('admin.settings.update') }}" method="POST" data-kt-redirect="{{ route('admin.settings.index') }}" enctype='multipart/form-data' novalidate="novalidate">
                                        @csrf
                                        <div class="card-body p-9">
                                            <div class="row mb-5">
                                                <div class="col-xl-3">
                                                    <div class="fs-6 fw-semibold mt-2 mb-3">شعار الموقع</div>
                                                </div>
                                                <div class="col-lg-8">
                                                    <div class="image-input image-input-outline" data-kt-image-input="true"
                                                        style="background-image: url('assets/media/svg/avatars/blank.svg')">
                                                        <div class="image-input-wrapper w-125px h-125px bgi-position-center"
                                                            style="background-size: 75%; background-image: url({{ $settings->valueOf('company_logo') !== null ? $settings->valueOf('company_logo'):asset('admin_assets/media/svg/brand-logos/volicity-9.svg') }})">
                                                        </div>
                                                        <label
                                                            class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                                                            data-kt-image-input-action="change" data-bs-toggle="tooltip"
                                                            data-kt-initialized="1">
                                                            <i class="bi bi-pencil-fill fs-7"></i>
                                                            <input type="file" name="company_logo" accept=".png, .jpg, .jpeg">
                                                            {{-- <input type="hidden" name="avatar_remove"> --}}
                                                        </label>
                                                        <span
                                                            class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                                                            data-kt-image-input-action="cancel" data-bs-toggle="tooltip"
                                                            data-kt-initialized="1">
                                                            <i class="bi bi-x fs-2"></i>
                                                        </span>
                                                        <span
                                                            class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                                                            data-kt-image-input-action="remove" data-bs-toggle="tooltip"
                                                            data-kt-initialized="1">
                                                            <i class="bi bi-x fs-2"></i>
                                                        </span>
                                                    </div>
                                                    <div class="form-text">الصيغ المسموحة: png, jpg, jpeg.</div>
                                                </div>
                                            </div>
                                            <div class="row mb-8">
                                                <div class="col-xl-3">
                                                    <div class="fs-6 fw-semibold mt-2 mb-3">الإيميل</div>
                                                </div>
                                                <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                                    <input type="text" class="form-control" name="email" value="{{ $settings->valueOf('email') }}">
                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                </div>
                                            </div>
                                            <div class="row mb-8">
                                                <div class="col-xl-3">
                                                    <div class="fs-6 fw-semibold mt-2 mb-3">الهاتف</div>
                                                </div>
                                                <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                                    <input type="text" class="form-control" name="phone" value="{{ $settings->valueOf('phone') }}">
                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                </div>
                                            </div>
                                            <div class="row mb-8">
                                                <div class="col-xl-3">
                                                    <div class="fs-6 fw-semibold mt-2 mb-3">رقم الواتس أب</div>
                                                </div>
                                                <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                                    <input type="text" class="form-control" name="whatsapp" value="{{ $settings->valueOf('whatsapp') }}">
                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                </div>
                                            </div>
                                            <div class="row mb-8">
                                                <div class="col-xl-3">
                                                    <div class="fs-6 fw-semibold mt-2 mb-3">لينكد إن</div>
                                                </div>
                                                <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                                    <input type="text" class="form-control" name="linkedin" value="{{ $settings->valueOf('linkedin') }}">
                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                </div>
                                            </div>
                                            <div class="row mb-8">
                                                <div class="col-xl-3">
                                                    <div class="fs-6 fw-semibold mt-2 mb-3">فيسبوك</div>
                                                </div>
                                                <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                                    <input type="text" class="form-control" name="facebook" value="{{ $settings->valueOf('facebook') }}">
                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                </div>
                                            </div>
                                            <div class="row mb-8">
                                                <div class="col-xl-3">
                                                    <div class="fs-6 fw-semibold mt-2 mb-3">انستجرام</div>
                                                </div>
                                                <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                                    <input type="text" class="form-control" name="instagram" value="{{ $settings->valueOf('instagram') }}">
                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                </div>
                                            </div>
                                            <div class="row mb-8">
                                                <div class="col-xl-3">
                                                    <div class="fs-6 fw-semibold mt-2 mb-3">تويتر</div>
                                                </div>
                                                <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                                    <input type="text" class="form-control" name="twitter" value="{{ $settings->valueOf('twitter') }}">
                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                </div>
                                            </div>
                                            <div class="row mb-8">
                                                <div class="col-xl-3">
                                                    <div class="fs-6 fw-semibold mt-2 mb-3">الموقع الجغرافي</div>
                                                </div>
                                                <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                                    <input type="text" class="form-control" name="address" value="{{ $settings->valueOf('address') }}">
                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                </div>
                                            </div>
                                            <div class="row mb-8">
                                                <div class="col-xl-3">
                                                    <div class="fs-6 fw-semibold mt-2 mb-3">الموقع الإلكتروني</div>
                                                </div>
                                                <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                                    <input type="text" class="form-control" name="web_address" value="{{ $settings->valueOf('web_address') }}">
                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer d-flex justify-content-end py-6 px-9">
                                            <button type="reset"
                                                class="btn btn-light btn-active-light-primary me-2">إلغاء</button>
                                            <button type="submit" class="btn btn-primary"
                                                id="kt_submit">حفظ</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('admin_assets/js/dashboard/handleSubmitForm.js') }}"></script>
@endpush
