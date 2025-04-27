@if($instance->status == 'paided')
    <div class="badge badge-light-success">{{ __('admin.global.' . $instance->status) }}</div>
@elseif($instance->status == 'partial_paided')
    <div class="badge badge-light-warning">{{ __('admin.global.' . $instance->status) }}</div>
@elseif($instance->status == 'pending' || $instance->status == 'cancelled')
    <div class="badge badge-light-danger">{{ __('admin.global.' . $instance->status) }}</div>
@endif