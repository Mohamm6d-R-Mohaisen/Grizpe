@extends('admin.layouts.master', ['is_active_parent' => 'comments','is_active'=> 'comments'])
@section('title')
    {{ isset($comment) ? __('admin.global.edit_comment') : __('admin.global.add_new_comment') }}
@endsection
@section('content')
    <form id="kt_form" class="form row d-flex flex-column flex-lg-row addForm" data-kt-redirect="{{ route('admin.comments.index') }}"
          action="{{ isset($comment) ? route('admin.comments.update', $comment->id) : route('admin.comments.store') }}">
        @csrf
        @isset($comment)
            @method('PATCH')
        @endif
        <div class="page-content-header">
            <h2 class="table-title">{{ isset($comment) ? __('admin.global.edit_comment') : __('admin.global.add_new_comment') }}</h2>
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
                                   name="status" @if(isset($comment) && $comment->status == 'active') checked="checked" @endif value="active">
                            <span class="form-check-label fw-bold text-muted"></span>
                        </label>
                    </div>
                </div>
            </div>
            <!-- Image Field -->
            <div class="card card-flush">
                <div class="card-header justify-content-center p-5">
                    <div class="card-toolbar">
                        <div class="image-input image-input-outline image-input-placeholder image-input-empty" data-kt-image-input="true">
                            <div class="image-input-wrapper w-200px h-200px" style="background-image: url(@if(isset($comment) && $comment->image !== null) {{ asset($comment->image) }} @else {{ asset('admin_assets/media/svg/avatars/blank.svg') }} @endif)"></div>
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
            <!-- Blog Selection Field -->
            <div class="card card-flush">
                <div class="card-header">
                    <div class="card-title ">
                        <h3>{{__('admin.form.blog')}}</h3>
                    </div>
                    <div class="card-body">
                        <select name="blog_id" class="form-select">
                            @foreach($blogs as $blog)
                                <option></option>
                                <option value="{{ $blog->id }}" @if(isset($comment) && $comment->blog_id == $blog->id) selected @endif>
                                    {{ $blog->title }}
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
                        <h3>{{__('admin.global.comment_details')}}</h3>
                    </div>
                    <div class="card-body pt-0">
                        <div class="row">
                            <div class="col-md-12 fv-row fv-plugins-icon-container ">
                                <div class="mb-5 fv-row">
                                    <label class="required form-label">{{ __('admin.global.full_name') }}</label>
                                    <input type="text" name="full_name" class="form-control mb-2 w-100"
                                           placeholder="{{ __('admin.global.full_name') }}"
                                           value="{{ isset($comment) ? $comment->full_name : '' }}" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 fv-row fv-plugins-icon-container ">
                                <div class="mb-5 fv-row">
                                    <label class="required form-label">{{ __('admin.global.email') }}</label>
                                    <input type="email" name="email" class="form-control mb-2 w-100"
                                           placeholder="{{ __('admin.global.email') }}"
                                           value="{{ isset($comment) ? $comment->email : '' }}" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 fv-row fv-plugins-icon-container ">
                                <div class="mb-5 fv-row">
                                    <label class="required form-label">{{ __('admin.global.comment') }}</label>
                                    <textarea name="comment" id="summernote" class="form-control mb-2 w-100" rows="5"
                                              placeholder="{{ __('admin.global.comment') }}">{{ isset($comment) ? $comment->comment : '' }}</textarea>
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
                    <a href="{{ route('admin.comments.index') }}" id="kt_ecommerce_add_product_cancel"
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
@endpush
