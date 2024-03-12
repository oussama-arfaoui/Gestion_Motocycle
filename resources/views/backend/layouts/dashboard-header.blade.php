@php
    // Get the currently authenticated user
    $user = auth()->user();
@endphp

<div class="dashboard_header">
  <div class="dashboard_header-buttons">

    {{-- Live Site Button --}}
    <button class="dashboard-icon-button">
      <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
        <g clip-path="url(#clip0_62_1250)">
          <path
            d="M9.99996 18.3334C14.6023 18.3334 18.3333 14.6025 18.3333 10.0001C18.3333 5.39771 14.6023 1.66675 9.99996 1.66675C5.39759 1.66675 1.66663 5.39771 1.66663 10.0001C1.66663 14.6025 5.39759 18.3334 9.99996 18.3334Z"
            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
          <path d="M1.66663 10H18.3333" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
          <path
            d="M9.99996 1.66675C12.0844 3.94871 13.2689 6.91011 13.3333 10.0001C13.2689 13.0901 12.0844 16.0515 9.99996 18.3334C7.91556 16.0515 6.731 13.0901 6.66663 10.0001C6.731 6.91011 7.91556 3.94871 9.99996 1.66675Z"
            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
        </g>
        <defs>
          <clipPath id="clip0_62_1250">
            <rect width="20" height="20" fill="white" />
          </clipPath>
        </defs>
      </svg></button>

    {{-- Theme Button --}}
    <button class="dashboard-icon-button">
      <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path
          d="M15.75 9.5925C15.6321 10.8692 15.1529 12.0858 14.3687 13.1001C13.5845 14.1144 12.5277 14.8843 11.3218 15.3199C10.116 15.7555 8.81104 15.8386 7.55967 15.5596C6.30831 15.2805 5.16229 14.6509 4.25572 13.7443C3.34914 12.8378 2.7195 11.6917 2.44048 10.4404C2.16145 9.18901 2.24459 7.88406 2.68014 6.67822C3.1157 5.47238 3.88567 4.41552 4.89996 3.63131C5.91424 2.8471 7.1309 2.36798 8.40755 2.25C7.66011 3.2612 7.30043 4.50709 7.39395 5.76106C7.48746 7.01503 8.02794 8.19379 8.9171 9.08295C9.80625 9.9721 10.985 10.5126 12.239 10.6061C13.493 10.6996 14.7388 10.3399 15.75 9.5925Z"
          stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
      </svg>
    </button>

    {{-- Notifications --}}
    <button class="dashboard-icon-button">
      <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path
          d="M13.5 6C13.5 4.80653 13.0259 3.66193 12.182 2.81802C11.3381 1.97411 10.1935 1.5 9 1.5C7.80653 1.5 6.66193 1.97411 5.81802 2.81802C4.97411 3.66193 4.5 4.80653 4.5 6C4.5 11.25 2.25 12.75 2.25 12.75H15.75C15.75 12.75 13.5 11.25 13.5 6Z"
          stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
        <path
          d="M10.2975 15.75C10.1657 15.9773 9.9764 16.166 9.74868 16.2971C9.52097 16.4283 9.2628 16.4973 9.00001 16.4973C8.73723 16.4973 8.47906 16.4283 8.25134 16.2971C8.02363 16.166 7.83437 15.9773 7.70251 15.75"
          stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
      </svg>
    </button>
  </div>

  {{-- USER --}}
  <button id="dropdown-username" class="dashboard-icon-dropdown">
    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path
        d="M16.6667 17.5V15.8333C16.6667 14.9493 16.3155 14.1014 15.6904 13.4763C15.0653 12.8512 14.2174 12.5 13.3334 12.5H6.66671C5.78265 12.5 4.93481 12.8512 4.30968 13.4763C3.68456 14.1014 3.33337 14.9493 3.33337 15.8333V17.5"
        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
      <path
        d="M9.99996 9.16667C11.8409 9.16667 13.3333 7.67428 13.3333 5.83333C13.3333 3.99238 11.8409 2.5 9.99996 2.5C8.15901 2.5 6.66663 3.99238 6.66663 5.83333C6.66663 7.67428 8.15901 9.16667 9.99996 9.16667Z"
        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
    </svg>

    <span>{{ $user->name }}</span>

    <svg id="dropdown-username-arrow" width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M3.5 5.25L7 8.75L10.5 5.25" stroke-width="1.5" stroke-linecap="round"
        stroke-linejoin="round" />
    </svg>
  </button>
  <div id="dropdown-menu-username" class="dashboard-dropdown-menu hide">
    <ul>
      <li>Settings</li>
      <li>Preferences</li>
      <li>Log Out</li>
    </ul>
  </div>
</div>