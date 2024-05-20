@extends('backend.layouts.admin-dashboard')

@section('content')
<div class="dashboard-main-container">
    {{-- Breadcrumbs --}}
    <div class="dashboard-main-container-breadcrumbs">
        <a href='/admin'>Home</a>
        <x-arrow-icon />
        <span>Carrier Categories</span>
    </div>

    {{-- Actions for the blog categories table --}}
    <div class="dashboard-main-container-actions">
        {{-- Main Button --}}
        <a class="dashboard-main-button" href="{{ route('carrier-categories.create') }}">
            <x-add-icon />
            <span>Create New Category</span>
        </a>
    </div>

    {{-- Table --}}
    <table class="dashboard-main-container-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($carrierCategories as $category)
            <tr>
                <td>{{ $category->name }}</td>
                <td>{{ $category->description }}</td>
                <td>{{ $category->status }}</td>
                <td class="dashboard_main-table-actions">

                    {{-- <a href="{{ route('blogs-categories.show', $category->id) }}" target="_blank">
                        <button class="dashboard-icon-button action-view">
                            <x-eye-icon />
                        </button>
                    </a>--}}

                    <a href="{{ route('carrier-categories.edit', $category->id) }}">
                        <button class="dashboard-icon-button action-edit">
                            <x-edit-icon />
                        </button>
                    </a>
                    <form action="{{ route('carrier-categories.destroy', $category->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="confirmDelete({{ $category->id }})"
                            class="dashboard-icon-button action-delete">
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
    function confirmDelete(categoryId) {
        if (confirm('Are you sure you want to delete this category?')) {
            document.getElementById('deleteForm' + categoryId).submit();
        }
    }
</script>

@endsection
