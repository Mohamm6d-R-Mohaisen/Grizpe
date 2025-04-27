<label class="form-check form-switch form-check-custom form-check-solid">
    <input class="form-check-input btn active_operation" style="margin: 0 auto;" type="checkbox" name="active" value="active" data-url="{{route('admin.sliders.active' , $instance->id)}}" {{ $instance->status == 'active' ? 'checked' : '' }} data-title="{{ $instance->title }}" />
    <span class="form-check-label fw-bold text-muted"></span>
</label>
