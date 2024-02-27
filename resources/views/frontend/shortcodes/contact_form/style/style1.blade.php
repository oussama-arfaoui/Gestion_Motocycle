{{-- Style 1 File --}}

<section class="contact_form_style1 global_container">
    <div class="contact_form_style1-text">
        <h2 class="contact_form_style1-text-title">{{ $title }}</h2>
        <p class="contact_form_style1-text-description">{{ $description }}</p>

        <p class="contact_form_style1-text-maptag">Où, Trouvez Nous Directement Sur Google Maps:</p>
        <iframe class="contact_form_style1-text-map" width="100%" height="500"
            src="https://maps.google.com/maps?q=صناعة شاسيهات الطاقة الشمسية, ٢١٢ المنطقة الصناعية السادسة ٦اكتوبر, Giza Governorate, Egypt%20&amp;t=&amp;z=13&amp;ie=UTF8&amp;iwloc=&amp;output=embed"
            frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
    </div>

    <form class="contact_form_style1-form @if(session('status') == 'success') success @elseif(session('status') == 'error') error @endif" action="#">
        @csrf

        <div class="contact_form_style1-form-row">
            <input name="Nom" placeholder="Nom et Prénom" type="text"  autocomplete="name"/>
            <input name="email" placeholder="Email" type="text" autocomplete="email"/>
        </div>

        <div class="contact_form_style1-form-row">
            <input name="telephone" placeholder="Telephone" type="text" autocomplete="cc-number"/>
            <input name="organization" placeholder="Organization" type="text" autocomplete="organization"/>
        </div>

        <input name="address" placeholder="Adresse" type="text" autocomplete="address-level1" />
        <input name="sujet" placeholder="Sujet" type="text"/>
        <textarea name="message" placeholder="Message" type="text"></textarea>

        <input class="contact_form_style1-form-submit" value="Envoyez Message" type="submit" />
    </form>

    <div class="contact_form_style1-mapmobile">
        <p class="contact_form_style1-mapmobile-maptag">Où, Trouvez Nous Directement Sur Google Maps:</p>
        <iframe class="contact_form_style1-mapmobile-map" width="100%" height="500"
            src="https://maps.google.com/maps?q=صناعة شاسيهات الطاقة الشمسية, ٢١٢ المنطقة الصناعية السادسة ٦اكتوبر, Giza Governorate, Egypt%20&amp;t=&amp;z=13&amp;ie=UTF8&amp;iwloc=&amp;output=embed"
            frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
    </div>
    
</section>