@extends('admin.layouts.master', ['is_active_parent' => 'contacts', 'is_active' => 'contacts'])
@section('title')
    {{ isset($contact) ? __('admin.global.edit_contact') : __('admin.global.add_new_contact') }}
@endsection
@section('content')
    <form id="kt_form" class="form row d-flex flex-column flex-lg-row addForm" data-kt-redirect="{{ route('admin.contacts.index') }}"
          action="{{ isset($contact) ? route('admin.contacts.update', $contact->id) : route('admin.contacts.store') }}">
        @csrf
        @isset($contact)
            @method('PATCH')
        @endif
        <div class="page-content-header">
            <h2 class="table-title">{{ isset($contact) ? __('admin.global.edit_contact') : __('admin.global.add_new_contact') }}</h2>
        </div>
        <div class="d-flex flex-column gap-5 col-lg-3 mb-7">
            <!-- Status Field -->
            <div class="card card-flush">
                <div class="card-header">
                    <div class="card-title">
                        <h3>{{ __('admin.form.status') }}</h3>
                    </div>
                    <div class="card-toolbar">
                        <label class="form-check form-switch form-check-custom form-check-solid">
                            <input type="hidden" name="status" value="inactive">
                            <input class="form-check-input btn active_operation" style="margin: 0 auto;" type="checkbox"
                                   name="status" @if(isset($contact) && $contact->status == 'active') checked="checked" @endif value="active">
                            <span class="form-check-label fw-bold text-muted"></span>
                        </label>
                    </div>
                </div>
            </div>
            <!-- Service Selection Field -->
            <div class="card card-flush">
                <div class="card-header">
                    <div class="card-title">
                        <h3>{{ __('admin.form.service') }}</h3>
                    </div>
                    <div class="card-body">
                        <select name="service_id" class="form-select">
                            <option></option>
                            @foreach ($services as $service)
                                <option value="{{ $service->id }}" @if (isset($contact) && $contact->service_id == $service->id) selected @endif>
                                    {{ $service->title }}
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
                        <h3>{{ __('admin.global.contact_details') }}</h3>
                    </div>
                    <div class="card-body pt-0">
                        <div class="row">
                            <div class="col-md-12 fv-row fv-plugins-icon-container">
                                <div class="mb-5 fv-row">
                                    <label class="required form-label">{{ __('admin.global.full_name') }}</label>
                                    <input type="text" name="full_name" class="form-control mb-2 w-100"
                                           placeholder="{{ __('admin.global.full_name') }}"
                                           value="{{ isset($contact) ? $contact->full_name : '' }}" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 fv-row fv-plugins-icon-container">
                                <div class="mb-5 fv-row">
                                    <label class="required form-label">{{ __('admin.global.email') }}</label>
                                    <input type="email" name="email" class="form-control mb-2 w-100"
                                           placeholder="{{ __('admin.global.email') }}"
                                           value="{{ isset($contact) ? $contact->email : '' }}" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 fv-row fv-plugins-icon-container">
                                <div class="mb-5 fv-row">
                                    <label class="required form-label">{{ __('admin.global.phone_number') }}</label>
                                    <input type="text" name="phone_number" class="form-control mb-2 w-100"
                                           placeholder="{{ __('admin.global.phone_number') }}"
                                           value="{{ isset($contact) ? $contact->phone_number : '' }}" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 fv-row fv-plugins-icon-container">
                                <div class="mb-5 fv-row">
                                    <label class="required form-label">{{ __('admin.global.message') }}</label>
                                    <textarea name="message" id="summernote" class="form-control mb-2 w-100" rows="5"
                                              placeholder="{{ __('admin.global.message') }}">{{ isset($contact) ? $contact->message : '' }}</textarea>
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
                    <a href="{{ route('admin.contacts.index') }}" id="kt_ecommerce_add_product_cancel"
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
            placeholder: '{{ __('admin.global.type_your_text_here') }}',
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
