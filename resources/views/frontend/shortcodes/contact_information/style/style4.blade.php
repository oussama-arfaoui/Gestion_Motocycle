{{-- Style 4 File --}}

<section class="contact_information_style4">

    <div class="contact_information_style4-text global_container">
        <h2 class="contact_information_style4-text-title">{{$title}}</h2>
        <h3 class="contact_information_style4-text-subtitle">{{$subtitle}}</h3>
        <p class="contact_information_style4-text-description">{{$description}}</p>
        {{-- <div class="contact_information_style4-text-actions">
            <x-action_button action="tel: {{$contact_number_1}}" text="{{$primary_button_label}}">
                <x-call-icon />
            </x-action_button>
            <x-action_button action="https://wa.me/{{$contact_whatsapp_1}}" text="{{$secondary_button_label}}">
                <x-whatsapp-icon />
            </x-action_button>
        </div> --}}
        <p class="contact_information_style4-text-address">{{$physical_address}}</p>

        <p class="contact_information_style4-text-extra">{{$extra_info_1}}</p>
        <p class="contact_information_style4-text-extra">{{$extra_info_2}}</p>
        <p class="contact_information_style4-text-extra">{{$extra_info_3}}</p>
        <p class="contact_information_style4-text-extra">{{$extra_info_4}}</p>
    </div>
    
    <div class="contact_information_style4-info">
        
        <div class="contact_information_style4-info-node">
            <div class="contact_information_style4-info-node-text">
                <p>{{$node_title_1}}</p>
                <h3>{{$contact_number_1}}</h3>
            </div>
            <x-action_button action="tel:{{$contact_number_1}}" text="{{$primary_button_label}}">
                <x-callicon />
            </x-action_button>
        </div>


        <div class="contact_information_style4-info-node">
            <div class="contact_information_style4-info-node-text">
                <p>{{$node_title_2}}</p>
                <h3>{{$contact_whatsapp_1}}</h3>
            </div>
            <x-action_button action="https://wa.me/{{$contact_whatsapp_1}}" text="{{$secondary_button_label}}">
                <x-whatsapp-icon />
            </x-action_button>
        </div>
        
    </div>

</section>