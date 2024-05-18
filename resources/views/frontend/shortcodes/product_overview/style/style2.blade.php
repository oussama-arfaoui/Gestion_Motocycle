{{-- Style 1 File --}}

<section class="product_overview_style1">

    <div class="product_overview_style1-title">
        <div class="product_overview_style1-title-tag">

            <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m16.2 19 4.8-7-4.8-7H3l4.8 7L3 19h13.2Z" />
            </svg>
            <p>{{ $section_tag }}</p>
        </div>

        <h2>{{ $title }}</h2>
    </div>

    <div class="product_overview_style1-section global_container">
        <div class="product_overview_style1-section-img">
            <img src="./bgs/enterprise-1.jpg" alt="">
        </div>
        <div class="product_overview_style1-section-text">
            <h3>{{ $subtitle }}</h3>
            <p>{{ $description }}</p>
        </div>
    </div>

    <div class="product_overview_style1-section global_container">
        <div class="product_overview_style1-section-text">
            <p>En phase de conception, nous intégrons les différents métiers nécessaires à l’étude architecturale,
                environnementale et
                technique, l’évaluation des coûts de construction et l'étude de faisabilité du projet. En phase de
                réalisation, nous
                s'en occupons de l’exécution des travaux tous corps d’état. Nous restons votre seul interlocuteur dans
                la gestion du
                chantier et ensuite la garantie de parfait achèvement. Nous nous engageons contractuellement sur le
                prix, les délais et
                la qualité de l’ouvrage. Dans un contexte économique complexe, c’est aussi une garantie pour que votre
                projet voit le
                jour en toute sérénité en externalisant tous les risques liés à un projet immobilier ou tertiaire.</p>
        </div>
        <div class="product_overview_style1-section-img">
            <img src="./bgs/enterprise-2.jpg" alt="">
        </div>
    </div>

    <div class="product_overview_style1-actions">
        <x-primary_button path='tel: {{$contact_number_1}}' text='{{ $primary_button_label }}'></x-primary_button>
    </div>

</section>