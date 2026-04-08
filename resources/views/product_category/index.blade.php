@php
$store_logo = \App\Models\Utility::get_file('uploads/product_image/');
@endphp

@extends('layouts.admin')
@section('page-title')
    {{ __('Catégorie de produit') }}
@endsection
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{__('Accueil')}}</a></li>
<li class="breadcrumb-item active" aria-current="page">{{__('Catégorie de produit')}}</li>
@endsection
@section('action-btn')
<div class="pr-2 action-btn-wrapper">
    @can('Create Product category')
        <a href="#" class="btn btn-sm btn-icon btn-primary" data-ajax-popup="true" data-url="{{ route('product_categorie.create') }}" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('Créer') }}" data-title="{{ __('Créer une nouvelle catégorie de produit') }}">
            <i data-feather="plus"></i>
        </a>
    @endcan
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="alert alert-info mb-3">
            <strong>{{ __('Comment utiliser cette section :') }}</strong>
            <ul class="mb-0">
                <li>{{ __('Marque → Catégorie parente → Sous-catégorie / Variante → Produit / SKU') }}</li>
                <li>{{ __('Exemple : Marque "Docker Maroc"') }}</li>
                <li>{{ __('Catégorie parente : "C50"') }}</li>
                <li>{{ __('Sous-catégorie / Variante : "C50 avec disque de frein"') }}</li>
                <li>{{ __('Produits : Chaque produit est lié à la variante, ex. Numéro de châssis : z2323123216') }}</li>
            </ul>
            <small>{{ __('Les administrateurs peuvent visualiser la hiérarchie complète et gérer les catégories, marques et produits.') }}</small>
        </div>

        <div class="card">
            <div class="card-body pb-0 table-border-style">
                <div class="table-responsive order-table-wrp">
                    <table class="table dataTable">
                        <thead>
                            <tr>
                                <th>{{ __('Image du produit') }}</th>
                                <th>{{ __('Nom de la catégorie') }}</th>
                                <th>{{ __('Catégorie parente') }}</th>
                                <th>{{ __('Marque') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($product_categorys as $product_category)
                                <tr data-name="{{ $product_category->name }}">
                                    <td>
                                        <div class="d-flex align-items-center">
                                            @if ($product_category->categorie_img)
                                                <img src="{{ $store_logo }}/{{ $product_category->categorie_img }}" alt="" class="theme-avtar border border-2 border-primary rounded">
                                            @else
                                                <img src="{{ $store_logo }}/default.jpg" alt="" class="theme-avtar border border-2 border-primary rounded">
                                            @endif
                                        </div>
                                    </td>
                                    <td>{{ $product_category->name }}</td>
                                    <td>{{ $product_category->parent ? $product_category->parent->name : '-' }}</td>
                                    <td>{{ $product_category->brand ? $product_category->brand->name : '-' }}</td>
                                    <td>
                                        <div class="d-flex action-btn-wrapper">
                                            @can('Edit Product category')
                                                <a href="#!" class="btn btn-sm btn-icon bg-info text-white me-2" data-url="{{ route('product_categorie.edit', $product_category->id) }}" data-ajax-popup="true" data-title="{{ __('Modifier la catégorie') }}" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('Modifier') }}">
                                                    <i class="ti ti-pencil f-20"></i>
                                                </a>
                                            @endcan
                                            @can('Delete Product category')
                                                <a href="#!" class="bs-pass-para btn btn-sm btn-icon bg-danger text-white" data-title="{{ __('Supprimer la catégorie') }}" data-confirm="{{ __('Êtes-vous sûr ?') }}" data-text="{{ __('Cette action est irréversible. Voulez-vous continuer ?') }}" data-confirm-yes="delete-form-{{ $product_category->id }}" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('Supprimer') }}">
                                                    <i class="ti ti-trash f-20"></i>
                                                </a>
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['product_categorie.destroy', $product_category->id], 'id' => 'delete-form-' . $product_category->id]) !!}
                                                {!! Form::close() !!}
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
@push('script-page')
<script>
    $(document).ready(function() {
        $(document).on('keyup', '.search-user', function() {
            var value = $(this).val();
            $('.employee_tableese tbody>tr').each(function(index) {
                var name = $(this).attr('data-name').toLowerCase();
                if (name.includes(value.toLowerCase())) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });
    });
</script>
@endpush
