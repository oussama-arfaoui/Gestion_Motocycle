@php
$product_variant_logo = \App\Models\Utility::get_file('uploads/product_variant/');
@endphp

@extends('layouts.admin')

@section('page-title')
    {{ __('Product Variants') }}
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{__('Home')}}</a></li>
<li class="breadcrumb-item active" aria-current="page">{{__('Product Variants')}}</li>
@endsection

@section('action-btn')
<div class="pr-2 action-btn-wrapper">
    <a href="#" class="btn btn-sm btn-icon btn-primary"
        data-ajax-popup="true"
        data-url="{{ route('variants.create') }}"
        data-bs-toggle="tooltip"
        data-bs-placement="top"
        title="{{ __('Create') }}"
        data-title="{{ __('Create New Variant') }}">
        <i data-feather="plus"></i>
    </a>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body pb-0 table-border-style">
                <div class="table-responsive order-table-wrp">
                    <table class="table dataTable">
                        <thead>
                            <tr>
                                <th>{{ __('Image') }}</th>
                                <th>{{ __('Variant Name') }}</th>
                                <th>{{ __('Category') }}</th>
                                <th>{{ __('Price') }}</th>
                                <th>{{ __('Quantity') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($variants as $variant)
                                <tr data-name="{{ $variant->name }}">
                                    <td>
                                        <div class="d-flex align-items-center">
                                            @if ($variant->image)
                                                <img src="{{ $product_variant_logo }}/{{ $variant->image }}" alt="" class="theme-avtar border border-2 border-primary rounded">
                                            @else
                                                <img src="{{ $product_variant_logo }}/default.jpg" alt="" class="theme-avtar border border-2 border-primary rounded">
                                            @endif
                                        </div>
                                    </td>
                                    <td>{{ $variant->name }}</td>
                                    <td>{{ $variant->category ? $variant->category->name : '-' }}</td>
                                    <td>{{ $variant->price }}</td>
                                    <td>{{ $variant->quantity }}</td>
                                    <td>
                                        <div class="d-flex action-btn-wrapper">
                                            <a href="#!" class="btn btn-sm btn-icon bg-info text-white me-2"
                                                data-url="{{ route('variants.edit', $variant->id) }}"
                                                data-ajax-popup="true"
                                                data-title="{{ __('Edit Variant') }}"
                                                data-bs-toggle="tooltip"
                                                data-bs-placement="top"
                                                title="{{ __('Edit') }}">
                                                <i class="ti ti-pencil f-20"></i>
                                            </a>

                                            <a href="#!" class="bs-pass-para btn btn-sm btn-icon bg-danger text-white"
                                                data-title="{{ __('Delete Variant') }}"
                                                data-confirm="{{ __('Are You Sure?') }}"
                                                data-text="{{ __('This action can not be undone. Do you want to continue?') }}"
                                                data-confirm-yes="delete-form-{{ $variant->id }}"
                                                data-bs-toggle="tooltip"
                                                data-bs-placement="top"
                                                title="{{ __('Delete') }}">
                                                <i class="ti ti-trash f-20"></i>
                                            </a>
                                            {!! Form::open(['method' => 'DELETE', 'route' => ['variants.destroy', $variant->id], 'id' => 'delete-form-' . $variant->id]) !!}
                                            {!! Form::close() !!}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $variants->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
