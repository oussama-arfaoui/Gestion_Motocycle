<header class="header">

    {{-- <div class="global_container header__info">
        <div class="header__info-node">
            <p>Numero Telephone: </p>
            <h3>{{$contact_number}} </h3>
        </div>

        <div class="header__info-node">
            <p>Numero Whatsapp: </p>
            <h3>{{$contact_whatsapp}} </h3>
        </div>

        <div class="header__info-node">
            <p>Contact Email: </p>
            <h3>{{$contact_email}} </h3>
        </div>


    </div> --}}


    <div class="global_container header__content">
        <div class="header__logo">
            <img src={{@asset('/logos/primary-logo.svg')}} alt="logo-img">
        </div>

        <nav class="header__nav">

            <li>
                <a href="/accueil">Accueil</a>
            </li>

            <li>
                <a href="/spaces">Spaces</a>
            </li>

            <li>
                <a href="/a-propos">à Propos</a>
            </li>

            <li>
                <a href="/actualites">Actualités</a>
            </li>
        </nav>


        <div class="header__cta">
            <x-primary_button path='/contact' text="Contactez-Nous!"></x-primary_button>
        </div>
    </div>
</header>


{{-- Bottom Navigation --}}

<div class="BottomNav">
    <div class="BottomNav__left">
        <a href="/accueil">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                <path
                    d="M1.5 7.99999L7.46933 2.02999C7.76267 1.73732 8.23733 1.73732 8.53 2.02999L14.5 7.99999M3 6.49999V13.25C3 13.664 3.336 14 3.75 14H6.5V10.75C6.5 10.336 6.836 9.99999 7.25 9.99999H8.75C9.164 9.99999 9.5 10.336 9.5 10.75V14H12.25C12.664 14 13 13.664 13 13.25V6.49999M5.5 14H11"
                    stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            <p>Accueil</p>
        </a>
        <a href="/spaces">
            <svg width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M3 2.5H8.83333V8.33333H3V2.5Z" stroke="white" stroke-width="1.5" stroke-linecap="round"
                    stroke-linejoin="round" />
                <path d="M12.1667 2.5H18V8.33333H12.1667V2.5Z" stroke="white" stroke-width="1.5" stroke-linecap="round"
                    stroke-linejoin="round" />
                <path d="M12.1667 11.6667H18V17.5H12.1667V11.6667Z" stroke="white" stroke-width="1.5"
                    stroke-linecap="round" stroke-linejoin="round" />
                <path d="M3 11.6667H8.83333V17.5H3V11.6667Z" stroke="white" stroke-width="1.5" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
            <p>Spaces</p>
        </a>
    </div>
    <div class="BottomNav__middle">
        <button>
            <a href="tel: {{ $contact_number }}">
                <x-call-icon />
            </a>
        </button>
    </div>

    <div class="BottomNav__right">
        <a href="/contact">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M17.5 9.58333C17.5029 10.6832 17.2459 11.7682 16.75 12.75C16.162 13.9264 15.2581 14.916 14.1395 15.6077C13.021 16.2995 11.7319 16.6662 10.4167 16.6667C9.31678 16.6695 8.23176 16.4126 7.25 15.9167L2.5 17.5L4.08333 12.75C3.58744 11.7682 3.33047 10.6832 3.33333 9.58333C3.33384 8.26812 3.70051 6.97904 4.39227 5.86045C5.08402 4.74187 6.07355 3.83797 7.25 3.24999C8.23176 2.7541 9.31678 2.49713 10.4167 2.49999H10.8333C12.5703 2.59582 14.2109 3.32896 15.441 4.55904C16.671 5.78912 17.4042 7.4297 17.5 9.16666V9.58333Z"
                    stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            <p>Contact</p>
        </a>
        <a href="/actualites">
            <svg width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M12.1667 1.66666H5.50001C5.05798 1.66666 4.63406 1.84225 4.3215 2.15481C4.00894 2.46737 3.83334 2.8913 3.83334 3.33332V16.6667C3.83334 17.1087 4.00894 17.5326 4.3215 17.8452C4.63406 18.1577 5.05798 18.3333 5.50001 18.3333H15.5C15.942 18.3333 16.366 18.1577 16.6785 17.8452C16.9911 17.5326 17.1667 17.1087 17.1667 16.6667V6.66666L12.1667 1.66666Z"
                    stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M12.1667 1.66666V6.66666H17.1667" stroke="white" stroke-width="1.5" stroke-linecap="round"
                    stroke-linejoin="round" />
                <path d="M13.8333 10.8333H7.16666" stroke="white" stroke-width="1.5" stroke-linecap="round"
                    stroke-linejoin="round" />
                <path d="M13.8333 14.1667H7.16666" stroke="white" stroke-width="1.5" stroke-linecap="round"
                    stroke-linejoin="round" />
                <path d="M8.83332 7.5H7.16666" stroke="white" stroke-width="1.5" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
            <p>Actualités</p>
        </a>
    </div>
</div>