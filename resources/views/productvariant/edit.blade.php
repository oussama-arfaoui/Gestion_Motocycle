
@php
    $product_variant_logo = \App\Models\Utility::get_file('uploads/product_variant/');
@endphp
{{ Form::model($variant, ['route' => ['variants.update', $variant->id], 'method' => 'PUT','enctype'=>'multipart/form-data','class'=>'needs-validation','novalidate']) }}
<div class="row">
    <div class="col-12">
        <div class="form-group">
            {{ Form::label('name', __('Variant Name'), ['class'=>'form-label']) }}<x-required></x-required>
            {{ Form::text('name', null, ['class'=>'form-control','required'=>'required']) }}
        </div>
        <div class="form-group">
            {{ Form::label('category_id', __('Category'), ['class'=>'form-label']) }}<x-required></x-required>
            {{ Form::select('category_id', $categories, null, ['class'=>'form-control','required'=>'required']) }}
        </div>
        <div class="form-group">
            {{ Form::label('price', __('Price'), ['class'=>'form-label']) }}<x-required></x-required>
            {{ Form::number('price', null, ['class'=>'form-control','step'=>'0.01','required'=>'required']) }}
        </div>
        <div class="form-group">
            {{ Form::label('quantity', __('Quantity'), ['class'=>'form-label']) }}<x-required></x-required>
            {{ Form::number('quantity', null, ['class'=>'form-control','min'=>'0','required'=>'required']) }}
        </div>
        <div class="form-group">
            <label for="image" class="form-label">{{ __('Upload Image') }}</label>
            <input type="file" name="image" id="image" class="form-control"
                onchange="document.getElementById('variantPreview').src = window.URL.createObjectURL(this.files[0])">
            <img id="variantPreview" src="{{ $variant->image ? $product_variant_logo.'/'.$variant->image : '' }}" width="20%" class="mt-2"/>
        </div>
    </div>
    <div class="form-group col-12 d-flex py-0 mb-0 justify-content-end form-label">
        <input type="button" value="{{__('Cancel')}}" class="btn btn-secondary" data-bs-dismiss="modal">
        <input type="submit" value="{{__('Update')}}" class="btn btn-primary ms-2">
    </div>
</div>
{{ Form::close() }}
