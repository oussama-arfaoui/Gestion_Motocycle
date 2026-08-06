@push('script-page')
<script>
    var planIndexUrl = @json(route('plans.index'));
    var storeCount = @json(getSuperAdminStoreCount());
    var canCreate = @json(canCreateStore());

    // Intercept AJAX: when the store creation form is loaded, show modal if limit reached
    $(document).ajaxComplete(function(event, xhr, settings) {
        if (settings.url && settings.url.indexOf('/store-resource/create') !== -1 && !canCreate) {
            console.log('Store limit reached! Showing upgrade modal...');

            setTimeout(function() {
                var modalContent = document.querySelector('#commonModal .modal-content');
                if (!modalContent) return;

                // Apply blur to form
                modalContent.style.filter = 'blur(8px)';
                modalContent.style.pointerEvents = 'none';

                // Remove existing overlay
                var existing = document.getElementById('store-limit-overlay');
                if (existing) existing.remove();

                // Create overlay
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
                    if (mc) { mc.style.filter = ''; mc.style.pointerEvents = ''; }
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
        if (mc) { mc.style.filter = ''; mc.style.pointerEvents = ''; }
    });
</script>
@endpush
