@extends('backend.layouts.admin-dashboard')

@section('content')

<div class="dashboard-main-container">
    <div class="dashboard-main-container-breadcrumbs">
        <a href='/admin'>Home</a>
        <x-arrow-icon />
        <a href="/admin/shortcode_editor">Shortcode Editor</a>
    </div>

    <div class="dashboard-main-container-actions">

        <button class="dashboard-secondary-button">
            <x-trash-icon />
            <span>Reset Changes</span>
        </button>

        <button id="registerChangesButton" class="dashboard-main-button">
            <x-add-icon />
            <span>Get Edited Shortcode</span>
        </button>
    </div>

    <div class="dashboard-main-container-modules">
        <div id="shortcode-editor" class="shortcode-editor"></div>
    </div>


</div>

@endsection