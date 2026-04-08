{{ Form::open(['url' => 'brands','method'=>'post','enctype'=>'multipart/form-data','class'=>'needs-validation','novalidate']) }}
<div class="row">
    <div class="col-12">
        <div class="form-group">
            {{ Form::label('name', __('Brand Name'), ['class'=>'form-label']) }}<x-required></x-required>
            {{ Form::text('name', null, ['class'=>'form-control','placeholder'=>__('Enter Brand Name'),'required'=>'required']) }}
        </div>
        <div class="form-group">
            <label for="brand_img" class="form-label">{{ __('Upload Brand Image') }}</label>
            <input type="file" name="brand_img" id="brand_img" class="form-control"
                onchange="document.getElementById('brandPreview').src = window.URL.createObjectURL(this.files[0])">
            <img id="brandPreview" src="" width="20%" class="mt-2"/>
        </div>
    </div>
    <div class="form-group col-12 d-flex py-0 mb-0 justify-content-end form-label">
        <input type="button" value="{{__('Cancel')}}" class="btn btn-secondary" data-bs-dismiss="modal">
        <input type="submit" value="{{__('Create')}}" class="btn btn-primary ms-2">
    </div>
</div>
{{ Form::close() }}
