{{-- <button class="cta">
    <a href="{{$path}}">
        <span class="text">{{$text}}</span>
        <svg width="15px" height="10px" viewBox="0 0 13 10">
            <path d="M1,5 L11,5"></path>
            <polyline points="8 1 12 5 8 9"></polyline>
        </svg>
    </a>
</button> --}}

<button class="action_button">
    <a href="{{$path}}">
        <div class="svg-wrapper-1">
            <div class="svg-wrapper">
            {{ $slot }}
            </div>
        </div>
        <span>{{$text}}</span>
    </a>
</button>