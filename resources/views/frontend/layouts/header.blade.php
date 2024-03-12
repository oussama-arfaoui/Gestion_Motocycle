<header class="header">
    <div class="global_container">
        <div class="row v-center">
            <div class="header-item item-left">
                <div class="logo">
                    <a href="#">
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

                        <li class="menu-item-has-children">
                            <a href="#">Catalogue <i class="fa fa-angle-down"></i></a>
                            <div class="sub-menu mega-menu mega-menu-column-4">
                                <div class="list-item">
                                    <h4 class="title">Fournitures Indutrielles</h4>
                                    <ul>
                                        <li><a href="#">Product List</a></li>
                                        <li><a href="#">Product List</a></li>
                                        <li><a href="#">Product List</a></li>
                                        <li><a href="#">Product List</a></li>
                                        <li><a href="#">Product List</a></li>
                                        <li><a href="#">Product List</a></li>
                                        <li><a href="#">Product List</a></li>
                                        <li><a href="#">Product List</a></li>
                                        <li><a href="#">Product List</a></li>
                                    </ul>
                                </div>
                                <div class="list-item">
                                    <h4 class="title">Outils Industrielles</h4>
                                    <ul>
                                        <li><a href="#">Product List</a></li>
                                        <li><a href="#">Product List</a></li>
                                        <li><a href="#">Product List</a></li>
                                        <li><a href="#">Product List</a></li>
                                        <li><a href="#">Product List</a></li>
                                        <li><a href="#">Product List</a></li>
                                        <li><a href="#">Product List</a></li>
                                        <li><a href="#">Product List</a></li>
                                        <li><a href="#">Product List</a></li>
                                    </ul>
                                </div>
                                <div class="list-item">
                                    <img src={{@asset('./blanks/500x500.png')}} alt="shop">
                                </div>
                            </div>
                        </li>

                        <li class="menu-item-has-children">
                            <a href="#">Services <i class="fas fa-angle-down"></i></a>
                            <div class="sub-menu single-column-menu">
                                <ul>
                                    <li><a href="#">Maintenance</a></li>
                                    <li><a href="#">Machinerie</a></li>
                                </ul>
                            </div>
                        </li>

                        <li class="menu-item-has-children">
                            <a href="#">Projets <i class="fa fa-angle-down"></i></a>
                            <div class="sub-menu mega-menu mega-menu-column-4">
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
                            </div>
                        </li>
                        
                        <li>
                            <a href="#">Actualités</a>
                        </li>
                        
                        <li>
                            <a href="#">Contact</a>
                        </li>
                    </ul>
                </nav>

            </div>
            <x-primary_button path="/contact" text="Contactez Nous"></x-primary_button>
            <!-- menu end here -->

            <div class="header-item item-right">
                <div class="mobile-menu-trigger">
                    <span></span>
                </div>
            </div>
        </div>
    </div>
</header>

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