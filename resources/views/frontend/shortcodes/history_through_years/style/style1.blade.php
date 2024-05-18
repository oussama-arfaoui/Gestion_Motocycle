{{-- Style 1 File --}}


<section class="history_through_years_style1 global_container">
    <div class="history_through_years_style1-buttons">
        <button class="history_through_years_style1-buttons-button active" onclick="showYear(1)">{{ $year_1 }}</button>
        <button class="history_through_years_style1-buttons-button" onclick="showYear(2)">{{ $year_2 }}</button>
        <button class="history_through_years_style1-buttons-button" onclick="showYear(3)">{{ $year_3 }}</button>
        <button class="history_through_years_style1-buttons-button" onclick="showYear(4)">{{ $year_4 }}</button>
        <button class="history_through_years_style1-buttons-button" onclick="showYear(5)">{{ $year_5 }}</button>
        <button class="history_through_years_style1-buttons-button" onclick="showYear(6)">{{ $year_6 }}</button>
        <button class="history_through_years_style1-buttons-button" onclick="showYear(7)">{{ $year_7 }}</button>
        <button class="history_through_years_style1-buttons-button" onclick="showYear(8)">{{ $year_8 }}</button>
        <button class="history_through_years_style1-buttons-button" onclick="showYear(9)">{{ $year_9 }}</button>
        <button class="history_through_years_style1-buttons-button" onclick="showYear(10)">{{ $year_10 }}</button>
    </div>
    
    <div class="history_through_years_style1-screens">
        <div id="year_screen_1" class="history_through_years_style1-screens-screen" style="background-image: url('/blanks/1000x1000.png');">
            <div class="history_through_years_style1-screens-screen-animated-line"></div>
            <h2>{{ $year_event_title_1 }}</h2>
            <p>{{ $year_event_description_1 }}</p>
            <div class="history_through_years_style1-screens-screen-animated-line"></div>
        </div>
        <div id="year_screen_2" class="history_through_years_style1-screens-screen" style="display:none; background-image: url('/blanks/1000x1000.png');">
            <div class="history_through_years_style1-screens-screen-animated-line"></div>
            <h2>{{ $year_event_title_2 }}</h2>
            <p>{{ $year_event_description_2 }}</p>
            <div class="history_through_years_style1-screens-screen-animated-line"></div>
            
        </div>
        <div id="year_screen_3" class="history_through_years_style1-screens-screen" style="display:none; background-image: url('/blanks/1000x1000.png');">
            <div class="history_through_years_style1-screens-screen-animated-line"></div>
            <h2>{{ $year_event_title_3 }}</h2>
            <p>{{ $year_event_description_3 }}</p>
            <div class="history_through_years_style1-screens-screen-animated-line"></div>
        </div>
        <div id="year_screen_4" class="history_through_years_style1-screens-screen" style="display:none; background-image: url('/blanks/1000x1000.png');">
            <div class="history_through_years_style1-screens-screen-animated-line"></div>
            <h2>{{ $year_event_title_4 }}</h2>
            <p>{{ $year_event_description_4 }}</p>
            <div class="history_through_years_style1-screens-screen-animated-line"></div>
        </div>
        <div id="year_screen_5" class="history_through_years_style1-screens-screen" style="display:none; background-image: url('/blanks/1000x1000.png');">
            <div class="history_through_years_style1-screens-screen-animated-line"></div>
            <h2>{{ $year_event_title_5 }}</h2>
            <p>{{ $year_event_description_5 }}</p>
            <div class="history_through_years_style1-screens-screen-animated-line"></div>
        </div>
        <div id="year_screen_6" class="history_through_years_style1-screens-screen" style="display:none; background-image: url('/blanks/1000x1000.png');">
            <div class="history_through_years_style1-screens-screen-animated-line"></div>
            <h2>{{ $year_event_title_6 }}</h2>
            <p>{{ $year_event_description_6 }}</p>
            <div class="history_through_years_style1-screens-screen-animated-line"></div>
        </div>
        <div id="year_screen_7" class="history_through_years_style1-screens-screen" style="display:none; background-image: url('/blanks/1000x1000.png');">
            <div class="history_through_years_style1-screens-screen-animated-line"></div>
            <h2>{{ $year_event_title_7 }}</h2>
            <p>{{ $year_event_description_7 }}</p>
            <div class="history_through_years_style1-screens-screen-animated-line"></div>
        </div>
        <div id="year_screen_8" class="history_through_years_style1-screens-screen" style="display:none; background-image: url('/blanks/1000x1000.png');">
            <div class="history_through_years_style1-screens-screen-animated-line"></div>
            <h2>{{ $year_event_title_8 }}</h2>
            <p>{{ $year_event_description_8 }}</p>
            <div class="history_through_years_style1-screens-screen-animated-line"></div>
        </div>
        <div id="year_screen_9" class="history_through_years_style1-screens-screen" style="display:none; background-image: url('/blanks/1000x1000.png');">
            <div class="history_through_years_style1-screens-screen-animated-line"></div>
            <h2>{{ $year_event_title_9 }}</h2>
            <p>{{ $year_event_description_9 }}</p>
            <div class="history_through_years_style1-screens-screen-animated-line"></div>
        </div>
        <div id="year_screen_10" class="history_through_years_style1-screens-screen" style="display:none; background-image: url('/blanks/1000x1000.png');">
            <div class="history_through_years_style1-screens-screen-animated-line"></div>
            <h2>{{ $year_event_title_10 }}</h2>
            <p>{{ $year_event_description_10 }}</p>
            <div class="history_through_years_style1-screens-screen-animated-line"></div>
        </div>
    </div>
</section>

<script>
    
        let currentYear = 1;
        const totalYears = 10;                                          // Change this to match the number of the years

    function showYear(yearNumber) {

        for (let i = 1; i <= totalYears; i++) {
            document.getElementById(`year_screen_${i}`).style.display = 'none';
        }

        document.getElementById(`year_screen_${yearNumber}`).style.display = 'flex';

        const buttons = document.querySelectorAll('.history_through_years_style1-buttons-button');
        buttons.forEach(button => button.classList.remove('active'));

        buttons[yearNumber - 1].classList.add('active');
    }

    function autoAdvanceYear() {
        showYear(currentYear);
        currentYear++;
        if (currentYear > totalYears) {
            currentYear = 1;
        }
    }

    // setInterval(autoAdvanceYear, 5000);

    showYear(currentYear);


    // Tilt effect
    document.body.addEventListener('mousemove', (e) => {
        const xPercent = (e.clientX / window.innerWidth - 0.5) * 2; // range [-1, 1]
        const yPercent = (e.clientY / window.innerHeight - 0.5) * 2; // range [-1, 1]
        const maxTilt = 20; // max tilt in degrees

    document.querySelectorAll('.history_through_years_style1-screens-screen').forEach(screen => {
        screen.style.transform = `rotateX(${yPercent * maxTilt}deg) rotateY(${xPercent * maxTilt}deg)`;
    });
});

document.body.addEventListener('mouseleave', () => {
    document.querySelectorAll('.history_through_years_style1-screens-screen').forEach(screen => {
        screen.style.transform = 'rotateX(0deg) rotateY(0deg)';
    });
});

</script>



{{-- 
    <p>{{ $section_tag }}</p>
    
    <p>{{ $title }}</p>
    
    <p>{{ $subtitle }}</p>
    
    <p>{{ $description }}</p>
    
    <p>{{ $primary_button_label }}</p>
    
    <p>{{ $primary_button_link }}</p>
    
    <p>{{ $secondary_button_label }}</p>
    
    <p>{{ $secondary_button_link }}</p>
    
    <p>{{ $keyword }}</p>
    
    <p>{{ $year_1 }}</p>
    
    <p>{{ $year_event_title_1 }}</p>
    
    <p>{{ $year_event_description_1 }}</p>
    
    <p>{{ $year_2 }}</p>
    
    <p>{{ $year_event_title_2 }}</p>
    
    <p>{{ $year_event_description_2 }}</p>
    
    <p>{{ $year_3 }}</p>
    
    <p>{{ $year_event_title_3 }}</p>
    
    <p>{{ $year_event_description_3 }}</p>
    
    <p>{{ $year_4 }}</p>
    
    <p>{{ $year_event_title_4 }}</p>
    
    <p>{{ $year_event_description_4 }}</p>
    
    <p>{{ $year_5 }}</p>
    
    <p>{{ $year_event_title_5 }}</p>
    
    <p>{{ $year_event_description_5 }}</p>
    
    <p>{{ $year_6 }}</p>
    
    <p>{{ $year_event_title_6 }}</p>
    
    <p>{{ $year_event_description_6 }}</p>
    
    <p>{{ $year_7 }}</p>
    
    <p>{{ $year_event_title_7 }}</p>
    
    <p>{{ $year_event_description_7 }}</p>
    
    <p>{{ $year_8 }}</p>
    
    <p>{{ $year_event_title_8 }}</p>
    
    <p>{{ $year_event_description_8 }}</p>
    
    <p>{{ $year_9 }}</p>
    
    <p>{{ $year_event_title_9 }}</p>
    
    <p>{{ $year_event_description_9 }}</p>
    
    <p>{{ $year_10 }}</p>
    
    <p>{{ $year_event_title_10 }}</p>
    
    <p>{{ $year_event_description_10 }}</p>
    
    --}}