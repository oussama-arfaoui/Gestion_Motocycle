@extends('layouts.admin')

@section('page-title')
    {{ __('Products') }}
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Home') }}</a></li>
<li class="breadcrumb-item active" aria-current="page">{{ __('Products') }}</li>
@endsection

@section('action-btn')
<div class="pr-2 action-btn-wrapper">
    <a href="{{ route('product.create') }}" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="{{ __('Create Product') }}">
        <i data-feather="plus"></i> {{ __('Create') }}
    </a>
</div>
@endsection

@php
    $product_logo = \App\Models\Utility::get_file('uploads/product/');
@endphp

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body table-border-style">
                <div class="table-responsive">
                    <table class="table dataTable">
                        <thead>
                            <tr>
                                <th>{{ __('Image') }}</th>
                                <th>{{ __('Name') }}</th>
                                 <th>{{ __('Category') }}</th>
                                <th>{{ __('Variant') }}</th>
                                <th>{{ __('Numéro de châssis') }}</th>
                                <th>{{ __('Price') }}</th>
                                <th>{{ __('Created at') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>
                                        <img src="{{ $product_logo.($product->image ?? 'default.jpg') }}" alt="" class="theme-avtar border border-2 border-primary rounded" width="50">
                                    </td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->variant->category->name ?? '-' }}</td>
                                    <td>{{ $product->variant->name ?? '-' }}</td>
                                    <td>{{ $product->SKU }}</td>
                                   <td>{{ number_format($product->price, 0, '', ' ') }} DH</td>
                                    <td>{{ $product->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        <div class="d-flex action-btn-wrapper">
                                            <a href="{{ route('product.edit', $product->id) }}" class="btn btn-sm btn-info me-2" title="{{ __('Edit') }}">
                                                <i class="ti ti-pencil"></i>
                                            </a>
                                            <a href="#!" class="btn btn-sm btn-danger bs-pass-para"
                                               data-confirm-yes="delete-form-{{ $product->id }}">
                                                <i class="ti ti-trash"></i>
                                            </a>
                                            {!! Form::open(['method' => 'DELETE', 'route' => ['product.destroy', $product->id], 'id' => 'delete-form-' . $product->id]) !!}
                                            {!! Form::close() !!}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
