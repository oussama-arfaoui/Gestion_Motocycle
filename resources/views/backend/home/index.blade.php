@php
// Get the currently authenticated user
$user = auth()->user();
@endphp

@extends('backend.layouts.admin-dashboard')

@section('content')
<div class="dashboard-main-container dashboard_home">

    {{-- Breadcrumbs --}}
    <div class="dashboard-main-container-breadcrumbs">
        <a href='/admin'>Home</a>
    </div>

    {{-- Welcome message --}}
    <div class="dashboard_home-welcome">
        <h2>Welcome to the Admin Dashboard, <span>{{ $user->name }}</span></h2>
        <p>This is the home page of your admin dashboard. </p>
    </div>

    <div class="dashboard_home-information">
        <h2>Site General Informations: </h2>
        <div class="dashboard_home-information-table">
            <ul>
                <li>Company Name</li>
                <li>Page Title</li>
                <br />
                <li>Contact Number #1</li>
                <li>Contact Number #2</li>
                <li>Contact Email #1</li>
                <li>Contact Email #2</li>
                <li>Contact Whatsapp #1</li>
                <li>Contact Whatsapp #2</li>
                <li>Location:</li>
                <br />
                <li>Social Link Facebook</li>
                <li>Social Link Instagram</li>
                <li>Social Link Tiktok</li>
                <li>Social Link Linkedin</li>
                <li>Social Link Twitter</li>
                <li>Social Link Youtube</li>
                <br />
                <li>Company Description</li>
            </ul>
            <ul>
                <li>:</li>
                <li>:</li>
                <br />
                <li>:</li>
                <li>:</li>
                <li>:</li>
                <li>:</li>
                <li>:</li>
                <li>:</li>
                <li>:</li>
                <br />
                <li>:</li>
                <li>:</li>
                <li>:</li>
                <li>:</li>
                <li>:</li>
                <li>:</li>
                <br />
                <li>:</li>
            </ul>
            <ul>
                <li>{{$company_name}}</li>
                <li>{{$page_title}}</li>
                <br />
                <li>{{$contact_number_1}}</li>
                <li>{{$contact_number_2}}</li>
                <li>{{$contact_email_1}}</li>
                <li>{{$contact_email_2}}</li>
                <li>{{$contact_whatsapp_1}}</li>
                <li>{{$contact_whatsapp_2}}</li>
                <li>{{$physical_address}}</li>
                <br />
                <li>{{$social_facebook_link}}</li>
                <li>{{$social_instagram_link}}</li>
                <li>{{$social_tiktok_link}}</li>
                <li>{{$social_linkedin_link}}</li>
                <li>{{$social_twitter_link}}</li>
                <li>{{$social_youtube_link}}</li>
                <br />
                <li>{{$company_description}}</li>
            </ul>
        </div>
    </div>


    @endsection