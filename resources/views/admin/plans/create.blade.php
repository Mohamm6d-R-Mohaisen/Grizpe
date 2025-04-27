@extends('admin.layouts.master', ['is_active_parent' => 'plans','is_active'=> 'plans'])
@section('title')
    {{ __('admin.global.add_new_plan') }}
@endsection
@section('content')
    <form id="kt_form" class="form row d-flex flex-column flex-lg-row addForm" data-kt-redirect="{{ route('admin.planes.index') }}"
          action="{{ isset($plane) ? route('admin.planes.update', $plane->id) : route('admin.planes.store') }}" method="post">
        @csrf
        @isset($plane)
            @method('PATCH')
        @endif

        <div class="page-content-header">
            <h2 class="table-title">{{ isset($plane) ? __('admin.global.edit_plan') : __('admin.global.add_new_plan') }}</h2>
        </div>

        <div class="d-flex flex-column gap-5 col-lg-3 mb-7">
            <div class="card card-flush">
                <div class="card-header">
                    <div class="card-title">
                        <h3>{{__('admin.form.status')}}</h3>
                    </div>
                    <div class="card-toolbar">
                        <label class="form-check form-switch form-check-custom form-check-solid">
                            <input type="hidden" name="status" value="inactive">
                            <input class="form-check-input btn active_operation" style="margin: 0 auto;" type="checkbox"
                                   name="status" @if(isset($plane) && $plane->status == 'active') checked="checked" @endif value="active">
                            <span class="form-check-label fw-bold text-muted"></span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="card card-flush">
                <div class="card-header">
                    <div class="card-title">
                        <h3>{{__('admin.plans.plan_type')}}</h3>
                    </div>
                </div>
                <div class="card-body">
                    <div class="mb-5 fv-row">
                        <label class="required form-label">{{ __('admin.plans.plan_type') }}</label>
                        <select name="type" class="form-select" required>
                            <option></option>
                            <option value="week" @if(isset($plane) && $plane->type == 'week') selected @endif>{{ __('admin.plans.week') }}</option>
                            <option value="month" @if(isset($plane) && $plane->type == 'month') selected @endif>{{ __('admin.plans.month') }}</option>
                            <option value="year" @if(isset($plane) && $plane->type == 'year') selected @endif>{{ __('admin.plans.year') }}</option>

                        </select>
                    </div>

                    <div class="mb-5 fv-row">
                        <label class="required form-label">{{ __('admin.plans.price') }}</label>
                        <input type="text" name="price" class="form-control"
                               value="{{ isset($plane) ? $plane->price : '' }}" required>
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
                            <div class="tab-pane fade generalTap-pane {{($lang == 'ar') ? 'active show ar' : ''}}" id="name_and_description_ar"
                                 role="tabpanel">
                                <div class="row">
                                    <div class="col-md-12 fv-row fv-plugins-icon-container">
                                        <div class="mb-5 fv-row">
                                            <label class="required form-label">{{ __('admin.plans.plan_name') }}</label>
                                            <input type="text" name="title_ar" class="form-control mb-2 w-100"
                                                   placeholder="{{ __('admin.plans.plan_name') }}"
                                                   value="{{ isset($plane) ? $plane->translate('ar')->title : '' }}" />
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-5">
                                    <label class="form-label">{{ __('admin.plans.description') }}</label>
                                    <textarea name="description_ar" class="form-control" rows="4">{{ isset($plane) ? $plane->translate('ar')->description : '' }}</textarea>
                                </div>
                            </div>
                            <div class="tab-pane fade arabic-tab {{($lang == 'ar') ? '' : 'active show en'}}" id="name_and_description_en" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-12 fv-row fv-plugins-icon-container">
                                        <div class="mb-5 fv-row">
                                            <label class="required form-label">
                                                {{ __('admin.plans.plan_name') }}
                                            </label>
                                            <input type="text" name="title_en" class="form-control mb-2"
                                                   placeholder="{{ __('admin.plans.plan_name') }}"
                                                   value="{{ isset($plane) ? $plane->translate('en')->title : '' }}" />
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-5">
                                    <label class="form-label">{{ __('admin.plans.description') }}</label>
                                    <textarea name="description_en" class="form-control" rows="4">{{ isset($plane) ? $plane->translate('en')->description : '' }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- قسم مميزات الخطة الحرة -->
                <div class="card card-flush">
                    <div class="salesTitle">
                        <h3>{{__('admin.plans.plan_features')}}</h3>
                    </div>
                    <div class="card-body pt-0">
                        <div id="features-container">
                            @if(isset($plane) && $plane->features->count() > 0)
                                @foreach($plane->features as $index => $feature)
                                    <div class="feature-item mb-4 p-3 border rounded">
                                        <div class="row">
                                            <div class="col-md-10">
                                                <div class="mb-3">
                                                    <label class="form-label">{{ __('admin.plans.feature_text_ar') }}</label>
                                                    <input type="text" name="features[{{ $index }}][title_ar]" class="form-control"
                                                           value="{{ $feature->translate('ar')->title ?? '' }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">{{ __('admin.plans.feature_text_en') }}</label>
                                                    <input type="text" name="features[{{ $index }}][title_en]" class="form-control"
                                                           value="{{ $feature->translate('en')->title ?? '' }}">
                                                </div>
                                            </div>
                                            <div class="col-md-2 d-flex align-items-end">
                                                <button type="button" class="btn btn-danger remove-feature">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <!-- إذا لم تكن هناك ميزات، أضف نموذجًا فارغًا -->
                                <div class="feature-item mb-4 p-3 border rounded">
                                    <div class="row">
                                        <div class="col-md-10">
                                            <div class="mb-3">
                                                <label class="form-label">{{ __('admin.plans.feature_text_ar') }}</label>
                                                <input type="text" name="features[0][title_ar]" class="form-control"
                                                       placeholder="مثال: عدد المشاريع غير محدود">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">{{ __('admin.plans.feature_text_en') }}</label>
                                                <input type="text" name="features[0][title_en]" class="form-control"
                                                       placeholder="Example: Unlimited projects">
                                            </div>
                                        </div>
                                        <div class="col-md-2 d-flex align-items-end">
                                            <button type="button" class="btn btn-danger remove-feature">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="mt-3">
                            <button type="button" id="add-feature" class="btn btn-primary">
                                <i class="bi bi-plus"></i> {{ __('admin.plans.add_feature') }}
                            </button>
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
                    <a href="{{ route('admin.planes.index') }}" id="kt_ecommerce_add_product_cancel"
                       class="btn btn-light me-5 cancel">{{ __('admin.form.cancel') }}</a>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
<script src="{{ asset('admin_assets/js/dashboard/handleSubmitForm.js') }}"></script>

    <script>

        document.addEventListener('DOMContentLoaded', function() {
            // إضافة ميزة جديدة
            let featureIndex = {{ isset($plan) ? $plan->features->count() : 1 }};

            $('#add-feature').click(function() {
                const newFeature = `
                <div class="feature-item mb-4 p-3 border rounded">
                    <div class="row">
                        <div class="col-md-10">
                            <div class="mb-3">
                                <label class="form-label">{{ __('admin.plans.feature_text_ar') }}</label>
                                <input type="text" name="features[${featureIndex}][title_ar]"
                                       class="form-control"
                                       placeholder="مثال: عدد المشاريع غير محدود">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">{{ __('admin.plans.feature_text_en') }}</label>
                                <input type="text" name="features[${featureIndex}][title_en]"
                                       class="form-control"
                                       placeholder="Example: Unlimited projects">
                            </div>
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button type="button" class="btn btn-danger remove-feature">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
            `;

                $('#features-container').append(newFeature);
                featureIndex++;
            });

            // حذف ميزة
            $(document).on('click', '.remove-feature', function() {
                $(this).closest('.feature-item').remove();
            });
        });
    </script>
@endpush
