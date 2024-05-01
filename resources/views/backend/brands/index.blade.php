@extends('backend.layouts.admin-dashboard')

@section('content')
<div class="dashboard-main-container">

    {{-- Breadcrumbs --}}
    <div class="dashboard-main-container-breadcrumbs">
        <a href='/admin'>Home</a>
        <x-arrow-icon />
        <a href="{{ route('brands.index') }}">Brands</a>
    </div>

    {{-- Actions for the brands table --}}
    <div class="dashboard-main-container-actions">

        {{-- Main Button --}}
        <a class="dashboard-main-button" href="{{ route('brands.create') }}">
            <x-add-icon />
            <span>Create New Brand</span>
        </a>
    </div>

    {{-- Table --}}
    <table class="dashboard-main-container-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Link</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($brands as $brand)
            <tr>
                <td>{{ $brand->name }}</td>
                <td>{{ $brand->link }}</td>
                @php
                $imageArray = json_decode($brand->image, true);
                $firstImage = isset($imageArray[0]) ? $imageArray[0] : null;
                @endphp
                <td>
                    @if($firstImage)
                    <img src="{{ asset('storage/Images/general/' . $firstImage) }}" alt="Brand Image">
                    @else
                    No image available
                    @endif
                </td>
                <td class="dashboard_main-table-actions">
                    <a href="{{ route('brands.edit', $brand->id) }}">
                        <button class="dashboard-icon-button action-edit">
                            <x-edit-icon />
                        </button>
                    </a>
                    <form id="deleteForm{{ $brand->id }}" action="{{ route('brands.destroy', $brand->id) }}"
                        method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button id="page_delete_button" class="dashboard-icon-button action-delete">
                            <x-trash-icon />
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
</div>

@endsection