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
                <td><img src="{{ asset('storage/' . $brand->image) }}" alt="Brand Image" style="max-width: 100px;"></td>
                <td class="dashboard_main-table-actions">
                    <a href="{{ route('brands.edit', $brand->id) }}">
                        <button class="dashboard-icon-button action-edit">
                            <x-edit-icon />
                        </button>
                    </a>

                    <form action="{{ route('brands.destroy', $brand->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button onclick="confirmDelete({{ $brand->id }})" class="dashboard-icon-button action-delete">
                            <x-trash-icon />
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    function confirmDelete(brandId) {
        if (confirm('Are you sure you want to delete this brand?')) {
            document.getElementById('deleteForm' + brandId).submit();
        }
    }
</script>

@endsection
