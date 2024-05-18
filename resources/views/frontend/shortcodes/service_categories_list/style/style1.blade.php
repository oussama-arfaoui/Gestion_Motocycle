{{-- Style 1 File --}}

<section class="service_categories_list_style1 global_container">

    <div class="service_categories_list_style1-buttons">
        <button class="service_categories_list_style1-buttons-button active" onclick="showService(1)">{{$service_title_1}}</button>
        <button class="service_categories_list_style1-buttons-button" onclick="showService(2)">{{$service_title_2}}</button>
        <button class="service_categories_list_style1-buttons-button" onclick="showService(3)">{{$service_title_3}}</button>
        <button class="service_categories_list_style1-buttons-button" onclick="showService(4)">{{$service_title_4}}</button>
        <button class="service_categories_list_style1-buttons-button" onclick="showService(5)">{{$service_title_5}}</button>
    </div>

    <div class="service_categories_list_style1-screens">
        <div id="service_screen_1" class="service_categories_list_style1-screens-screen">
            <div class="service_categories_list_style1-screens-screen-text">
                <h2>{{$service_title_1}}</h2>
                <p>{{$services_description_1}}</p>
                
                <x-primary_button path="#" text="Dicover More"></x-primary_button>
            </div>
            <div class="service_categories_list_style1-screens-screen-graphic">
                <img src="./blanks/400x500.png" alt="">
            </div>
        </div>
        <div id="service_screen_2" class="service_categories_list_style1-screens-screen" style="display:none;">
            <div class="service_categories_list_style1-screens-screen-text">
                <h2>{{$service_title_2}}</h2>
                <p>{{$services_description_2}}</p>
                <x-primary_button path="#" text="Dicover More"></x-primary_button>
            </div>
            <div class="service_categories_list_style1-screens-screen-graphic">
                <img src="./blanks/400x500.png" alt="">
            </div>
        </div>
        <div id="service_screen_3" class="service_categories_list_style1-screens-screen" style="display:none;">
            <div class="service_categories_list_style1-screens-screen-text">
                <h2>{{$service_title_3}}</h2>
                <p>{{$services_description_3}}</p>
                
                <x-primary_button path="#" text="Dicover More"></x-primary_button>
            </div>
            <div class="service_categories_list_style1-screens-screen-graphic">
                <img src="./blanks/400x500.png" alt="">
            </div>
        </div>
        <div id="service_screen_4" class="service_categories_list_style1-screens-screen" style="display:none;">
            <div class="service_categories_list_style1-screens-screen-text">
                <h2>{{$service_title_4}}</h2>
                <p>{{$services_description_4}}</p>
                
                <x-primary_button path="#" text="Dicover More"></x-primary_button>
            </div>
            <div class="service_categories_list_style1-screens-screen-graphic">
                <img src="./blanks/400x500.png" alt="">
            </div>
        </div>
        <div id="service_screen_5" class="service_categories_list_style1-screens-screen" style="display:none;">
            <div class="service_categories_list_style1-screens-screen-text">
                <h2>{{$service_title_5}}</h2>
                <p>{{$services_description_5}}</p>
                
                <x-primary_button path="#" text="Dicover More"></x-primary_button>
            </div>
            <div class="service_categories_list_style1-screens-screen-graphic">
                <img src="./blanks/400x500.png" alt="">
            </div>
        </div>
    </div>

</section>

<script>
    function showService(serviceNumber) {

        for (let i = 1; i <= 5; i++) {                                                                                                          /// Change that 5 to match the number of services dynamically from the database.
            document.getElementById(`service_screen_${i}`).style.display = 'none';
        }
        document.getElementById(`service_screen_${serviceNumber}`).style.display = 'flex';

        const buttons = document.querySelectorAll('.service_categories_list_style1-buttons-button');
        buttons.forEach(button => button.classList.remove('active'));

        buttons[serviceNumber - 1].classList.add('active');
    }
</script>
