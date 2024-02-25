<!-- upload_image.blade.php -->
@extends('backend.layouts.admin-dashboard')

@section('content')
<form action="/upload" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="image">
    <button type="submit">Upload</button>
</form>
@endsection