@php
$brand_logo = asset('storage/uploads/brand_image/');
@endphp
@extends('layouts.admin')

@section('page-title')
    {{ __('Boutique') }}
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{__('Tableau de bord')}}</a></li>
<li class="breadcrumb-item active" aria-current="page">{{__('Boutique')}}</li>
@endsection

@section('action-btn')
<div class="pr-2 action-btn-wrapper" id="main-add-btn">
        <a href="#" class="btn btn-sm btn-icon  btn-primary"
            data-ajax-popup="true"
            data-url="{{ route('brands.create') }}"
            data-bs-toggle="tooltip"
            data-bs-placement="top"
            title="{{ __('Create') }}"
            data-title="{{ __('Ajouter une marque') }}">
            <i data-feather="plus"></i>
        </a>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>{{ __('Gestion des produits par hiérarchie') }}</h5>
                <small class="text-muted">{{ __('Marque → Modèle → Famille → Numéro de châssis') }}</small>
            </div>
            <div class="card-body">
                <!-- Breadcrumb Navigation -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0" id="breadcrumb-nav">
                            <li class="breadcrumb-item active" aria-current="page">
                                <a href="#" data-level="brands" class="breadcrumb-link">{{ __('Marques') }}</a>
                            </li>
                        </ol>
                    </nav>
                    <button id="back-btn" class="btn btn-outline-secondary btn-sm" onclick="goBack()" style="display: none;">
                        <i class="ti ti-arrow-left me-1"></i>{{ __('Retour') }}
                    </button>
                </div>

                <!-- Content Container -->
                <div id="hierarchy-content">
                    <!-- Brands Level -->
                    <div id="brands-level" class="hierarchy-level">
                        @if ($brands->isEmpty())
                            <div class="text-center py-5">
                                <i class="ti ti-brand text-muted" style="font-size: 4rem;"></i>
                                <h5 class="mt-3 text-muted">{{ __('Aucune marque trouvée') }}</h5>
                                <p class="text-muted">{{ __('Commencez par ajouter votre première marque') }}</p>
                                <a href="#" class="btn btn-primary"
                                   data-ajax-popup="true"
                                   data-url="{{ route('brands.create') }}"
                                   data-title="{{ __('Ajouter une marque') }}">
                                    <i class="ti ti-plus me-2"></i>{{ __('Ajouter une marque') }}
                                </a>
                            </div>
                        @else
                            <div class="list-group">
                                @foreach ($brands as $brand)
                                    <div class="list-group-item d-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-center">
                                            @if ($brand->brand_img)
                                                <img src="{{ $brand_logo }}/{{ $brand->brand_img }}" alt="{{ $brand->name }}" class="me-3" style="width: 40px; height: 40px; object-fit: cover; border-radius: 8px;">
                                            @else
                                                <div class="me-3 bg-secondary rounded d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                                    <i class="ti ti-brand text-white"></i>
                                                </div>
                                            @endif
                                            <div>
                                                <h6 class="mb-0 fw-bold">{{ $brand->name }}</h6>
                                                <small class="text-muted">{{ __('Marque') }}</small>
                                            </div>
                                        </div>
                                        <div class="d-flex gap-2">
                                            <button class="btn btn-sm btn-outline-primary drill-down-btn" 
                                                    data-level="models"
                                                    data-brand-id="{{ $brand->id }}"
                                                    data-brand-name="{{ $brand->name }}"
                                                    onclick="handleDrillDown(this)">
                                                <i class="ti ti-arrow-right"></i>
                                            </button>
                                            <a href="#!" class="btn btn-sm btn-icon bg-info text-white"
                                                data-url="{{ route('brands.edit', $brand->id) }}"
                                                data-ajax-popup="true"
                                                data-title="{{ __('Modifier la marque') }}"
                                                data-bs-toggle="tooltip"
                                                data-bs-placement="top"
                                                title="{{ __('Edit') }}">
                                                <i class="ti ti-pencil f-16"></i>
                                            </a>
                                            <a href="#!" class="bs-pass-para btn btn-sm btn-icon bg-danger text-white"
                                                data-title="{{ __('Supprimer la marque') }}"
                                                data-confirm="{{ __('Êtes-vous sûr?') }}"
                                                data-text="{{ __('Cette action ne peut pas être annulée. Voulez-vous continuer?') }}"
                                                data-confirm-yes="delete-form-{{ $brand->id }}"
                                                data-bs-toggle="tooltip"
                                                data-bs-placement="top"
                                                title="{{ __('Delete') }}">
                                                <i class="ti ti-trash f-16"></i>
                                            </a>
                                            {!! Form::open(['method' => 'DELETE', 'route' => ['brands.destroy', $brand->id], 'id' => 'delete-form-' . $brand->id]) !!}
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <!-- Models Level (Hidden by default) -->
                    <div id="models-level" class="hierarchy-level" style="display: none;">
                        <div class="text-center py-3">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">{{ __('Chargement...') }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Families Level (Hidden by default) -->
                    <div id="families-level" class="hierarchy-level" style="display: none;">
                        <div class="text-center py-3">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">{{ __('Chargement...') }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Products Level (Hidden by default) -->
                    <div id="products-level" class="hierarchy-level" style="display: none;">
                        <div class="text-center py-3">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">{{ __('Chargement...') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal for adding/editing items -->
<div class="modal fade" id="addItemModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">{{ __('Ajouter') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="addItemForm">
                    <input type="hidden" id="itemId" name="item_id">
                    <input type="hidden" id="parentId" name="parent_id">
                    <input type="hidden" id="parentType" name="parent_type">
                    <input type="hidden" id="actionType" name="action_type">
                    
                    <div id="nameField" class="mb-3">
                        <label for="itemName" class="form-label">{{ __('Nom') }}</label>
                        <input type="text" class="form-control" id="itemName" name="name" required>
                    </div>
                    
                    <div id="quantityField" class="mb-3" style="display: none;">
                        <label for="quantity" class="form-label">{{ __('Quantité') }}</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" min="1">
                    </div>
                    
                    <div id="imageField" class="mb-3" style="display: none;">
                        <label for="familyImage" class="form-label">{{ __('Image') }}</label>
                        <input type="file" class="form-control" id="familyImage" name="image" accept="image/*">
                        <div id="imagePreview" class="mt-2" style="display: none;">
                            <img src="" alt="{{ __('Preview') }}" style="max-width: 200px; max-height: 200px; border-radius: 8px;">
                        </div>
                    </div>
                    
                    <div id="chassisField" style="display: none;">
                        <label class="form-label">{{ __('Numéros de châssis') }}</label>
                        <div class="mb-3">
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-outline-primary" onclick="showChassisInputs()">
                                    <i class="ti ti-pencil me-2"></i>{{ __('Ajouter manuellement') }}
                                </button>
                                <button type="button" class="btn btn-outline-success" onclick="showScanModal()">
                                    <i class="ti ti-scan me-2"></i>{{ __('Scanner') }}
                                </button>
                            </div>
                        </div>
                        <div id="chassisInputsContainer" style="display: none;">
                            <div class="mb-2">
                                <small class="text-muted">{{ __('Ajoutez les numéros de châssis avec dates optionnelles') }}</small>
                            </div>
                            <div id="chassisNumbersContainer">
                                <div class="input-group mb-2 chassis-input-row">
                                    <input type="text" class="form-control chassis-number" placeholder="{{ __('Numéro de châssis') }}">
                                    <input type="date" class="form-control chassis-date" placeholder="{{ __('Date') }}">
                                    <div class="form-control d-flex gap-3 p-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="location_0" id="location_0_depot" value="DEPOT" checked>
                                            <label class="form-check-label" for="location_0_depot">{{ __('DEPOT') }}</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="location_0" id="location_0_showroom" value="SHOW-ROOM">
                                            <label class="form-check-label" for="location_0_showroom">{{ __('SHOW-ROOM') }}</label>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-outline-secondary" onclick="addChassisInput()">
                                        <i class="ti ti-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Annuler') }}</button>
                <button type="button" class="btn btn-primary" onclick="saveItem()">{{ __('Enregistrer') }}</button>
            </div>
        </div>
    </div>
</div>

<!-- Simplified Scan Modal -->
<div class="modal fade" id="scanModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Scanner les numéros de châssis') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">{{ __('Numéro de châssis') }}</label>
                    <input type="text" class="form-control" id="scanInput" placeholder="{{ __('Scannez le code ici') }}" autocomplete="off">
                </div>
                
                <div class="mb-3">
                    <div id="scannedList" class="border rounded p-3" style="max-height: 200px; overflow-y: auto;">
                        <div class="text-muted text-center">{{ __('Aucun numéro scanné') }}</div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Annuler') }}</button>
                <button type="button" class="btn btn-primary" onclick="finishScanning()">
                    <i class="ti ti-check me-2"></i>{{ __('Terminer') }}
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Time and Location Modal (shown after scanning) -->
<div class="modal fade" id="timeLocationModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Définir la date et le lieu') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">{{ __('Date') }}</label>
                    <input type="date" class="form-control" id="globalDate">
                </div>
                
                <div class="mb-3">
                    <label class="form-label">{{ __('Lieu') }}</label>
                    <div class="d-flex gap-3">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="globalLocation" id="globalLocationDepot" value="DEPOT" checked>
                            <label class="form-check-label" for="globalLocationDepot">{{ __('DEPOT') }}</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="globalLocation" id="globalLocationShowroom" value="SHOW-ROOM">
                            <label class="form-check-label" for="globalLocationShowroom">{{ __('SHOW-ROOM') }}</label>
                        </div>
                    </div>
                </div>
                
                <div class="mb-3">
                    <h6>{{ __('Numéros scannés') }}:</h6>
                    <div id="finalScannedList" class="border rounded p-3" style="max-height: 150px; overflow-y: auto;">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Annuler') }}</button>
                <button type="button" class="btn btn-primary" onclick="saveScannedChassis()">
                    <i class="ti ti-check me-2"></i>{{ __('Enregistrer') }}
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script-page')
<script>
let currentLevel = 'brands';
let currentBrandId = null;
let currentModelId = null;
let currentFamilyId = null;
let scannedChassisNumbers = [];

function showNotification(message, type = 'success') {
    // Remove existing notifications
    document.querySelectorAll('.toast-notification').forEach(el => el.remove());
    
    const toast = document.createElement('div');
    toast.className = `toast-notification alert alert-${type} alert-dismissible fade show shadow`;
    toast.setAttribute('role', 'alert');
    toast.style.cssText = 'position: fixed; top: 20px; right: 20px; z-index: 99999; min-width: 300px; max-width: 500px; animation: slideIn 0.3s ease-out;';
    toast.innerHTML = `
        <div class="d-flex align-items-center">
            <i class="ti ${type === 'success' ? 'ti-check' : 'ti-alert-circle'} me-2" style="font-size: 20px;"></i>
            <span>${message}</span>
        </div>
        <button type="button" class="btn-close" onclick="this.parentElement.remove()"></button>
    `;
    document.body.appendChild(toast);
    
    // Auto-remove after 4 seconds
    setTimeout(() => {
        if (toast.parentElement) {
            toast.style.opacity = '0';
            toast.style.transition = 'opacity 0.3s';
            setTimeout(() => toast.remove(), 300);
        }
    }, 4000);
}

function addChassisInput() {
    const container = document.getElementById('chassisNumbersContainer');
    const inputCount = container.children.length;
    const inputGroup = document.createElement('div');
    inputGroup.className = 'input-group mb-2 chassis-input-row';
    inputGroup.innerHTML = `
        <input type="text" class="form-control chassis-number" placeholder="{{ __('Numéro de châssis') }}">
        <input type="date" class="form-control chassis-date" placeholder="{{ __('Date') }}">
        <div class="form-control d-flex gap-3 p-2">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="location_${inputCount}" id="location_${inputCount}_depot" value="DEPOT" checked>
                <label class="form-check-label" for="location_${inputCount}_depot">{{ __('DEPOT') }}</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="location_${inputCount}" id="location_${inputCount}_showroom" value="SHOW-ROOM">
                <label class="form-check-label" for="location_${inputCount}_showroom">{{ __('SHOW-ROOM') }}</label>
            </div>
        </div>
        <button type="button" class="btn btn-outline-danger" onclick="this.parentElement.remove()">
            <i class="ti ti-minus"></i>
        </button>
    `;
    container.appendChild(inputGroup);
}

function showChassisInputs() {
    document.getElementById('chassisInputsContainer').style.display = 'block';
}

function showScanModal() {
    // Clear previous scans
    scannedChassisNumbers = [];
    document.getElementById('scannedList').innerHTML = '<div class="text-muted text-center">{{ __("Aucun numéro scanné") }}</div>';
    
    // Show scan modal
    const modal = new bootstrap.Modal(document.getElementById('scanModal'));
    modal.show();
    
    // Focus on scan input
    setTimeout(() => {
        document.getElementById('scanInput').focus();
    }, 500);
}

function processScan() {
    const scanInput = document.getElementById('scanInput');
    const scannedValue = scanInput.value.trim();
    
    if (scannedValue) {
        // Check if already scanned
        if (!scannedChassisNumbers.some(item => item === scannedValue)) {
            scannedChassisNumbers.push(scannedValue);
            
            // Update scanned list
            const scannedList = document.getElementById('scannedList');
            if (scannedChassisNumbers.length === 1) {
                scannedList.innerHTML = '';
            }
            
            const itemDiv = document.createElement('div');
            itemDiv.className = 'd-flex justify-content-between align-items-center mb-2';
            itemDiv.innerHTML = `
                <span>${scannedValue}</span>
                <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeScannedItem('${scannedValue}', this)">
                    <i class="ti ti-x"></i>
                </button>
            `;
            scannedList.appendChild(itemDiv);
        }
        
        // Clear input and focus again for next scan
        scanInput.value = '';
        scanInput.focus();
    }
}

function removeScannedItem(value, button) {
    // Remove from array
    scannedChassisNumbers = scannedChassisNumbers.filter(item => item !== value);
    
    // Remove from DOM
    button.parentElement.remove();
    
    // Show empty message if no items
    if (scannedChassisNumbers.length === 0) {
        document.getElementById('scannedList').innerHTML = '<div class="text-muted text-center">{{ __("Aucun numéro scanné") }}</div>';
    }
}

function finishScanning() {
    if (scannedChassisNumbers.length === 0) {
        alert('{{ __("Veuillez scanner au moins un numéro de châssis") }}');
        return;
    }
    
    // Close scan modal
    bootstrap.Modal.getInstance(document.getElementById('scanModal')).hide();
    
    // Show time/location modal
    const timeLocationModal = new bootstrap.Modal(document.getElementById('timeLocationModal'));
    timeLocationModal.show();
    
    // Set current date as default
    const now = new Date();
    const currentDate = now.toISOString().slice(0, 10);
    document.getElementById('globalDate').value = currentDate;
    
    // Show scanned numbers in final list
    const finalList = document.getElementById('finalScannedList');
    finalList.innerHTML = scannedChassisNumbers.map(number => 
        `<div class="mb-1">${number}</div>`
    ).join('');
}

function saveScannedChassis() {
    const date = document.getElementById('globalDate').value;
    const locationRadio = document.querySelector('input[name="globalLocation"]:checked');
    const location = locationRadio ? locationRadio.value : 'DEPOT';
    
    if (!date) {
        alert('{{ __("Veuillez définir la date") }}');
        return;
    }
    
    // Close time/location modal
    bootstrap.Modal.getInstance(document.getElementById('timeLocationModal')).hide();
    
    // Show chassis inputs
    showChassisInputs();
    
    // Transfer to chassis inputs
    const container = document.getElementById('chassisNumbersContainer');
    container.innerHTML = '';
    
    scannedChassisNumbers.forEach((number, index) => {
        const inputGroup = document.createElement('div');
        inputGroup.className = 'input-group mb-2 chassis-input-row';
        inputGroup.innerHTML = `
            <input type="text" class="form-control chassis-number" value="${number}" placeholder="{{ __('Numéro de châssis') }}">
            <input type="date" class="form-control chassis-date" value="${date}" placeholder="{{ __('Date') }}">
            <div class="form-control d-flex gap-3 p-2">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="location_${index}" id="location_${index}_depot" value="DEPOT" ${location === 'DEPOT' ? 'checked' : ''}>
                    <label class="form-check-label" for="location_${index}_depot">{{ __('DEPOT') }}</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="location_${index}" id="location_${index}_showroom" value="SHOW-ROOM" ${location === 'SHOW-ROOM' ? 'checked' : ''}>
                    <label class="form-check-label" for="location_${index}_showroom">{{ __('SHOW-ROOM') }}</label>
                </div>
            </div>
            <button type="button" class="btn btn-outline-danger" onclick="this.parentElement.remove()">
                <i class="ti ti-minus"></i>
            </button>
        `;
        container.appendChild(inputGroup);
    });
    
    // Add one empty input for manual entry
    addChassisInput();
}

function editChassis(id, chassisNumber, date, location) {
    // Set form data for editing
    document.getElementById('itemId').value = id;
    document.getElementById('parentId').value = currentFamilyId;
    document.getElementById('parentType').value = 'chassis_edit';
    document.getElementById('actionType').value = 'chassis_edit';
    
    // Set modal title
    document.getElementById('modalTitle').textContent = '{{ __("Modifier le numéro de châssis") }}';
    
    // Show only chassis field
    document.getElementById('nameField').style.display = 'none';
    document.getElementById('quantityField').style.display = 'none';
    document.getElementById('imageField').style.display = 'none';
    document.getElementById('chassisField').style.display = 'block';
    document.getElementById('chassisInputsContainer').style.display = 'block';
    
    const depotChecked = (!location || location === 'DEPOT') ? 'checked' : '';
    const showroomChecked = (location === 'SHOW-ROOM') ? 'checked' : '';
    
    // Populate with existing data
    const container = document.getElementById('chassisNumbersContainer');
    container.innerHTML = `
        <div class="input-group mb-2 chassis-input-row">
            <input type="text" class="form-control chassis-number" value="${chassisNumber}" placeholder="{{ __('Numéro de châssis') }}">
            <input type="date" class="form-control chassis-date" value="${date || ''}" placeholder="{{ __('Date') }}">
            <div class="form-control d-flex gap-3 p-2">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="location_0" id="location_0_depot" value="DEPOT" ${depotChecked}>
                    <label class="form-check-label" for="location_0_depot">{{ __('DEPOT') }}</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="location_0" id="location_0_showroom" value="SHOW-ROOM" ${showroomChecked}>
                    <label class="form-check-label" for="location_0_showroom">{{ __('SHOW-ROOM') }}</label>
                </div>
            </div>
        </div>
    `;
    
    // Show modal
    const modal = new bootstrap.Modal(document.getElementById('addItemModal'));
    modal.show();
}

function deleteChassis(id) {
    if (confirm('{{ __("Êtes-vous sûr de vouloir supprimer ce numéro de châssis?") }}')) {
        fetch(`/chassis/${id}/delete`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showNotification(data.message, 'success');
                loadProducts(currentFamilyId);
            } else {
                showNotification(data.message || '{{ __("Une erreur est survenue") }}', 'danger');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showNotification('{{ __("Une erreur est survenue") }}', 'danger');
        });
    }
}

// Handle Enter key in scan input
document.addEventListener('DOMContentLoaded', function() {
    document.addEventListener('keypress', function(e) {
        if (e.target.id === 'scanInput' && e.key === 'Enter') {
            e.preventDefault();
            processScan();
        }
    });
});

function saveItem() {
    console.log('=== saveItem() START ===');
    
    const form = document.getElementById('addItemForm');
    if (!form) {
        console.error('Form not found!');
        alert('{{ __("Formulaire non trouvé") }}');
        return;
    }
    
    const formData = new FormData(form);
    const actionType = formData.get('action_type');
    const itemId = formData.get('item_id');
    
    console.log('Action Type:', actionType);
    console.log('Item ID:', itemId);
    
    try {
        if (actionType === 'chassis') {
            const chassisInputs = document.querySelectorAll('.chassis-input-row');
            const chassisNumbers = [];
            
            console.log('Found chassis inputs:', chassisInputs.length);
            
            chassisInputs.forEach((row, index) => {
                const numberInput = row.querySelector('.chassis-number');
                const dateInput = row.querySelector('.chassis-date');
                const locationRadio = row.querySelector('input[type="radio"]:checked');
                
                // Get location value, default to DEPOT if not selected
                const location = locationRadio ? locationRadio.value : 'DEPOT';
                
                console.log(`Row ${index}:`, {
                    number: numberInput ? numberInput.value : 'null',
                    date: dateInput ? dateInput.value : 'null',
                    location: location,
                    locationRadio: locationRadio ? locationRadio.value : 'none'
                });
                
                if (numberInput && numberInput.value.trim()) {
                    chassisNumbers.push({
                        number: numberInput.value.trim(),
                        date: dateInput && dateInput.value ? dateInput.value : null,
                        location: location
                    });
                }
            });
            
            console.log('Chassis numbers to send:', chassisNumbers);
            
            if (chassisNumbers.length === 0) {
                alert('{{ __("Veuillez ajouter au moins un numéro de châssis") }}');
                return;
            }
            
            // Clear existing chassis data from form
            formData.delete('name');
            formData.delete('quantity');
            
            // Add chassis numbers with simplified structure
            chassisNumbers.forEach((chassis, index) => {
                formData.append(`chassis_numbers[${index}][number]`, chassis.number);
                formData.append(`chassis_numbers[${index}][date]`, chassis.date || '');
                formData.append(`chassis_numbers[${index}][location]`, chassis.location || 'DEPOT');
                console.log(`Adding chassis ${index}:`, {
                    number: chassis.number,
                    date: chassis.date || '',
                    location: chassis.location || 'DEPOT'
                });
            });
            
            console.log('FormData entries:');
            for (let pair of formData.entries()) {
                console.log(pair[0], pair[1]);
            }
        }
        
        // Handle chassis edit (single chassis update)
        if (actionType === 'chassis_edit' && itemId) {
            const row = document.querySelector('.chassis-input-row');
            const numberInput = row.querySelector('.chassis-number');
            const dateInput = row.querySelector('.chassis-date');
            const locationRadio = row.querySelector('input[type="radio"]:checked');
            
            const updateData = {
                chassis_number: numberInput.value.trim(),
                date: dateInput ? dateInput.value : null,
                location: locationRadio ? locationRadio.value : 'DEPOT'
            };
            
            console.log('Updating chassis:', itemId, updateData);
            
            const csrfToken = document.querySelector('meta[name="csrf-token"]');
            fetch(`/chassis/${itemId}/update`, {
                method: 'POST',
                body: JSON.stringify(updateData),
                headers: {
                    'X-CSRF-TOKEN': csrfToken.getAttribute('content'),
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    bootstrap.Modal.getInstance(document.getElementById('addItemModal')).hide();
                    showNotification(data.message, 'success');
                    loadProducts(currentFamilyId);
                } else {
                    showNotification(data.message || '{{ __("Une erreur est survenue") }}', 'danger');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('{{ __("Une erreur est survenue: ") }}' + error.message, 'danger');
            });
            return;
        }
        
        // Determine the correct URL
        let url = '/hierarchy-store';
        let method = 'POST';
        
        if (itemId && (actionType === 'model' || actionType === 'family')) {
            switch(actionType) {
                case 'model':
                    url = `/models/${itemId}/update`;
                    break;
                case 'family':
                    url = `/families/${itemId}/update`;
                    break;
            }
        }
        
        // Get CSRF token
        const csrfToken = document.querySelector('meta[name="csrf-token"]');
        if (!csrfToken) {
            console.error('CSRF token not found!');
            showNotification('{{ __("Jeton CSRF non trouvé") }}', 'danger');
            return;
        }
        
        console.log('Sending to:', url, 'Method:', method, 'ActionType:', actionType, 'ItemId:', itemId);
        console.log('FormData entries:');
        for (let pair of formData.entries()) {
            console.log('  ', pair[0], ':', pair[1]);
        }
        
        fetch(url, {
            method: method,
            body: formData,
            headers: {
                'X-CSRF-TOKEN': csrfToken.getAttribute('content'),
                'Accept': 'application/json'
            }
        })
        .then(async response => {
            console.log('Response status:', response.status);
            
            // Always try to read response body
            const text = await response.text();
            console.log('Response body:', text);
            
            let data;
            try {
                data = JSON.parse(text);
            } catch (e) {
                console.error('Response is not JSON:', text.substring(0, 500));
                throw new Error('{{ __("Réponse invalide du serveur (status: ") }}' + response.status + ')');
            }
            
            return data;
        })
        .then(data => {
            console.log('Parsed data:', data);
            if (data.success) {
                bootstrap.Modal.getInstance(document.getElementById('addItemModal')).hide();
                showNotification(data.message, 'success');
                // Refresh current level
                if (currentLevel === 'models') loadModels(currentBrandId);
                else if (currentLevel === 'families') loadFamilies(currentModelId);
                else if (currentLevel === 'products') loadProducts(currentFamilyId);
            } else {
                // Show actual server error message
                const errorMsg = data.message || (data.errors ? Object.values(data.errors).flat().join(', ') : '{{ __("Une erreur est survenue") }}');
                console.error('Server error:', errorMsg);
                showNotification(errorMsg, 'danger');
            }
        })
        .catch(error => {
            console.error('Fetch error:', error);
            showNotification(error.message || '{{ __("Une erreur est survenue") }}', 'danger');
        });
        
    } catch (error) {
        console.error('JavaScript error:', error);
        showNotification('{{ __("Erreur JavaScript: ") }}' + error.message, 'danger');
    }
}

function updateBreadcrumb(levels) {
    const breadcrumb = document.getElementById('breadcrumb-nav');
    const backBtn = document.getElementById('back-btn');
    breadcrumb.innerHTML = '';
    
    // Show/hide back button based on current level
    if (levels.length > 1) {
        backBtn.style.display = 'inline-flex';
    } else {
        backBtn.style.display = 'none';
    }
    
    levels.forEach((level, index) => {
        const li = document.createElement('li');
        li.className = 'breadcrumb-item';
        
        if (index === levels.length - 1) {
            li.className += ' active';
            li.setAttribute('aria-current', 'page');
            li.textContent = level.name;
        } else {
            const a = document.createElement('a');
            a.href = '#';
            a.className = 'breadcrumb-link';
            a.setAttribute('data-level', level.level);
            a.textContent = level.name;
            a.onclick = (e) => {
                e.preventDefault();
                navigateToLevel(level.level, level.data);
            };
            li.appendChild(a);
        }
        
        breadcrumb.appendChild(li);
    });
}

function showLevel(levelId) {
    document.querySelectorAll('.hierarchy-level').forEach(el => {
        el.style.display = 'none';
    });
    document.getElementById(levelId).style.display = 'block';
}

function goBack() {
    console.log('Going back...');
    const mainAddBtn = document.getElementById('main-add-btn');
    
    if (currentLevel === 'models') {
        // Go back to brands
        currentLevel = 'brands';
        currentBrandId = null;
        showLevel('brands-level');
        updateBreadcrumb([
            {name: '{{ __("Marques") }}', level: 'brands'}
        ]);
        // Show main add button
        mainAddBtn.style.display = 'block';
    } else if (currentLevel === 'families') {
        // Go back to models
        currentLevel = 'models';
        currentModelId = null;
        showLevel('models-level');
        updateBreadcrumb([
            {name: '{{ __("Marques") }}', level: 'brands'},
            {name: '{{ __("Modèles") }}', level: 'models', data: {brandId: currentBrandId}}
        ]);
        // Hide main add button
        mainAddBtn.style.display = 'none';
    } else if (currentLevel === 'products') {
        // Go back to families
        currentLevel = 'families';
        currentFamilyId = null;
        showLevel('families-level');
        updateBreadcrumb([
            {name: '{{ __("Marques") }}', level: 'brands'},
            {name: '{{ __("Modèles") }}', level: 'models', data: {brandId: currentBrandId}},
            {name: '{{ __("Familles") }}', level: 'families', data: {modelId: currentModelId}}
        ]);
        // Hide main add button
        mainAddBtn.style.display = 'none';
    }
}

function navigateToLevel(level, data) {
    console.log('Navigating to level:', level, data);
    const mainAddBtn = document.getElementById('main-add-btn');
    
    if (level === 'brands') {
        currentLevel = 'brands';
        currentBrandId = null;
        currentModelId = null;
        currentFamilyId = null;
        showLevel('brands-level');
        updateBreadcrumb([
            {name: '{{ __("Marques") }}', level: 'brands'}
        ]);
        // Show main add button
        mainAddBtn.style.display = 'block';
    } else if (level === 'models') {
        loadModels(data.brandId);
        // Hide main add button
        mainAddBtn.style.display = 'none';
    } else if (level === 'families') {
        loadFamilies(data.modelId);
        // Hide main add button
        mainAddBtn.style.display = 'none';
    }
}

function loadModels(brandId) {
    console.log('Loading models for brand:', brandId);
    currentLevel = 'models';
    currentBrandId = brandId;
    
    fetch(`/brands/${brandId}/models`, {
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        }
    })
        .then(response => {
            console.log('Response status:', response.status);
            return response.json();
        })
        .then(data => {
            console.log('Models data:', data);
            const container = document.getElementById('models-level');
            if (data.models && data.models.length > 0) {
                let html = '<div class="mb-3"><button class="btn btn-primary btn-sm" onclick="showAddModal(\'model\', ' + brandId + ')"><i class="ti ti-plus me-2"></i>{{ __("Ajouter un modèle") }}</button></div>';
                html += '<div class="list-group">';
                data.models.forEach(model => {
                    html += `
                        <div class="list-group-item d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <i class="ti ti-package me-2 text-primary"></i>
                                <div>
                                    <h6 class="mb-0">${model.name}</h6>
                                    <small class="text-muted">{{ __('Modèle') }}</small>
                                </div>
                            </div>
                            <div class="d-flex gap-2">
                                 <button class="btn btn-sm btn-outline-primary drill-down-btn" 
                                        data-level="families"
                                        data-model-id="${model.id}"
                                        data-model-name="${model.name}"
                                        onclick="handleDrillDown(this)">
                                    <i class="ti ti-arrow-right"></i>
                                </button>
                                <button class="btn btn-sm btn-icon bg-info text-white" 
                                        onclick="editModel(${model.id})"
                                        data-bs-toggle="tooltip" 
                                        data-bs-placement="top" 
                                        title="{{ __('Edit') }}">
                                    <i class="ti ti-pencil f-16"></i>
                                </button>
                                <button class="btn btn-sm btn-icon bg-danger text-white" 
                                        onclick="deleteModel(${model.id})"
                                        data-bs-toggle="tooltip" 
                                        data-bs-placement="top" 
                                        title="{{ __('Delete') }}">
                                    <i class="ti ti-trash f-16"></i>
                                </button>
                            </div>
                        </div>
                    `;
                });
                html += '</div>';
                container.innerHTML = html;
            } else {
                container.innerHTML = `
                    <div class="text-center py-5">
                        <i class="ti ti-package text-muted" style="font-size: 3rem;"></i>
                        <h5 class="mt-3 text-muted">{{ __('Aucun modèle trouvé') }}</h5>
                        <button class="btn btn-primary" onclick="showAddModal('model', ${brandId})">
                            <i class="ti ti-plus me-2"></i>{{ __('Ajouter un modèle') }}
                        </button>
                    </div>
                `;
            }
            showLevel('models-level');
        })
        .catch(error => {
            console.error('Error loading models:', error);
            const container = document.getElementById('models-level');
            container.innerHTML = `
                <div class="text-center py-5">
                    <i class="ti ti-alert-triangle text-danger" style="font-size: 3rem;"></i>
                    <h5 class="mt-3 text-danger">{{ __('Erreur de chargement') }}</h5>
                    <p class="text-muted">${error.message}</p>
                </div>
            `;
            showLevel('models-level');
        });
}

function loadFamilies(modelId) {
    console.log('Loading families for model:', modelId);
    currentLevel = 'families';
    currentModelId = modelId;
    
    fetch(`/models/${modelId}/families`, {
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        }
    })
        .then(response => response.json())
        .then(data => {
            console.log('Families data:', data);
            const container = document.getElementById('families-level');
            if (data.families && data.families.length > 0) {
                let html = '<div class="mb-3"><button class="btn btn-primary btn-sm" onclick="showAddModal(\'family\', ' + modelId + ')"><i class="ti ti-plus me-2"></i>{{ __("Ajouter une famille") }}</button></div>';
                html += '<div class="list-group">';
                data.families.forEach(family => {
                    html += `
                        <div class="list-group-item">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    ${family.image ? 
                                        (() => {
                                            const imagePath = `{{ asset('storage/uploads/family_image') }}/${family.image}`;
                                            console.log('Family image path:', imagePath);
                                            console.log('Family image filename:', family.image);
                                            return `<img src="${imagePath}" alt="${family.name}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 8px; margin-right: 12px;" onerror="console.error('Image failed to load:', this.src); this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                            <div class="me-3 bg-success rounded d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; border-radius: 8px; display: none;">
                                                <i class="ti ti-folders text-white" style="font-size: 24px;"></i>
                                            </div>`;
                                        })()
                                        : 
                                        `<div class="me-3 bg-success rounded d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; border-radius: 8px;">
                                            <i class="ti ti-folders text-white" style="font-size: 24px;"></i>
                                        </div>`
                                    }
                                    <div>
                                        <h6 class="mb-0">${family.name}</h6>
                                        <small class="text-muted">{{ __('Famille') }} • {{ __('Quantité') }}: ${family.quantity || 0}</small><br>
                                        <small class="text-success">{{ __('SHOW-ROOM') }}: ${family.qty_showroom || 0}</small> - 
                                        <small class="text-secondary">{{ __('DEPOT') }}: ${family.qty_depot || 0}</small>
                                    </div>
                                </div>
                                <div class="d-flex gap-2">
                                    <button class="btn btn-sm btn-outline-warning drill-down-btn" 
                                            data-level="products"
                                            data-family-id="${family.id}"
                                            data-family-name="${family.name}"
                                            onclick="handleDrillDown(this)">
                                        <i class="ti ti-arrow-right"></i>
                                    </button>
                                    <button class="btn btn-sm btn-icon bg-info text-white" 
                                            onclick="editFamily(${family.id})"
                                            data-bs-toggle="tooltip" 
                                            data-bs-placement="top" 
                                            title="{{ __('Edit') }}">
                                        <i class="ti ti-pencil f-16"></i>
                                    </button>
                                    <button class="btn btn-sm btn-icon bg-danger text-white" 
                                            onclick="deleteFamily(${family.id})"
                                            data-bs-toggle="tooltip" 
                                            data-bs-placement="top" 
                                            title="{{ __('Delete') }}">
                                        <i class="ti ti-trash f-16"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    `;
                });
                html += '</div>';
                container.innerHTML = html;
            } else {
                container.innerHTML = `
                    <div class="text-center py-5">
                        <i class="ti ti-folders text-muted" style="font-size: 3rem;"></i>
                        <h5 class="mt-3 text-muted">{{ __('Aucune famille trouvée') }}</h5>
                        <button class="btn btn-primary" onclick="showAddModal('family', ${modelId})">
                            <i class="ti ti-plus me-2"></i>{{ __('Ajouter une famille') }}
                        </button>
                    </div>
                `;
            }
            showLevel('families-level');
        });
}

function loadProducts(familyId) {
    console.log('Loading products for family:', familyId);
    currentLevel = 'products';
    currentFamilyId = familyId;
    
    fetch(`/families/${familyId}/products`, {
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        }
    })
        .then(response => response.json())
        .then(data => {
            console.log('Products data:', data);
            const container = document.getElementById('products-level');
            if (data.products && data.products.length > 0) {
                let html = '<div class="mb-3"><button class="btn btn-primary btn-sm" onclick="showAddModal(\'chassis\', ' + familyId + ')"><i class="ti ti-plus me-2"></i>{{ __("Ajouter des numéros de châssis") }}</button></div>';
                html += '<div class="list-group">';
                data.products.forEach(product => {
                    html += `
                        <div class="list-group-item">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <i class="ti ti-box me-2 text-info"></i>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-0">${product.name}</h6>
                                        <small class="text-muted">{{ __('Produit') }}</small>
                                    </div>
                                    <div class="ms-3">
                                        <span class="badge bg-primary me-2">{{ __('Numéro de châssis') }}: ${product.chassis_number}</span>
                                        ${product.date ? `<span class="badge bg-secondary me-2">${product.date}</span>` : ''}
                                        ${product.location ? `<span class="badge bg-warning text-dark">${product.location}</span>` : ''}
                                    </div>
                                </div>
                                <div class="d-flex gap-2">
                                    <button class="btn btn-sm btn-icon bg-info text-white" 
                                            data-chassis-id="${product.id}"
                                            data-chassis-number="${encodeURIComponent(product.chassis_number)}"
                                            data-chassis-date="${product.date || ''}"
                                            data-chassis-location="${product.location || 'DEPOT'}"
                                            onclick="editChassis(this.dataset.chassisId, decodeURIComponent(this.dataset.chassisNumber), this.dataset.chassisDate, this.dataset.chassisLocation)"
                                            data-bs-toggle="tooltip" 
                                            data-bs-placement="top" 
                                            title="{{ __('Edit') }}">
                                        <i class="ti ti-pencil f-16"></i>
                                    </button>
                                    <button class="btn btn-sm btn-icon bg-danger text-white" 
                                            onclick="deleteChassis(${product.id})"
                                            data-bs-toggle="tooltip" 
                                            data-bs-placement="top" 
                                            title="{{ __('Delete') }}">
                                        <i class="ti ti-trash f-16"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    `;
                });
                html += '</div>';
                html += `
                    <div class="mt-3">
                        <button class="btn btn-primary" onclick="showAddModal('chassis', ${familyId})">
                            <i class="ti ti-plus me-2"></i>{{ __('Ajouter des numéros de châssis') }}
                        </button>
                    </div>
                `;
                container.innerHTML = html;
            } else {
                container.innerHTML = `
                    <div class="text-center py-5">
                        <i class="ti ti-box text-muted" style="font-size: 3rem;"></i>
                        <h5 class="mt-3 text-muted">{{ __('Aucun produit trouvé') }}</h5>
                        <button class="btn btn-primary" onclick="showAddModal('chassis', ${familyId})">
                            <i class="ti ti-plus me-2"></i>{{ __('Ajouter des numéros de châssis') }}
                        </button>
                    </div>
                `;
            }
            showLevel('products-level');
        });
}

function handleDrillDown(button) {
    console.log('Drill down button clicked!', button);
    const level = button.dataset.level;
    const mainAddBtn = document.getElementById('main-add-btn');
    console.log('Button dataset:', button.dataset);
    
    // Hide main add button when drilling down
    mainAddBtn.style.display = 'none';
    
    if (level === 'models') {
        loadModels(button.dataset.brandId);
        updateBreadcrumb([
            {name: '{{ __("Marques") }}', level: 'brands'},
            {name: button.dataset.brandName, level: 'models', data: {brandId: button.dataset.brandId}}
        ]);
    } else if (level === 'families') {
        loadFamilies(button.dataset.modelId);
        updateBreadcrumb([
            {name: '{{ __("Marques") }}', level: 'brands'},
            {name: '{{ __("Modèles") }}', level: 'models', data: {brandId: currentBrandId}},
            {name: button.dataset.modelName, level: 'families', data: {modelId: button.dataset.modelId}}
        ]);
    } else if (level === 'products') {
        loadProducts(button.dataset.familyId);
        updateBreadcrumb([
            {name: '{{ __("Marques") }}', level: 'brands'},
            {name: '{{ __("Modèles") }}', level: 'models', data: {brandId: currentBrandId}},
            {name: '{{ __("Familles") }}', level: 'families', data: {modelId: currentModelId}},
            {name: button.dataset.familyName, level: 'products', data: {familyId: button.dataset.familyId}}
        ]);
    }
}

function showAddModal(type, parentId, itemId = null) {
    const modal = new bootstrap.Modal(document.getElementById('addItemModal'));
    const title = document.getElementById('modalTitle');
    const nameField = document.getElementById('nameField');
    const quantityField = document.getElementById('quantityField');
    const imageField = document.getElementById('imageField');
    const chassisField = document.getElementById('chassisField');
    const itemIdField = document.getElementById('itemId');
    const imageInput = document.getElementById('familyImage');
    const imagePreview = document.getElementById('imagePreview');
    
    // Reset form
    document.getElementById('addItemForm').reset();
    document.getElementById('chassisInputsContainer').style.display = 'none';
    document.getElementById('chassisNumbersContainer').innerHTML = '';
    imagePreview.style.display = 'none';
    
    itemIdField.value = itemId || '';
    document.getElementById('parentId').value = parentId;
    document.getElementById('actionType').value = type;
    
    // Set modal title based on whether we're editing or creating
    if (itemId) {
        // Edit mode
        switch(type) {
            case 'model':
                title.textContent = '{{ __("Modifier le modèle") }}';
                break;
            case 'family':
                title.textContent = '{{ __("Modifier la famille") }}';
                break;
            case 'chassis':
                title.textContent = '{{ __("Modifier les numéros de châssis") }}';
                break;
        }
    } else {
        // Create mode
        switch(type) {
            case 'model':
                title.textContent = '{{ __("Ajouter un modèle") }}';
                break;
            case 'family':
                title.textContent = '{{ __("Ajouter une famille") }}';
                break;
            case 'chassis':
                title.textContent = '{{ __("Ajouter des numéros de châssis") }}';
                break;
        }
    }
    
    switch(type) {
        case 'model':
            nameField.style.display = 'block';
            quantityField.style.display = 'none';
            imageField.style.display = 'none';
            chassisField.style.display = 'none';
            // Load model data if editing
            if (itemId) {
                fetch(`/models/${itemId}/edit`, {
                    headers: { 'Accept': 'application/json' }
                })
                    .then(response => {
                        console.log('Edit model response status:', response.status);
                        return response.json();
                    })
                    .then(data => {
                        console.log('Edit model data:', data);
                        if (data.model) {
                            document.getElementById('itemName').value = data.model.name;
                        }
                    })
                    .catch(error => {
                        console.error('Error loading model:', error);
                        showNotification('{{ __("Erreur lors du chargement du modèle") }}', 'danger');
                    });
            }
            break;
        case 'family':
            nameField.style.display = 'block';
            quantityField.style.display = 'block';
            imageField.style.display = 'block';
            chassisField.style.display = 'none';
            // Load family data if editing
            if (itemId) {
                fetch(`/families/${itemId}/edit`, {
                    headers: { 'Accept': 'application/json' }
                })
                    .then(response => {
                        console.log('Edit family response status:', response.status);
                        return response.json();
                    })
                    .then(data => {
                        console.log('Edit family data:', data);
                        if (data.family) {
                            document.getElementById('itemName').value = data.family.name;
                            document.getElementById('quantity').value = data.family.quantity;
                            // Show existing image if available
                            if (data.family.image) {
                                const img = imagePreview.querySelector('img');
                                img.src = `{{ asset('storage/uploads/family_image') }}/${data.family.image}`;
                                imagePreview.style.display = 'block';
                            }
                        }
                    })
                    .catch(error => {
                        console.error('Error loading family:', error);
                        showNotification('{{ __("Erreur lors du chargement de la famille") }}', 'danger');
                    });
            }
            // Add image preview functionality
            imageInput.onchange = function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const img = imagePreview.querySelector('img');
                        img.src = e.target.result;
                        imagePreview.style.display = 'block';
                    };
                    reader.readAsDataURL(file);
                }
            };
            break;
        case 'chassis':
            nameField.style.display = 'none';
            quantityField.style.display = 'none';
            imageField.style.display = 'none';
            chassisField.style.display = 'block';
            // Show chassis inputs by default
            showChassisInputs();
            break;
    }
    
    modal.show();
}

// Edit and Delete Functions
function editModel(id) {
    showAddModal('model', null, id);
}

function editFamily(id) {
    showAddModal('family', null, id);
}

function deleteModel(id) {
    if (confirm('{{ __("Êtes-vous sûr de vouloir supprimer ce modèle?") }}')) {
        fetch(`/models/${id}/delete`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showNotification(data.message, 'success');
                loadModels(currentBrandId);
            } else {
                showNotification(data.message || '{{ __("Erreur lors de la suppression") }}', 'danger');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showNotification('{{ __("Erreur lors de la suppression") }}', 'danger');
        });
    }
}

function deleteFamily(id) {
    if (confirm('{{ __("Êtes-vous sûr de vouloir supprimer cette famille?") }}')) {
        fetch(`/families/${id}/delete`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showNotification(data.message, 'success');
                loadFamilies(currentModelId);
            } else {
                showNotification(data.message || '{{ __("Erreur lors de la suppression") }}', 'danger');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showNotification('{{ __("Erreur lors de la suppression") }}', 'danger');
        });
    }
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    console.log('Page loaded, setting up plus buttons');
    console.log('handleDrillDown function exists:', typeof handleDrillDown);
    
    // Add onclick handlers to all existing drill-down buttons
    const buttons = document.querySelectorAll('.drill-down-btn');
    console.log('Found buttons:', buttons.length);
    
    buttons.forEach(button => {
        console.log('Setting up button:', button);
        button.onclick = function() {
            console.log('Button clicked via onclick!');
            handleDrillDown(this);
        };
    });
});
</script>
@endpush
