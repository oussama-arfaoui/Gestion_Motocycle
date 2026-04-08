@extends('layouts.admin')

@section('page-title')
    {{ __('Edit Product') }}
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Home') }}</a></li>
<li class="breadcrumb-item"><a href="{{ route('product.index') }}">{{ __('Products') }}</a></li>
<li class="breadcrumb-item active" aria-current="page">{{ __('Edit') }}</li>
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12">
        {{ Form::model($product, ['route' => ['product.update', $product->id], 'method' => 'PUT', 'enctype'=>'multipart/form-data']) }}
        <div class="card">
            <div class="card-body">
                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            {{ Form::label('name', __('Product Name'), ['class'=>'form-label']) }}<x-required></x-required>
                            {{ Form::text('name', null, ['class'=>'form-control', 'placeholder'=>__('Enter Product Name'), 'required']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('variant_id', __('Variant'), ['class'=>'form-label']) }}<x-required></x-required>
                            {{ Form::select('variant_id', $variants, null, ['class'=>'form-control','placeholder'=>'Select Variant','required']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('SKU', __('Numéro de châssis'), ['class'=>'form-label']) }}<x-required></x-required>
                            {{ Form::text('SKU', null, ['class'=>'form-control','placeholder'=>__('Enter Numéro de châssis'),'required']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('price', __('Price (€)'), ['class'=>'form-label']) }}<x-required></x-required>
                            {{ Form::number('price', null, ['class'=>'form-control','step'=>'0.01','placeholder'=>__('Enter Price'),'required']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('image', __('Upload Image'), ['class'=>'form-label']) }}
                            <input type="file" name="image" id="image" class="form-control" onchange="document.getElementById('preview').src = window.URL.createObjectURL(this.files[0])">
                            <img id="preview" src="{{ $product->image ? \App\Models\Utility::get_file('uploads/product/').$product->image : '' }}" width="20%" class="mt-2"/>
                        </div>
                    </div>

                </div>
            </div>
            <div class="card-footer text-end">
                <a href="{{ route('product.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
                <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
            </div>
        </div>
        {{ Form::close() }}
    </div>
</div>
@endsection
