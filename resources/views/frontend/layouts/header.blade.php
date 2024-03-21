<header id="header" class="header">
    <div class="global_container">
        
        <div class="global_container header__info">
            <div class="header__info-node">
                <p>Numero Telephone: </p>
                <h3>{{$contact_number}}</h3>
            </div>
        
            <div class="header__info-node">
                <p>Numero Whatsapp: </p>
                <h3>{{$contact_whatsapp}}</h3>
            </div>
        
            <div class="header__info-node">
                <p>Contact Email: </p>
                <h3>{{$contact_email}} </h3>
            </div>
        
        
        </div>

        <div class="row v-center">
            <div class="header-item item-left">
                <div class="logo">
                    <a href="/accueil">
                        <img src={{@asset('./logos/primary-logo.svg')}} alt="">
                    </a>
                </div>
            </div>

            <!-- menu start here -->
            <div class="header-item item-center">
                <div class="menu-overlay"></div>

                <nav class="menu">
                    <div class="mobile-menu-head">
                        <div class="go-back">
                            <x-chevron-icon></x-chevron-icon>
                        </div>
                        <div class="current-menu-title"></div>
                        <div class="mobile-menu-close">
                            <x-add-icon></x-add-icon>
                        </div>
                    </div>
                    <ul class="menu-main">
                        <li>
                            <a href="/accueil">Accueil</a>
                        </li>

                        <li>
                            <a href="/entreprise">Entreprise</a>
                        </li>

                        <li class="menu-item-has-children">
                            <a href="/catalogue">Catalogue <i class="fa fa-angle-down"></i></a>
                            {{-- <div class="sub-menu mega-menu mega-menu-column-4">
                                <div class="list-item">
                                    <a href="/product-categories/20" class="title">Fournitures Indutrielles</a>
                                    <ul>
                                        <li><a href="/products/45">Bandes Industrielles</a></li>
                                        <li><a href="/products/46">Chaines Industrielles</a></li>
                                        <li><a href="/products/47">Courroies Industrielles</a></li>
                                        <li><a href="/products/48">Coussinets Industriels</a></li>
                                        <li><a href="/products/49">Embouts Industriels</a></li>
                                        <li><a href="/products/50">Etancheité Industrielle</a></li>
                                        <li><a href="/products/51">Huiles Et Graisses</a></li>
                                        <li><a href="/products/52">Paliers Industriels</a></li>
                                        <li><a href="/product-categories/21">Découvrir Plus...</a></li>
                                    </ul>
                                </div>
                                <div class="list-item">
                                    <a href="/product-categories/21" class="title">Matériaux Industrielles</a>
                                    <ul>
                                        <li><a href="/products/57">Chariot D'atelier</a></li>
                                        <li><a href="/products/58">Chariot de magasin</a></li>
                                        <li><a href="/products/59">Diable à Dossier</a></li>
                                        <li><a href="/products/60">Diable à Fut</a></li>
                                        <li><a href="/products/61">Gerbeur Manuel</a></li>
                                        <li><a href="/products/62">Grue Mobile</a></li>
                                        <li><a href="/products/63">Palan Et Treuil</a></li>
                                        <li><a href="/products/64">Remorque à Main</a></li>
                                        <li><a href="/product-categories/21">Découvrir Plus...</a></li>
                                    </ul>
                                </div>
                            </div> --}}
                        </li>
{{-- 
                        <li class="menu-item-has-children">
                            <a href="/services">Services <i class="fas fa-angle-down"></i></a>
                            <div class="sub-menu single-column-menu">
                                <ul>
                                    <li><a href="/services/4">Maintenance</a></li>
                                    <li><a href="/services/5">Machinerie</a></li>
                                </ul>
                            </div>
                        </li> --}}

                        <li class="menu-item-has-children">
                            <a href="/projects-categories-list">Projets <i class="fa fa-angle-down"></i></a>
                            {{-- <div class="sub-menu mega-menu mega-menu-column-4">
                                <div class="list-item">
                                    <h4 class="title">Pharmaceutiques</h4>
                                    <ul>
                                        <li><a href="#">Project List</a></li>
                                        <li><a href="#">Project List</a></li>
                                        <li><a href="#">Project List</a></li>
                                        <li><a href="#">Project List</a></li>
                                        <li><a href="#">Project List</a></li>
                                    </ul>
                                    <h4 class="title">Minières</h4>
                                    <ul>
                                        <li><a href="#">Project List</a></li>
                                        <li><a href="#">Project List</a></li>
                                        <li><a href="#">Project List</a></li>
                                    </ul>
                                </div>
                                <div class="list-item">
                                    <h4 class="title">Plasturgie</h4>
                                    <ul>
                                        <li><a href="#">Project List</a></li>
                                        <li><a href="#">Project List</a></li>
                                        <li><a href="#">Project List</a></li>
                                        <li><a href="#">Project List</a></li>
                                    </ul>
                                    <h4 class="title">Ceramique</h4>
                                    <ul>
                                        <li><a href="#">Project List</a></li>
                                        <li><a href="#">Project List</a></li>
                                        <li><a href="#">Project List</a></li>
                                        <li><a href="#">Project List</a></li>
                                    </ul>
                                </div>
                                <div class="list-item">
                                    <h4 class="title">Agro-Alimentaires</h4>
                                    <ul>
                                        <li><a href="#">Project List</a></li>
                                        <li><a href="#">Project List</a></li>
                                        <li><a href="#">Project List</a></li>
                                        <li><a href="#">Project List</a></li>
                                        <li><a href="#">Project List</a></li>
                                        <li><a href="#">Project List</a></li>
                                        <li><a href="#">Project List</a></li>
                                        <li><a href="#">Project List</a></li>
                                        <li><a href="#">Project List</a></li>
                                    </ul>
                                </div>
                                <div class="list-item">
                                    <img src={{@asset('./blanks/500x500.png')}} alt="shop">
                                </div>
                            </div> --}}
                        </li>

                        <li>
                            <a href="/actualites">Actualités</a>
                        </li>
                    </ul>
                </nav>

            </div>
            <x-primary_button path="/contact" text="Contactez Nous"></x-primary_button>
            <!-- menu end here -->

            {{-- <div class="header-item item-right">
                <div class="mobile-menu-trigger">
                    <span></span>
                </div>
            </div> --}}
        </div>
    </div>
</header>
<div class="BottomNav">
    <div class="BottomNav__left">

        <a href="/services">
            <svg width="20" height="20" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path stroke="white"
                    d="M13.5 6H14.25C15.0456 6 15.8087 6.31607 16.3713 6.87868C16.9339 7.44129 17.25 8.20435 17.25 9C17.25 9.79565 16.9339 10.5587 16.3713 11.1213C15.8087 11.6839 15.0456 12 14.25 12H13.5"
                    stroke-opacity="0.75" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                <path stroke="white"
                    d="M1.5 6H13.5V12.75C13.5 13.5456 13.1839 14.3087 12.6213 14.8713C12.0587 15.4339 11.2956 15.75 10.5 15.75H4.5C3.70435 15.75 2.94129 15.4339 2.37868 14.8713C1.81607 14.3087 1.5 13.5456 1.5 12.75V6Z"
                    stroke-opacity="0.75" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                <path stroke="white" d="M4.5 0.75V3" stroke-opacity="0.75" stroke-width="1.5" stroke-linecap="round"
                    stroke-linejoin="round" />
                <path stroke="white" d="M7.5 0.75V3" stroke-opacity="0.75" stroke-width="1.5" stroke-linecap="round"
                    stroke-linejoin="round" />
                <path stroke="white" d="M10.5 0.75V3" stroke-opacity="0.75" stroke-width="1.5" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
            <p>Services</p>
        </a>

        <a href="/catalogue">
            <svg width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M3 2.5H8.83333V8.33333H3V2.5Z" stroke="white" stroke-width="1.5" stroke-linecap="round"
                    stroke-linejoin="round" />
                <path d="M12.1667 2.5H18V8.33333H12.1667V2.5Z" stroke="white" stroke-width="1.5" stroke-linecap="round"
                    stroke-linejoin="round" />
                <path d="M12.1667 11.6667H18V17.5H12.1667V11.6667Z" stroke="white" stroke-width="1.5"
                    stroke-linecap="round" stroke-linejoin="round" />
                <path d="M3 11.6667H8.83333V17.5H3V11.6667Z" stroke="white" stroke-width="1.5" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
            <p>Catalogue</p>
        </a>

        <a href="/accueil">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                <path
                    d="M1.5 7.99999L7.46933 2.02999C7.76267 1.73732 8.23733 1.73732 8.53 2.02999L14.5 7.99999M3 6.49999V13.25C3 13.664 3.336 14 3.75 14H6.5V10.75C6.5 10.336 6.836 9.99999 7.25 9.99999H8.75C9.164 9.99999 9.5 10.336 9.5 10.75V14H12.25C12.664 14 13 13.664 13 13.25V6.49999M5.5 14H11"
                    stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            <p>Accueil</p>
        </a>
        {{--
    </div>
    <div class="BottomNav__middle">
        <button>
            <a href="tel: {{ $contact_number }}">
                <x-call-icon />
            </a>
        </button>
    </div>

    <div class="BottomNav__right"> --}}
        <a href="/contact">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M17.5 9.58333C17.5029 10.6832 17.2459 11.7682 16.75 12.75C16.162 13.9264 15.2581 14.916 14.1395 15.6077C13.021 16.2995 11.7319 16.6662 10.4167 16.6667C9.31678 16.6695 8.23176 16.4126 7.25 15.9167L2.5 17.5L4.08333 12.75C3.58744 11.7682 3.33047 10.6832 3.33333 9.58333C3.33384 8.26812 3.70051 6.97904 4.39227 5.86045C5.08402 4.74187 6.07355 3.83797 7.25 3.24999C8.23176 2.7541 9.31678 2.49713 10.4167 2.49999H10.8333C12.5703 2.59582 14.2109 3.32896 15.441 4.55904C16.671 5.78912 17.4042 7.4297 17.5 9.16666V9.58333Z"
                    stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            <p>Contact</p>
        </a>
        <a href="/entreprise">
            <svg data-testid="geist-icon" height="16" stroke-linejoin="round" viewBox="0 0 16 16" width="16"
                style="color: currentcolor;">
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M8 14.5C11.5899 14.5 14.5 11.5899 14.5 8C14.5 4.41015 11.5899 1.5 8 1.5C4.41015 1.5 1.5 4.41015 1.5 8C1.5 11.5899 4.41015 14.5 8 14.5ZM8 16C12.4183 16 16 12.4183 16 8C16 3.58172 12.4183 0 8 0C3.58172 0 0 3.58172 0 8C0 12.4183 3.58172 16 8 16ZM6.25 7H7H7.74999C8.30227 7 8.74999 7.44772 8.74999 8V11.5V12.25H7.24999V11.5V8.5H7H6.25V7ZM8 6C8.55229 6 9 5.55228 9 5C9 4.44772 8.55229 4 8 4C7.44772 4 7 4.44772 7 5C7 5.55228 7.44772 6 8 6Z"
                    fill="white"></path>
            </svg>
            <p>Entreprise</p>
        </a>
    </div>
</div>

<script>
    const menu = document.querySelector(".menu");
    const menuMain = menu.querySelector(".menu-main");
    const goBack = menu.querySelector(".go-back");
    const menuTrigger = document.querySelector(".mobile-menu-trigger");
    const closeMenu = menu.querySelector(".mobile-menu-close");
    let subMenu;
    menuMain.addEventListener("click", (e) =>{
    if(!menu.classList.contains("active")){
    return;
    }
    if(e.target.closest(".menu-item-has-children")){
    const hasChildren = e.target.closest(".menu-item-has-children");
    showSubMenu(hasChildren);
    }
    });
    goBack.addEventListener("click",() =>{
    hideSubMenu();
    })
    menuTrigger.addEventListener("click",() =>{
    toggleMenu();
    })
    closeMenu.addEventListener("click",() =>{
    toggleMenu();
    })
    document.querySelector(".menu-overlay").addEventListener("click",() =>{
    toggleMenu();
    })
    function toggleMenu(){
    menu.classList.toggle("active");
    document.querySelector(".menu-overlay").classList.toggle("active");
    }
    function showSubMenu(hasChildren){
    subMenu = hasChildren.querySelector(".sub-menu");
    subMenu.classList.add("active");
    subMenu.style.animation = "slideLeft 0.5s ease forwards";
    const menuTitle = hasChildren.querySelector("i").parentNode.childNodes[0].textContent;
    menu.querySelector(".current-menu-title").innerHTML=menuTitle;
    menu.querySelector(".mobile-menu-head").classList.add("active");
    }
    
    function hideSubMenu(){
    subMenu.style.animation = "slideRight 0.5s ease forwards";
    setTimeout(() =>{
    subMenu.classList.remove("active");
    },300);
    menu.querySelector(".current-menu-title").innerHTML="";
    menu.querySelector(".mobile-menu-head").classList.remove("active");
    }
    
    window.onresize = function(){
    if(this.innerWidth >991){
    if(menu.classList.contains("active")){
    toggleMenu();
    }
    
    }
    }
</script>

<script>
    window.addEventListener('scroll', function() {
        var header = document.getElementById('header');
        var scrollPosition = window.scrollY;

        if (scrollPosition > 100) { // Change '100' to the desired scroll amount
            header.style.position = 'fixed';
        } else {
            header.style.position = 'static'; // Change to 'relative' or 'absolute' as needed
        }
    });
</script>