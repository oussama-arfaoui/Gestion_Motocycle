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
        <form id="generalSettingsForm" action="{{ route('general_settings.updateAll') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div id="settingsContainer">
                <div class="attribute">
                    <!-- Logo -->
                    <div class="dashboard-row">
                        <label for="logo">Logo:</label>
                        @if($general_settings && $general_settings->logo)
                            @foreach(json_decode($general_settings->logo) as $logo)
                                <img src="{{ asset('storage/Images/general/' . $logo) }}" alt="Logo" style="max-width: 100px;">
                            @endforeach
                        @endif
                        <input type="file" name="logo[]" class="form-control" accept="image/*" onchange="previewImage(event, 'logoPreview')">
                        <div id="logoPreview" class="image-preview"></div>
                    </div>

                    <!-- Favicon -->
                    <div class="dashboard-row">
                        <label for="favicon">Favicon:</label>
                        @if($general_settings && $general_settings->favicon)
                            @foreach(json_decode($general_settings->favicon) as $favicon)
                                <img src="{{ asset('storage/Images/general/' . $favicon) }}" alt="Favicon" style="max-width: 100px;">
                            @endforeach
                        @endif
                        <input type="file" name="favicon[]" class="form-control" accept="image/*" onchange="previewImage(event, 'faviconPreview')">
                        <div id="faviconPreview" class="image-preview"></div>
                    </div>

                    <!-- Login Screen Background -->
                    <div class="dashboard-row">
                        <label for="login_screen_background">Login Screen Background:</label>
                        @if($general_settings && $general_settings->login_screen_background)
                            @foreach(json_decode($general_settings->login_screen_background) as $loginBackground)
                                <img src="{{ asset('storage/Images/general/' . $loginBackground) }}" alt="Login Screen Background" style="max-width: 100px;">
                            @endforeach
                        @endif
                        <input type="file" name="login_screen_background[]" class="form-control" accept="image/*" onchange="previewImage(event, 'loginScreenBackgroundPreview')">
                        <div id="loginScreenBackgroundPreview" class="image-preview"></div>
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


<style>
    .image-preview img {
        max-width: 100px;
        margin-top: 10px;
    }
</style>

<script>
    function previewImage(event, previewId) {
        var output = document.getElementById(previewId);
        output.innerHTML = '';
        for (var i = 0; i < event.target.files.length; i++) {
            var reader = new FileReader();
            reader.onload = function(e) {
                var img = document.createElement("img");
                img.src = e.target.result;
                output.appendChild(img);
            }
            reader.readAsDataURL(event.target.files[i]);
        }
    }
</script>
@endsection
