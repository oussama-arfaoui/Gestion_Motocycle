@extends('layouts.admin')

@section('page-title')
    {{ __('Create Product') }}
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Home') }}</a></li>
<li class="breadcrumb-item"><a href="{{ route('product.index') }}">{{ __('Products') }}</a></li>
<li class="breadcrumb-item active" aria-current="page">{{ __('Create') }}</li>
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12">
        {{ Form::open(['route' => 'product.store', 'method' => 'POST', 'enctype'=>'multipart/form-data']) }}
        <div class="card">
            <div class="card-body">
                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            {{ Form::label('name', __('Product Name'), ['class'=>'form-label']) }}<x-required></x-required>
                            {{ Form::text('name', null, ['class'=>'form-control', 'placeholder'=>__('Enter Product Name'), 'required']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('variant_id', __('Variant'), ['class'=>'form-label']) }}<x-required></x-required>
                            {{ Form::select('variant_id', $variants, null, ['class'=>'form-control','placeholder'=>'Select Variant','required']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('SKU', __('Numéro de châssis'), ['class'=>'form-label']) }}<x-required></x-required>
                            {{ Form::text('SKU', null, ['class'=>'form-control','placeholder'=>__('Enter Numéro de châssis'),'required']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('price', __('Price (€)'), ['class'=>'form-label']) }}<x-required></x-required>
                            {{ Form::number('price', null, ['class'=>'form-control','step'=>'0.01','placeholder'=>__('Enter Price'),'required']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('image', __('Upload Image'), ['class'=>'form-label']) }}
                            <div class="alert alert-info py-2 mb-2">
                                <small class="text-muted">
                                    <strong>Formats acceptés uniquement :</strong> JPG, JPEG, PNG, WEBP<br>
                                    <strong>Taille maximale :</strong> 2MB
                                </small>
                            </div>
                            <input type="file" name="image" id="image" class="form-control" accept="image/jpeg,image/jpg,image/png,image/webp,.jpg,.jpeg,.png,.webp" onchange="document.getElementById('preview').src = window.URL.createObjectURL(this.files[0])">
                            <div id="image-error" class="alert alert-danger mt-2" style="display: none;"></div>
                            <img id="preview" src="" width="20%" class="mt-2"/>
                        </div>
                    </div>

                </div>
            </div>
            <div class="card-footer text-end">
                <a href="{{ route('product.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
                <button type="submit" class="btn btn-primary">{{ __('Create') }}</button>
            </div>
        </div>
        {{ Form::close() }}
    </div>
</div>
@endsection

@push('script-page')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form[enctype="multipart/form-data"]');
    const fileInput = document.getElementById('image');
    const preview = document.getElementById('preview');
    
    // Validation en temps réel lors de la sélection
    fileInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (!file) return;
        
        // Vérifier le type de fichier
        const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];
        const allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];
        const fileExtension = file.name.split('.').pop().toLowerCase();
        
        if (!allowedTypes.includes(file.type) || !allowedExtensions.includes(fileExtension)) {
            // Afficher l'erreur immédiatement
            showError('Format non accepté ! Utilisez seulement : JPG, JPEG, PNG ou WEBP');
            fileInput.value = ''; // Vider le champ
            preview.src = ''; // Effacer la prévisualisation
            return;
        }
        
        // Vérifier la taille (2MB max)
        const maxSize = 2 * 1024 * 1024; // 2MB en octets
        if (file.size > maxSize) {
            showError('Image trop grande ! Maximum 2MB autorisé');
            fileInput.value = '';
            preview.src = '';
            return;
        }
        
        // Si tout est bon, afficher la prévisualisation
        showPreview(file);
    });
    
    // Validation lors de la soumission
    form.addEventListener('submit', function(e) {
        const file = fileInput.files[0];
        if (file) {
            const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];
            const allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];
            const fileExtension = file.name.split('.').pop().toLowerCase();
            
            if (!allowedTypes.includes(file.type) || !allowedExtensions.includes(fileExtension)) {
                e.preventDefault();
                showError('Format non accepté ! Utilisez seulement : JPG, JPEG, PNG ou WEBP');
                return false;
            }
            
            const maxSize = 2 * 1024 * 1024;
            if (file.size > maxSize) {
                e.preventDefault();
                showError('Image trop grande ! Maximum 2MB autorisé');
                return false;
            }
        }
    });
    
    function showPreview(file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
    
    function showError(message) {
        // Créer ou mettre à jour le message d'erreur
        let errorDiv = document.getElementById('image-error');
        if (!errorDiv) {
            errorDiv = document.createElement('div');
            errorDiv.id = 'image-error';
            errorDiv.className = 'alert alert-danger mt-2';
            errorDiv.style.display = 'none';
            fileInput.parentNode.appendChild(errorDiv);
        }
        
        errorDiv.textContent = message;
        errorDiv.style.display = 'block';
        
        // Auto-disparition après 5 secondes
        setTimeout(() => {
            errorDiv.style.display = 'none';
        }, 5000);
    }
});
</script>
@endpush
