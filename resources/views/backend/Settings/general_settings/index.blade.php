@extends('backend.layouts.admin-dashboard')

@section('content')
<div class="dashboard-main-container">

    {{-- Breadcrumbs --}}
    <div class="dashboard-main-container-breadcrumbs">
        <a href='/admin'>Home</a>
        <x-arrow-icon />
        <a href="/admin/general_settings">General Settings</a>
    </div>

    {{-- Actions for the General Settings --}}
    <div class="dashboard-main-container-actions">
        <!-- Add any actions specific to General Settings if needed -->
    </div>

    <div class="dashboard-main-container-modules">
        <form id="generalSettingsForm" action="{{ route('general_settings.updateAll') }}" method="POST">
            @csrf
            @method('PUT')

            <div id="settingsContainer">
                <div class="attribute">
                    <div class="dashboard-row">
                        <label for="logo">Logo:</label>
                        <input type="text" name="logo" class="form-control" value="{{ $general_settings ? $general_settings->logo : '' }}">
                    </div>
                    <div class="dashboard-row">
                        <label for="favicon">Favicon:</label>
                        <input type="text" name="favicon" class="form-control" value="{{ $general_settings ? $general_settings->favicon : '' }}">
                    </div>
                    <div class="dashboard-row">
                        <label for="login_screen_background">Login Screen Background:</label>
                        <input type="text" name="login_screen_background" class="form-control" value="{{ $general_settings ? $general_settings->login_screen_background : '' }}">
                    </div>
                    <div class="dashboard-row">
                        <label for="title">Title:</label>
                        <input type="text" name="title" class="form-control" value="{{ $general_settings ? $general_settings->title : '' }}">
                    </div>
                    <div class="dashboard-row">
                        <label for="name">Name:</label>
                        <input type="text" name="name" class="form-control" value="{{ $general_settings ? $general_settings->name : '' }}">
                    </div>
                    <div class="dashboard-row">
                        <label for="email">Email:</label>
                        <input type="text" name="email" class="form-control" value="{{ $general_settings ? $general_settings->email : '' }}">
                    </div>
                </div>
            </div>

            <!-- Add any additional settings fields here -->

            <div class="dashboard-final-actions">
                <button type="submit" class="dashboard-main-button">Save Changes</button>
            </div>
        </form>
    </div>
</div>
@endsection
