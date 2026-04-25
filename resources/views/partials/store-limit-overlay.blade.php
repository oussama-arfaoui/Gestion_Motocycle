@push('style-page')
<style>
    .page-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.7);
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
        z-index: 9999;
        display: none;
        justify-content: center;
        align-items: center;
        animation: fadeIn 0.3s ease-in-out;
    }

    .page-overlay.show {
        display: flex;
    }

    .upgrade-modal {
        background: white;
        border-radius: 12px;
        padding: 40px;
        max-width: 500px;
        width: 90%;
        text-align: center;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        animation: slideUp 0.4s ease-out;
        position: relative;
    }

    .upgrade-modal::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 5px;
        background: linear-gradient(90deg, #ff6b6b, #feca57, #48dbfb, #ff9ff3);
        border-radius: 12px 12px 0 0;
    }

    .upgrade-icon {
        font-size: 4rem;
        color: #ff6b6b;
        margin-bottom: 20px;
        animation: pulse 2s infinite;
    }

    .upgrade-title {
        font-size: 1.8rem;
        font-weight: bold;
        color: #2c3e50;
        margin-bottom: 15px;
    }

    .upgrade-message {
        color: #7f8c8d;
        font-size: 1.1rem;
        margin-bottom: 25px;
        line-height: 1.6;
    }

    .upgrade-info {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 20px;
        border-radius: 8px;
        margin-bottom: 30px;
        text-align: left;
    }

    .upgrade-info h5 {
        margin-bottom: 15px;
        font-size: 1.1rem;
    }

    .upgrade-info ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .upgrade-info li {
        padding: 5px 0;
        display: flex;
        align-items: center;
    }

    .upgrade-info li::before {
        content: 'check_circle';
        font-family: 'Material Icons';
        margin-right: 10px;
        color: #4ade80;
    }

    .upgrade-buttons {
        display: flex;
        gap: 15px;
        justify-content: center;
        flex-wrap: wrap;
    }

    .btn-upgrade {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        padding: 12px 30px;
        border-radius: 25px;
        font-weight: bold;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-upgrade:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(102, 126, 234, 0.4);
        color: white;
    }

    .btn-cancel {
        background: #ecf0f1;
        color: #7f8c8d;
        border: none;
        padding: 12px 30px;
        border-radius: 25px;
        font-weight: bold;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn-cancel:hover {
        background: #bdc3c7;
        color: #2c3e50;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes slideUp {
        from { 
            opacity: 0;
            transform: translateY(30px);
        }
        to { 
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.05); }
    }

    /* Responsive */
    @media (max-width: 768px) {
        .upgrade-modal {
            padding: 30px 20px;
            margin: 20px;
        }
        
        .upgrade-title {
            font-size: 1.5rem;
        }
        
        .upgrade-buttons {
            flex-direction: column;
        }
        
        .btn-upgrade, .btn-cancel {
            width: 100%;
        }
    }
</style>
@endpush

@push('script-page')
<script>
    var planIndexUrl = @json(route('plans.index'));
    var storeCount = @json(getSuperAdminStoreCount());
    var canCreate = @json(canCreateStore());
    var storeCreateRoute = @json(route('store-resource.create'));

    // Intercept AJAX: when the store creation form is loaded, apply blur
    $(document).ajaxComplete(function(event, xhr, settings) {
        if (settings.url && settings.url.indexOf('/store-resource/create') !== -1 && !canCreate) {
            console.log('Store creation AJAX detected! Applying blur...');

            // Wait for modal to be fully shown
            setTimeout(function() {
                var modalContent = document.querySelector('#commonModal .modal-content');
                console.log('modal-content found:', !!modalContent);

                if (!modalContent) return;

                // Apply blur
                modalContent.style.filter        = 'blur(8px)';
                modalContent.style.webkitFilter   = 'blur(8px)';
                modalContent.style.pointerEvents  = 'none';
                modalContent.style.userSelect     = 'none';
                console.log('Blur applied!');

                // Remove existing overlay
                var existing = document.getElementById('store-limit-overlay');
                if (existing) existing.remove();

                // Create overlay message
                var overlay = document.createElement('div');
                overlay.id = 'store-limit-overlay';
                overlay.style.cssText = 'position:fixed;top:0;left:0;width:100%;height:100%;z-index:9999999;display:flex;justify-content:center;align-items:center;background:rgba(0,0,0,0.4);';
                overlay.innerHTML =
                    '<div style="background:white;border-radius:12px;padding:40px 30px;max-width:450px;width:90%;text-align:center;box-shadow:0 20px 60px rgba(0,0,0,0.5);">' +
                        '<div style="font-size:3.5rem;color:#ff6b6b;margin-bottom:15px;"><i class="ti ti-lock"></i></div>' +
                        '<h3 style="font-size:1.8rem;font-weight:bold;color:#2c3e50;margin-bottom:15px;">Améliorer le plan</h3>' +
                        '<p style="color:#7f8c8d;font-size:1rem;margin-bottom:25px;">Votre super administrateur a actuellement <strong>' + storeCount + ' magasin' + (storeCount <= 1 ? '' : 's') + '</strong>. Pour créer plus de magasins, veuillez améliorer votre plan.</p>' +
                        '<div style="display:flex;gap:15px;justify-content:center;flex-wrap:wrap;">' +
                            '<button id="btn-store-limit-close" style="background:#ecf0f1;color:#7f8c8d;border:none;padding:12px 25px;border-radius:25px;font-weight:bold;cursor:pointer;font-size:1rem;">Plus tard</button>' +
                            '<a href="' + planIndexUrl + '" style="background:linear-gradient(135deg,#667eea 0%,#764ba2 100%);color:white;text-decoration:none;padding:12px 25px;border-radius:25px;font-weight:bold;display:inline-flex;align-items:center;gap:8px;font-size:1rem;"><i class="ti ti-rocket"></i> Améliorer le plan</a>' +
                        '</div>' +
                    '</div>';

                document.body.appendChild(overlay);

                document.getElementById('btn-store-limit-close').addEventListener('click', function() {
                    document.getElementById('store-limit-overlay').remove();
                    var mc = document.querySelector('#commonModal .modal-content');
                    if (mc) { mc.style.filter = ''; mc.style.webkitFilter = ''; mc.style.pointerEvents = ''; mc.style.userSelect = ''; }
                    $('#commonModal').modal('hide');
                });

            }, 400);
        }
    });

    // Clean up on modal close
    $(document).on('hidden.bs.modal', '#commonModal', function() {
        var overlay = document.getElementById('store-limit-overlay');
        if (overlay) overlay.remove();
        var mc = this.querySelector('.modal-content');
        if (mc) { mc.style.filter = ''; mc.style.webkitFilter = ''; mc.style.pointerEvents = ''; mc.style.userSelect = ''; }
    });
</script>
@endpush
