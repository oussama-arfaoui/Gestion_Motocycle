{{-- Style 1 File --}}

<section class="contact_form_style1 global_container">
    <div class="contact_form_style1-text">
        <h2 class="contact_form_style1-text-title">{{ $title }}</h2>
        <p class="contact_form_style1-text-description">{{ $description }}</p>

        <p class="contact_form_style1-text-maptag">Où, Trouvez Nous Directement Sur Google Maps:</p>
        <iframe class="contact_form_style1-text-map" width="100%"
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1761.4117270601957!2d-6.847385420736031!3d34.00055305418222!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xda76c8f44a367d7%3A0xc4540e5978bc2a63!2sRue%20Oued%20Sebou%2C%20Rabat!5e0!3m2!1sfr!2sma!4v1712074701925!5m2!1sfr!2sma"
            style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>

    <form
        class="contact_form_style1-form @if(session('status') == 'success') success @elseif(session('status') == 'error') error @endif"
        action="#">
        @csrf

        <div class="contact_form_style1-form-row">
            <input name="Nom" placeholder="Nom et Prénom" type="text" autocomplete="name" />
            <input name="email" placeholder="Email" type="text" autocomplete="email" />
        </div>

        <div class="contact_form_style1-form-row">
            <input name="telephone" placeholder="Telephone" type="text" autocomplete="cc-number" />
            <input name="organization" placeholder="Organization" type="text" autocomplete="organization" />
        </div>

        <input name="address" placeholder="Adresse" type="text" autocomplete="address-level1" />
        <input name="sujet" placeholder="Sujet" type="text" />
        <textarea name="message" placeholder="Message" type="text"></textarea>

        <input class="contact_form_style1-form-submit" value="Envoyez Message" type="submit" />
    </form>

    <div class="contact_form_style1-mapmobile">
        <p class="contact_form_style1-mapmobile-maptag">Où, Trouvez Nous Directement Sur Google Maps:</p>
        <iframe class="contact_form_style1-map"
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1761.4117270601957!2d-6.847385420736031!3d34.00055305418222!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xda76c8f44a367d7%3A0xc4540e5978bc2a63!2sRue%20Oued%20Sebou%2C%20Rabat!5e0!3m2!1sfr!2sma!4v1712074701925!5m2!1sfr!2sma"
            style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>

</section>