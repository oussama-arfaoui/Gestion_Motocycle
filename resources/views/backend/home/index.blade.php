@php
// Get the currently authenticated user
$user = auth()->user();
@endphp

@extends('backend.layouts.admin-dashboard')

@section('content')
<div class="dashboard-main-container">

    {{-- Breadcrumbs --}}
    <div class="dashboard-main-container-breadcrumbs">
        <a href='/admin'>Home</a>
    </div>

    {{-- Welcome message --}}
    <div class="welcome-message">
        <h2>Welcome to the Admin Dashboard, {{ $user->name }}</h2>
        <p>This is the home page of your admin dashboard. </p>
    </div>


@endsection