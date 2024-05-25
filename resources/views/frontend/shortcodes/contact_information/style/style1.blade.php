{{-- Style 1 File --}}

<section id="contact-section" class="contact_information_style1 global_container">

    <div class="contact_information_style1-text">
        <h2 class="contact_information_style1-text-title">{{$title}}</h2>
        <p class="contact_information_style1-text-description">{{$description}}</p>
        <x-action_button action="tel: {{$contact_number_1}}" text="{{$primary_button_label}}"><x-call-icon/></x-action_button>
        <x-action_button action="https://wa.me/{{$contact_whatsapp_1}}" text="{{$secondary_button_label}}"><x-whatsapp-icon /></x-action_button>
    </div>
    <div class="contact_information_style1-info">
        
        <div class="contact_information_style1-info-node">
            <div class="contact_information_style1-info-node-image">
                <img src="./icons/icon-call.png" alt="">
            </div>
        
            <div class="contact_information_style1-info-node-text">
                <p>{{$node_title_1}}</p>
                <h3>{{$contact_number_1}}</h3>
            </div>
        </div>

        <div class="contact_information_style1-info-node">
            <div class="contact_information_style1-info-node-image">
                <img src="./icons/icon-whatsapp.png" alt="">
            </div>

            <div class="contact_information_style1-info-node-text">
                <p>{{$node_title_2}}</p>
                <h3>{{$contact_whatsapp_1}}</h3>
            </div>
        </div>

        <div class="contact_information_style1-info-node">
            <div class="contact_information_style1-info-node-image">
                <img src="./icons/icon-location.png" alt="">
            </div>

            <div class="contact_information_style1-info-node-text">
                <p>{{$node_title_3}}</p>
                <h3>{{$physical_address}}</h3>
            </div>
        </div>

    </div>

</section>

