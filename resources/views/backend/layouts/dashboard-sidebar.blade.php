{{-- Sidebar for the admin Dashboard --}}


<div id="dashboard_sidebar" class="dashboard_sidebar">
    {{-- Logo Display in the Dashboard--}}
    <div class="dashboard_sidebar__logo">
        <img src={{asset('/logos/carbon-logo.svg')}} alt="logo">
        <h1>Carbon Website</h1>
    </div>

    {{-- Dashboard Search : Maybe someday when I configure the logic--}}

    {{-- <div class="dashboard_sidebar__search">
        <input type="search" placeholder="Search...">

        <svg class="with-icon_icon__MHUeb" data-testid="geist-icon" fill="none" height="24"
            shape-rendering="geometricPrecision" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
            stroke-width="1.5" viewBox="0 0 24 24" width="24"
            style="color:var(--geist-foreground);width:24px;height:24px">
            <path d="M11 17.25a6.25 6.25 0 110-12.5 6.25 6.25 0 010 12.5z" />
            <path d="M16 16l4.5 4.5" />
        </svg>
    </div> --}}

    {{-- Dashboard Links --}}

    <div class="dashboard_sidebar__links">

        <a href="{{ route('home.index') }}">
            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M2.25 6.75L9 1.5L15.75 6.75V15C15.75 15.3978 15.592 15.7794 15.3107 16.0607C15.0294 16.342 14.6478 16.5 14.25 16.5H3.75C3.35218 16.5 2.97064 16.342 2.68934 16.0607C2.40804 15.7794 2.25 15.3978 2.25 15V6.75Z"
                    stroke-opacity="0.75" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M6.75 16.5V9H11.25V16.5" stroke-opacity="0.75" stroke-width="1.5" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
            <span>Home</span>
        </a>


        <a href="{{ route('pages.index') }}">
            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M9.75 1.5H4.5C4.10218 1.5 3.72064 1.65804 3.43934 1.93934C3.15804 2.22064 3 2.60218 3 3V15C3 15.3978 3.15804 15.7794 3.43934 16.0607C3.72064 16.342 4.10218 16.5 4.5 16.5H13.5C13.8978 16.5 14.2794 16.342 14.5607 16.0607C14.842 15.7794 15 15.3978 15 15V6.75L9.75 1.5Z"
                    stroke-opacity="0.75" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M9.75 1.5V6.75H15" stroke-opacity="0.75" stroke-width="1.5" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
            <span>Pages</span>
        </a>


        <button id="dropdown-nav-products">
            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12.375 7.04997L5.625 3.15747" stroke-opacity="0.75" stroke-width="1.5" stroke-linecap="round"
                    stroke-linejoin="round" />
                <path
                    d="M15.75 11.9999V5.99993C15.7497 5.73688 15.6803 5.47853 15.5487 5.2508C15.417 5.02306 15.2278 4.83395 15 4.70243L9.75 1.70243C9.52197 1.57077 9.2633 1.50146 9 1.50146C8.7367 1.50146 8.47803 1.57077 8.25 1.70243L3 4.70243C2.7722 4.83395 2.58299 5.02306 2.45135 5.2508C2.31971 5.47853 2.25027 5.73688 2.25 5.99993V11.9999C2.25027 12.263 2.31971 12.5213 2.45135 12.7491C2.58299 12.9768 2.7722 13.1659 3 13.2974L8.25 16.2974C8.47803 16.4291 8.7367 16.4984 9 16.4984C9.2633 16.4984 9.52197 16.4291 9.75 16.2974L15 13.2974C15.2278 13.1659 15.417 12.9768 15.5487 12.7491C15.6803 12.5213 15.7497 12.263 15.75 11.9999Z"
                    stroke-opacity="0.75" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M2.45251 5.21997L9.00001 9.00747L15.5475 5.21997" stroke-opacity="0.75" stroke-width="1.5"
                    stroke-linecap="round" stroke-linejoin="round" />
                <path d="M9 16.56V9" stroke-opacity="0.75" stroke-width="1.5" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
            <span>Products</span>


            <svg id="dropdown-nav-products-arrow" width="18" height="18" viewBox="0 0 18 18" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path d="M4.5 6.75L9 11.25L13.5 6.75" stroke-opacity="0.75" stroke-width="1.5" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
        </button>

        <div class="dashboard_sidebar__links-innerlink hide" id="dropdown-menu-nav-products">
            <a href="{{ route('products.index') }}">
                <span>Product Items</span>
            </a>

            <a href="{{ route('product-categories.index') }}">
                <span>Product Categories</span>
            </a>
        </div>


        <button id="dropdown-nav-Services">
            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M13.5 6H14.25C15.0456 6 15.8087 6.31607 16.3713 6.87868C16.9339 7.44129 17.25 8.20435 17.25 9C17.25 9.79565 16.9339 10.5587 16.3713 11.1213C15.8087 11.6839 15.0456 12 14.25 12H13.5"
                    stroke-opacity="0.75" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                <path
                    d="M1.5 6H13.5V12.75C13.5 13.5456 13.1839 14.3087 12.6213 14.8713C12.0587 15.4339 11.2956 15.75 10.5 15.75H4.5C3.70435 15.75 2.94129 15.4339 2.37868 14.8713C1.81607 14.3087 1.5 13.5456 1.5 12.75V6Z"
                    stroke-opacity="0.75" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M4.5 0.75V3" stroke-opacity="0.75" stroke-width="1.5" stroke-linecap="round"
                    stroke-linejoin="round" />
                <path d="M7.5 0.75V3" stroke-opacity="0.75" stroke-width="1.5" stroke-linecap="round"
                    stroke-linejoin="round" />
                <path d="M10.5 0.75V3" stroke-opacity="0.75" stroke-width="1.5" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
            <span>Services</span>


            <svg id="dropdown-nav-Services-arrow" width="18" height="18" viewBox="0 0 18 18" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path d="M4.5 6.75L9 11.25L13.5 6.75" stroke-opacity="0.75" stroke-width="1.5" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
        </button>

        <div class="dashboard_sidebar__links-innerlink hide" id="dropdown-menu-nav-Services">
            <a href="{{ route('services.index') }}">
                <span>Services Items</span>
            </a>

            <a href="{{ route('service-categories.index') }}">
                <span>Services Categories</span>
            </a>
        </div>



        <a href="{{ route('testimonials.index') }}">
            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">;
                <path stroke-opacity="0.75"
                    d="M14.25 8.66668C14.2523 9.54659 14.0467 10.4146 13.65 11.2C13.1796 12.1412 12.4565 12.9328 11.5616 13.4862C10.6668 14.0396 9.63548 14.3329 8.58332 14.3333C7.70341 14.3356 6.8354 14.13 6.04999 13.7333L2.25 15L3.51666 11.2C3.11995 10.4146 2.91437 9.54659 2.91667 8.66668C2.91707 7.61452 3.21041 6.58325 3.76381 5.68838C4.31721 4.79352 5.10883 4.0704 6.04999 3.60002C6.8354 3.20331 7.70341 2.99772 8.58332 3.00002H8.91666C10.3062 3.07668 11.6187 3.66319 12.6027 4.64726C13.5868 5.63132 14.1733 6.94378 14.25 8.33334V8.66668Z"
                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                <g clip-path="url(#clip0_123_733)">
                    <path stroke-opacity="0.75"
                        d="M13.125 0.8125L14.3803 3.35562L17.1875 3.76594L15.1562 5.74437L15.6356 8.53937L13.125 7.21906L10.6144 8.53937L11.0938 5.74437L9.0625 3.76594L11.8697 3.35562L13.125 0.8125Z"
                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                </g>
                <defs>
                    <clipPath id="clip0_123_733">
                        <rect width="9.75" height="9.75" fill="none" transform="translate(8.25)" />
                    </clipPath>
                </defs>
            </svg>
            <span>Testimonial</span>
        </a>



        <button id="dropdown-nav-projects">
            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M2.25 2.25H7.5V7.5H2.25V2.25Z" stroke-opacity="0.75" stroke-width="1.5" stroke-linecap="round"
                    stroke-linejoin="round" />
                <path d="M10.5 2.25H15.75V7.5H10.5V2.25Z" stroke-opacity="0.75" stroke-width="1.5"
                    stroke-linecap="round" stroke-linejoin="round" />
                <path d="M10.5 10.5H15.75V15.75H10.5V10.5Z" stroke-opacity="0.75" stroke-width="1.5"
                    stroke-linecap="round" stroke-linejoin="round" />
                <path d="M2.25 10.5H7.5V15.75H2.25V10.5Z" stroke-opacity="0.75" stroke-width="1.5"
                    stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            <span>projects</span>


            <svg id="dropdown-nav-projects-arrow" width="18" height="18" viewBox="0 0 18 18" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path d="M4.5 6.75L9 11.25L13.5 6.75" stroke-opacity="0.75" stroke-width="1.5" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
        </button>

        <div class="dashboard_sidebar__links-innerlink hide" id="dropdown-menu-nav-projects">
            <a href="{{ route('projects.index') }}">
                <span>Projects Items</span>
            </a>

            <a href="{{ route('projects-categories.index') }}">
                <span>Projects Categories</span>
            </a>
        </div>
        
        <a href="/admin/contact">
            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M3 3H15C15.825 3 16.5 3.675 16.5 4.5V13.5C16.5 14.325 15.825 15 15 15H3C2.175 15 1.5 14.325 1.5 13.5V4.5C1.5 3.675 2.175 3 3 3Z"
                    stroke-opacity="0.75" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M16.5 4.5L9 9.75L1.5 4.5" stroke-opacity="0.75" stroke-width="1.5" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
            <span>Contact</span>
        </a>



        <button id="dropdown-nav-ecommerce">
            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g clip-path="url(#clip0_62_639)">
                    <path
                        d="M6.75 16.5C7.16421 16.5 7.5 16.1642 7.5 15.75C7.5 15.3358 7.16421 15 6.75 15C6.33579 15 6 15.3358 6 15.75C6 16.1642 6.33579 16.5 6.75 16.5Z"
                        stroke-opacity="0.75" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    <path
                        d="M15 16.5C15.4142 16.5 15.75 16.1642 15.75 15.75C15.75 15.3358 15.4142 15 15 15C14.5858 15 14.25 15.3358 14.25 15.75C14.25 16.1642 14.5858 16.5 15 16.5Z"
                        stroke-opacity="0.75" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    <path
                        d="M0.75 0.75H3.75L5.76 10.7925C5.82858 11.1378 6.01643 11.448 6.29066 11.6687C6.56489 11.8895 6.90802 12.0067 7.26 12H14.55C14.902 12.0067 15.2451 11.8895 15.5193 11.6687C15.7936 11.448 15.9814 11.1378 16.05 10.7925L17.25 4.5H4.5"
                        stroke-opacity="0.75" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                </g>
                <defs>
                    <clipPath id="clip0_62_639">
                        <rect width="18" height="18" fill="white" />
                    </clipPath>
                </defs>
            </svg>
            <span>E-commerce</span>

            <svg id="dropdown-nav-ecommerce-arrow" width="18" height="18" viewBox="0 0 18 18" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path d="M4.5 6.75L9 11.25L13.5 6.75" stroke-opacity="0.75" stroke-width="1.5" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
        </button>

        <div class="dashboard_sidebar__links-innerlink hide" id="dropdown-menu-nav-ecommerce">
            <a href="{{ route('brands.index') }}">
                <span>Brands & Sponsors</span>
            </a>
            <a href="/admin/ecommerce/discounts">
                <span>Discounts</span>
            </a>
            <a href="/admin/ecommerce/invoices">
                <span>Invoices</span>
            </a>
        </div>

        <a href="/admin/blogs">
            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M5.30162 16.1999H12.1642C14.098 16.1999 15.6659 14.6319 15.6659 12.6983V4.40153C15.6659 2.46795 14.098 0.899902 12.1642 0.899902H5.30162C3.36804 0.899902 1.79999 2.46795 1.79999 4.40153V12.6983C1.79999 14.6319 3.36804 16.1999 5.30162 16.1999Z"
                    stroke-opacity="0.75" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M11.5459 11.8814H5.91882M11.5459 8.4337H5.91882M8.06624 4.9939H5.91923" stroke-opacity="0.75"
                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            <span>Blogs</span>
        </a>


        <a href="/admin/activity">
            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M16.5 9H13.5L11.25 15.75L6.75 2.25L4.5 9H1.5" stroke-opacity="0.75" stroke-width="1.5"
                    stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            <span>Activity</span>
        </a>

        <a href="{{ route('media.index') }}">
            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">;
                <path stroke-opacity="0.75"
                    d="M14.25 2.25H3.75C2.92157 2.25 2.25 2.92157 2.25 3.75V14.25C2.25 15.0784 2.92157 15.75 3.75 15.75H14.25C15.0784 15.75 15.75 15.0784 15.75 14.25V3.75C15.75 2.92157 15.0784 2.25 14.25 2.25Z"
                      stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                <path stroke-opacity="0.75"
                    d="M6.375 7.5C6.99632 7.5 7.5 6.99632 7.5 6.375C7.5 5.75368 6.99632 5.25 6.375 5.25C5.75368 5.25 5.25 5.75368 5.25 6.375C5.25 6.99632 5.75368 7.5 6.375 7.5Z"
                      stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                <path stroke-opacity="0.75" d="M15.75 11.25L12 7.5L3.75 15.75"   stroke-width="1.5"
                    stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            <span>Media</span>
        </a>

        {{-- Dashboard Links that lead to accessibility: Settings, documentation... --}}

  

     
        </a>
        <button id="dropdown-nav-Settings">
            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g clip-path="url(#clip0_53_1199)">
                    <path
                        d="M9 11.25C10.2426 11.25 11.25 10.2426 11.25 9C11.25 7.75736 10.2426 6.75 9 6.75C7.75736 6.75 6.75 7.75736 6.75 9C6.75 10.2426 7.75736 11.25 9 11.25Z"
                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" stroke-opacity="0.75" />
                    <path
                        d="M14.55 11.25C14.4502 11.4762 14.4204 11.7271 14.4645 11.9704C14.5086 12.2137 14.6246 12.4382 14.7975 12.615L14.8425 12.66C14.982 12.7993 15.0926 12.9647 15.1681 13.1468C15.2436 13.3289 15.2824 13.5241 15.2824 13.7213C15.2824 13.9184 15.2436 14.1136 15.1681 14.2957C15.0926 14.4778 14.982 14.6432 14.8425 14.7825C14.7032 14.922 14.5378 15.0326 14.3557 15.1081C14.1736 15.1836 13.9784 15.2224 13.7812 15.2224C13.5841 15.2224 13.3889 15.1836 13.2068 15.1081C13.0247 15.0326 12.8593 14.922 12.72 14.7825L12.675 14.7375C12.4982 14.5646 12.2737 14.4486 12.0304 14.4045C11.7871 14.3604 11.5362 14.3902 11.31 14.49C11.0882 14.5851 10.899 14.7429 10.7657 14.9442C10.6325 15.1454 10.561 15.3812 10.56 15.6225V15.75C10.56 16.1478 10.402 16.5294 10.1207 16.8107C9.83936 17.092 9.45782 17.25 9.06 17.25C8.66218 17.25 8.28064 17.092 7.99934 16.8107C7.71804 16.5294 7.56 16.1478 7.56 15.75V15.6825C7.55419 15.4343 7.47384 15.1935 7.32938 14.9915C7.18493 14.7896 6.98305 14.6357 6.75 14.55C6.52379 14.4502 6.27286 14.4204 6.02956 14.4645C5.78626 14.5086 5.56176 14.6246 5.385 14.7975L5.34 14.8425C5.20069 14.982 5.03526 15.0926 4.85316 15.1681C4.67106 15.2436 4.47587 15.2824 4.27875 15.2824C4.08163 15.2824 3.88644 15.2436 3.70434 15.1681C3.52224 15.0926 3.35681 14.982 3.2175 14.8425C3.07804 14.7032 2.9674 14.5378 2.89191 14.3557C2.81642 14.1736 2.77757 13.9784 2.77757 13.7812C2.77757 13.5841 2.81642 13.3889 2.89191 13.2068C2.9674 13.0247 3.07804 12.8593 3.2175 12.72L3.2625 12.675C3.4354 12.4982 3.55139 12.2737 3.5955 12.0304C3.63962 11.7871 3.60984 11.5362 3.51 11.31C3.41493 11.0882 3.25707 10.899 3.05585 10.7657C2.85463 10.6325 2.61884 10.561 2.3775 10.56H2.25C1.85218 10.56 1.47064 10.402 1.18934 10.1207C0.908035 9.83936 0.75 9.45782 0.75 9.06C0.75 8.66218 0.908035 8.28064 1.18934 7.99934C1.47064 7.71804 1.85218 7.56 2.25 7.56H2.3175C2.56575 7.55419 2.8065 7.47384 3.00847 7.32938C3.21045 7.18493 3.36429 6.98305 3.45 6.75C3.54984 6.52379 3.57962 6.27286 3.5355 6.02956C3.49139 5.78626 3.3754 5.56176 3.2025 5.385L3.1575 5.34C3.01804 5.20069 2.9074 5.03526 2.83191 4.85316C2.75642 4.67106 2.71757 4.47587 2.71757 4.27875C2.71757 4.08163 2.75642 3.88644 2.83191 3.70434C2.9074 3.52224 3.01804 3.35681 3.1575 3.2175C3.29681 3.07804 3.46224 2.9674 3.64434 2.89191C3.82644 2.81642 4.02163 2.77757 4.21875 2.77757C4.41587 2.77757 4.61106 2.81642 4.79316 2.89191C4.97526 2.9674 5.14069 3.07804 5.28 3.2175L5.325 3.2625C5.50176 3.4354 5.72626 3.55139 5.96956 3.5955C6.21285 3.63962 6.46379 3.60984 6.69 3.51H6.75C6.97183 3.41493 7.16101 3.25707 7.29427 3.05585C7.42753 2.85463 7.49904 2.61884 7.5 2.3775V2.25C7.5 1.85218 7.65804 1.47064 7.93934 1.18934C8.22064 0.908035 8.60218 0.75 9 0.75C9.39782 0.75 9.77936 0.908035 10.0607 1.18934C10.342 1.47064 10.5 1.85218 10.5 2.25V2.3175C10.501 2.55884 10.5725 2.79463 10.7057 2.99585C10.839 3.19707 11.0282 3.35493 11.25 3.45C11.4762 3.54984 11.7271 3.57962 11.9704 3.5355C12.2137 3.49139 12.4382 3.3754 12.615 3.2025L12.66 3.1575C12.7993 3.01804 12.9647 2.9074 13.1468 2.83191C13.3289 2.75642 13.5241 2.71757 13.7213 2.71757C13.9184 2.71757 14.1136 2.75642 14.2957 2.83191C14.4778 2.9074 14.6432 3.01804 14.7825 3.1575C14.922 3.29681 15.0326 3.46224 15.1081 3.64434C15.1836 3.82644 15.2224 4.02163 15.2224 4.21875C15.2224 4.41587 15.1836 4.61106 15.1081 4.79316C15.0326 4.97526 14.922 5.14069 14.7825 5.28L14.7375 5.325C14.5646 5.50176 14.4486 5.72626 14.4045 5.96956C14.3604 6.21285 14.3902 6.46379 14.49 6.69V6.75C14.5851 6.97183 14.7429 7.16101 14.9442 7.29427C15.1454 7.42753 15.3812 7.49904 15.6225 7.5H15.75C16.1478 7.5 16.5294 7.65804 16.8107 7.93934C17.092 8.22064 17.25 8.60218 17.25 9C17.25 9.39782 17.092 9.77936 16.8107 10.0607C16.5294 10.342 16.1478 10.5 15.75 10.5H15.6825C15.4412 10.501 15.2054 10.5725 15.0042 10.7057C14.8029 10.839 14.6451 11.0282 14.55 11.25Z"
                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" stroke-opacity="0.75" />
                </g>
                <defs>
                    <clipPath id="clip0_53_1199">
                        <rect width="18" height="18" fill="white" />
                    </clipPath>
                </defs>
            </svg>
            <span>Settings</span>


            <svg id="dropdown-nav-Settings-arrow" width="18" height="18" viewBox="0 0 18 18" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path d="M4.5 6.75L9 11.25L13.5 6.75" stroke-opacity="0.75" stroke-width="1.5" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
        </button>

        <div class="dashboard_sidebar__links-innerlink hide" id="dropdown-menu-nav-Settings">
            <a href="{{ route('projects.index') }}">
                <span>General settings</span>
            </a>

            <a href="{{ route('projects.index') }}">
                <span>Navbar</span>
            </a>

            <a href="{{ route('pagesstyle.index') }}">
                <span>Pages style</span>
            </a>
        </div>

        <a href="/admin/documnentation">
            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g clip-path="url(#clip0_58_1243)">
                    <path
                        d="M9 16.5C13.1421 16.5 16.5 13.1421 16.5 9C16.5 4.85786 13.1421 1.5 9 1.5C4.85786 1.5 1.5 4.85786 1.5 9C1.5 13.1421 4.85786 16.5 9 16.5Z"
                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" stroke-opacity="0.75" />
                    <path
                        d="M6.8175 6.74994C6.99383 6.24869 7.34187 5.82602 7.79997 5.55679C8.25807 5.28756 8.79668 5.18914 9.32039 5.27897C9.8441 5.3688 10.3191 5.64108 10.6613 6.04758C11.0035 6.45409 11.1908 6.96858 11.19 7.49994C11.19 8.99994 8.94 9.74994 8.94 9.74994"
                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" stroke-opacity="0.75" />
                    <path d="M9 12.75H9.0075" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                        stroke-opacity="0.75" />
                </g>
                <defs>
                    <clipPath id="clip0_58_1243">
                        <rect width="18" height="18" fill="white" />
                    </clipPath>
                </defs>
            </svg>
            <span>Documentation</span>
        </a>

        <button id="dropdown-nav-generator">
            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 13.5L16.5 9L12 4.5"   stroke-width="1.5" stroke-linecap="round"
                    stroke-linejoin="round" />
                <path d="M6 4.5L1.5 9L6 13.5"   stroke-width="1.5" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
            <span>Generator</span>

            <svg id="dropdown-nav-generator-arrow" width="18" height="18" viewBox="0 0 18 18" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path d="M4.5 6.75L9 11.25L13.5 6.75" stroke-opacity="0.75" stroke-width="1.5" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
        </button>

        <div class="dashboard_sidebar__links-innerlink hide" id="dropdown-menu-nav-generator">
            <a href="{{ route('shortcode_generator') }}">
                <span>Shortcode Generator</span>
            </a>
        </div>
    </div>
</div>

<button id="dashboard_menu_toggle" class="dashboard_sidebar__button">
    <x-menu-icon />
</button>

<script>
    const dashboard_menu_toggle = document.getElementById("dashboard_menu_toggle");
    const dashboard_sidebar = document.getElementById("dashboard_sidebar");

    dashboard_menu_toggle.addEventListener("click", () => {
        dashboard_sidebar.classList.toggle('show-block')
    })
</script>