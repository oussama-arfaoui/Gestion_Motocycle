{{-- Style 1 File --}}

<section class="meet_the_team_style1 global_container">

    <div class="meet_the_team_style1-content">
        <div class="meet_the_team_style1-content-text">
            <div class="meet_the_team_style1-content-text-tag">
                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m16.2 19 4.8-7-4.8-7H3l4.8 7L3 19h13.2Z" />
                </svg>
                <p>{{$section_tag}}</p>
            </div>

            <h2 class="meet_the_team_style1-content-text-title">{{ $title }}</h2>
            <p class="meet_the_team_style1-content-text-description">{{ $description }}</p>
        </div>

        <div class="meet_the_team_style1-content-team">
            <div class="meet_the_team_style1-content-team-member">
                <img src="./blanks/400x400.png" alt="">
                <h3>{{$member_1}}</h3>
                <p>{{$job_title_1}}</p>
            </div>



            <div class="meet_the_team_style1-content-team-member">
                <img src="./blanks/400x400.png" alt="">
                <h3>{{$member_2}}</h3>
                <p>{{$job_title_2}}</p>
            </div>



            <div class="meet_the_team_style1-content-team-member">
                <img src="./blanks/400x400.png" alt="">
                <h3>{{$member_3}}</h3>
                <p>{{$job_title_3}}</p>
            </div>
        </div>
    </div>


</section>