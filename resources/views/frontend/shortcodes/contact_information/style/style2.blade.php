{{-- Style 2 File --}}

<section class="contact_information_style2 global_container">

    <div class="contact_information_style2-text">
        <h2 class="contact_information_style2-text-title">{{$title}}</h2>
        <h3 class="contact_information_style2-text-subtitle">{{$subtitle}}</h3>
        <p class="contact_information_style2-text-description">{{$description}}</p>
        <div class="contact_information_style2-text-actions">
            <x-action_button action="tel: {{$contact_number_1}}" text="{{$primary_button_label}}">
                <x-call-icon />
            </x-action_button>
            <x-action_button action="https://wa.me/{{$contact_whatsapp_1}}" text="{{$secondary_button_label}}">
                <x-whatsapp-icon />
            </x-action_button>
        </div>
    </div>
    <div class="contact_information_style2-info">

        <div class="contact_information_style2-info-node">
            <div class="contact_information_style2-info-node-image">
                <img src="./icons/icon-call.png" alt="">
            </div>

            <div class="contact_information_style2-info-node-text">
                <p>{{$node_title_1}}</p>
                <h3>{{$contact_number_1}}</h3>
            </div>
        </div>

        <div class="contact_information_style2-info-node">
            <div class="contact_information_style2-info-node-image">
                <img src="./icons/icon-email.png" alt="">
            </div>

            <div class="contact_information_style2-info-node-text">
                <p>{{$node_title_2}}</p>
                <h3>{{$contact_email_1}}</h3>
            </div>
        </div>

        <div class="contact_information_style2-info-node">
            <div class="contact_information_style2-info-node-image">
                <img src="./icons/icon-location.png" alt="">
            </div>

            <div class="contact_information_style2-info-node-text">
                <p>{{$node_title_3}}</p>
                <h3>{{$physical_address}}</h3>
            </div>
        </div>

    </div>

</section>