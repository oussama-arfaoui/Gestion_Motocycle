{{ Form::model($brand, ['route' => ['brands.update', $brand->id],'method'=>'PUT','enctype'=>'multipart/form-data','class'=>'needs-validation','novalidate']) }}
<div class="row">
    <div class="col-12">
        <div class="form-group">
            {{ Form::label('name', __('Brand Name'), ['class'=>'form-label']) }}<x-required></x-required>
            {{ Form::text('name', null, ['class'=>'form-control','required'=>'required']) }}
        </div>
        <div class="form-group">
            <label for="brand_img" class="form-label">{{ __('Upload Brand Image') }}</label>
            <small class="d-block text-muted mb-1"><strong>Formats acceptés :</strong> JPG, JPEG, PNG, WEBP &nbsp;|&nbsp; <strong>Max :</strong> 2MB</small>
            <input type="file" name="brand_img" id="brand_img" class="form-control"
                accept="image/jpeg,image/jpg,image/png,image/webp,.jpg,.jpeg,.png,.webp"
                onchange="validateBrandImage(this)">
            <div id="brand-img-error" class="alert alert-danger py-2 mt-1" style="display:none;"></div>
            @if($brand->brand_img)
                <img id="brandPreview" src="{{ \App\Models\Utility::get_file('uploads/brand_image/'.$brand->brand_img) }}" width="20%" class="mt-2"/>
            @else
                <img id="brandPreview" src="" width="20%" class="mt-2"/>
            @endif
        </div>
    </div>
    <div class="form-group col-12 d-flex py-0 mb-0 justify-content-end form-label">
        <input type="button" value="{{__('Cancel')}}" class="btn btn-secondary" data-bs-dismiss="modal">
        <input type="submit" value="{{__('Update')}}" class="btn btn-primary ms-2">
    </div>
</div>
{{ Form::close() }}
