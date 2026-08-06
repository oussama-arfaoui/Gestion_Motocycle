@php
    $company_logo = \App\Models\Utility::GetLogo();
    $plan = \Auth::user()->currentPlan;
@endphp
@if (isset($setting['cust_theme_bg']) && $setting['cust_theme_bg'] == 'on')
    <nav class="dash-sidebar light-sidebar transprent-bg">
@else
    <nav class="dash-sidebar light-sidebar">
@endif
    <div class="navbar-wrapper">
        <div class="m-header justify-content-center">
            <a href="{{ route('dashboard') }}" class="b-brand">
                <!-- ========   change your logo hear   ============ -->
                <img src="{{ $logo . '/' . (isset($company_logo) && !empty($company_logo) ? $company_logo : 'logo-dark.png') . '?timestamp='. time() }}"
                    alt="{{ config('app.name', 'Storego') }}" class="logo logo-lg fix-logo" height="40px" />
            </a>
        </div>
        <div class="navbar-content">
            <ul class="dash-navbar">
                @if (Auth::user()->type == 'super admin')
                    @can('Manage Dashboard')
                        <li class="dash-item {{ Request::segment(1) == 'dashboard' ? ' active' : 'collapsed' }}">
                            <a href="{{ route('dashboard') }}"
                                class="dash-link {{ request()->is('dashboard') ? 'active' : '' }}">
                                <span class="dash-micon">
                                    <i class="ti ti-home"></i>
                                </span>
                                <span class="dash-mtext">Tableau de bord</span>
                            </a>
                        </li>
                    @endcan
                    @can('Manage Store')
                        <li
                            class="dash-item dash-hasmenu {{ Request::segment(1) == 'store-resource' || Request::route()->getName() == 'store.grid' ? ' active dash-trigger' : 'collapsed' }}">
                            <a href="{{ route('store-resource.index') }}"
                                class="dash-link {{ request()->is('store-resource') ? 'active' : '' }}">
                                <span class="dash-micon">
                                    <i class="ti ti-user"></i>
                                </span>
                                <span class="dash-mtext">{{ __('Stores') }}</span>
                            </a>
                        </li>
                    @endcan

                    @can('Manage Coupans')
                        <li
                            class="dash-item dash-hasmenu {{ Request::segment(1) == 'coupons' ? ' active' : 'collapsed' }}">
                            <a href="{{ route('coupons.index') }}"
                                class="dash-link {{ request()->is('coupons') ? 'active' : '' }}">
                                <span class="dash-micon">
                                    <i class="ti ti-tag"></i>
                                </span>
                                <span class="dash-mtext">{{ __('Coupons') }}</span>
                            </a>
                        </li>
                    @endcan

                    @can('Manage Plans')
                        <li
                            class="dash-item dash-hasmenu {{ Request::segment(1) == 'plans' || Request::route()->getName() == 'stripe' ? ' active dash-trigger' : 'collapsed' }}">
                            <a href="{{ route('plans.index') }}"
                                class="dash-link {{ request()->is('plans') ? 'active' : '' }}">
                                <span class="dash-micon">
                                    <i class="ti ti-trophy"></i>
                                </span>
                                <span class="dash-mtext">{{ __('Plans') }}</span>
                            </a>
                        </li>
                    @endcan

                    @can('Manage Plan Request')
                        <li
                            class="dash-item dash-hasmenu {{ Request::segment(1) == 'plan_request' ? ' active' : 'collapsed' }}">
                            <a href="{{ route('plan_request.index') }}"
                                class="dash-link {{ request()->is('plan_request') ? 'active' : '' }}">
                                <span class="dash-micon">
                                    <i class="ti ti-brand-telegram"></i>
                                </span>
                                <span class="dash-mtext">{{ __('Plan Requests') }}</span>
                            </a>
                        </li>
                    @endcan

                    <li class="dash-item dash-hasmenu  {{ Request::segment(1) == 'referral-program' ? 'active' : '' }}">
                        <a href="{{ route('referral-program.index') }}" class="dash-link">
                            <span class="dash-micon"><i class="ti ti-discount-2"></i></span><span
                                class="dash-mtext">{{ __('Referral Program') }}</span>
                        </a>
                    </li>

                    <li
                        class="dash-item dash-hasmenu {{ Request::segment(1) == 'custom_domain_request' ? ' active' : 'collapsed' }}">
                        <a href="{{ route('custom_domain_request.index') }}"
                            class="dash-link {{ request()->is('custom_domain_request') ? 'active' : '' }}">
                            <span class="dash-micon">
                                <i class="ti ti-browser"></i>
                            </span>
                            <span class="dash-mtext">{{ __('Domain Requests') }}</span>
                        </a>
                    </li>

                    @can('Manage Email Template')
                        <li
                            class="dash-item dash-hasmenu {{ Request::route()->getName() == 'manage.email.language' || Request::route()->getName() == 'manage.email.language' ? ' active dash-trigger' : 'collapsed' }}">
                            <a href="{{ route('email_templates.index') }}"
                                class="dash-link {{ request()->is('email_template') ? 'active' : '' }}">
                                <span class="dash-micon">
                                    <i class="ti ti-mail"></i>
                                </span>
                                <span class="dash-mtext">{{ __('Email Templates') }}</span>
                            </a>
                        </li>
                    @endcan
                    @include('landingpage::menu.landingpage')
                    @can('Manage Settings')
                        <li class="dash-item dash-hasmenu {{ Request::segment(1) == 'settings' || Request::route()->getName() == 'store.editproducts' ? ' active dash-trigger' : 'collapsed' }}">
                            <a href="{{ route('settings') }}" class="dash-link {{ request()->is('settings') ? 'active' : '' }}">
                                <span class="dash-micon">
                                    <i class="ti ti-settings"></i>
                                </span>
                                <span class="dash-mtext">
                                    Paramètres
                                </span>
                            </a>
                        </li>
                    @endcan
                @else
                    <li class="dash-item {{ Request::segment(1) == 'dashboard' ? ' active' : 'collapsed' }}">
                        <a href="{{ route('dashboard') }}"
                            class="dash-link {{ request()->is('dashboard') ? 'active' : '' }}">
                            <span class="dash-micon">
                                <i class="ti ti-home"></i>
                            </span>
                            <span class="dash-mtext">Tableau de bord</span>
                        </a>
                    </li>
                    @can('Manage Themes')
                    <li class="dash-item {{ Request::segment(1) == 'themes' ? ' active' : 'collapsed' }}">
                        <a href="{{ route('themes.theme') }}"
                            class="dash-link {{ request()->is('themes') ? 'active' : '' }}">
                            <span class="dash-micon">
                                <i class="ti ti-layout-2"></i>
                            </span>
                            <span class="dash-mtext">Thèmes</span>
                        </a>
                    </li>
                    @else
                    <li class="dash-item menu-disabled collapsed">
                        <a href="javascript:void(0)" class="dash-link">
                            <span class="dash-micon">
                                <i class="ti ti-layout-2"></i>
                            </span>
                            <span class="dash-mtext">Thèmes</span>
                        </a>
                    </li>
                    @endcan
                    <li class="dash-item dash-hasmenu {{ Request::segment(1) == 'users' || Request::segment(1) == 'roles' ? ' active dash-trigger' : 'collapsed' }}">
                        <a href="#!" class="dash-link ">
                            <span class="dash-micon">
                                <i class="ti ti-users"></i>
                            </span>
                            <span class="dash-mtext">Personnel</span>
                            <span class="dash-arrow">
                                <i data-feather="chevron-right"></i>
                            </span>
                        </a>
                        <ul class="dash-submenu {{ Request::segment(1) == 'roles' || Request::segment(1) == 'users' ? ' show' : '' }}">
                            @can('Manage Role')
                            <li class="dash-item {{ Request::route()->getName() == 'roles' ? ' active' : '' }}">
                                <a class="dash-link" href="{{ route('roles.index') }}">{{ __('Roles') }}</a>
                            </li>
                            @else
                            <li class="dash-item menu-disabled">
                                <a class="dash-link" href="javascript:void(0)">{{ __('Roles') }}</a>
                            </li>
                            @endcan
                            @can('Manage User')
                            <li class="dash-item {{ Request::segment(1) == 'users' ? ' active' : 'collapsed' }}">
                                <a class="dash-link" href="{{ route('users.index') }}">{{ __('User') }}</a>
                            </li>
                            @else
                            <li class="dash-item menu-disabled">
                                <a class="dash-link" href="javascript:void(0)">{{ __('User') }}</a>
                            </li>
                            @endcan
                        </ul>
                    </li>
                    @can('Manage Pos')
                    <li class="dash-item {{ Request::segment(1) == 'pos' ? ' active' : 'collapsed' }}">
                        <a href="{{ route('pos.index') }}"
                            class="dash-link {{ request()->is('pos') ? 'active' : '' }}">
                            <span class="dash-micon">
                                <i class="ti ti-layers-difference"></i>
                            </span>
                            <span class="dash-mtext">Point de vente</span>
                        </a>
                    </li>
                    @else
                    <li class="dash-item menu-disabled collapsed">
                        <a href="javascript:void(0)" class="dash-link">
                            <span class="dash-micon">
                                <i class="ti ti-layers-difference"></i>
                            </span>
                            <span class="dash-mtext">Point de vente</span>
                        </a>
                    </li>
                    @endcan
                    {{-- Store/Magasin --}}
                    @canany(['Manage Brands', 'Manage Products', 'Create Products', 'Edit Products', 'Show Products', 'Delete Products'])
                    <li class="dash-item {{ Request::segment(1) == 'brands' ? ' active' : 'collapsed' }}">
                        <a href="{{ route('brands.index') }}"
                            class="dash-link {{ request()->is('brands*') ? 'active' : '' }}">
                            <span class="dash-micon">
                                <i class="ti ti-license"></i>
                            </span>
                            <span class="dash-mtext">Stock Magasin</span>
                        </a>
                    </li>
                    @else
                    <li class="dash-item menu-disabled collapsed">
                        <a href="javascript:void(0)" class="dash-link">
                            <span class="dash-micon">
                                <i class="ti ti-license"></i>
                            </span>
                            <span class="dash-mtext">Stock Magasin</span>
                        </a>
                    </li>
                    @endcanany

                    {{-- Orders --}}
                    @canany(['Manage Orders', 'Show Orders', 'Delete Orders', 'Edit Orders', 'Validate Orders'])
                    <li class="dash-item {{ Request::segment(1) == 'chassis-orders' ? ' active' : 'collapsed' }}">
                        <a href="{{ route('chassis-orders.index') }}"
                            class="dash-link {{ request()->is('chassis-orders*') ? 'active' : '' }}">
                            <span class="dash-micon">
                                <i class="ti ti-receipt"></i>
                            </span>
                            <span class="dash-mtext">État des ventes</span>
                        </a>
                    </li>
                    @else
                    <li class="dash-item menu-disabled collapsed">
                        <a href="javascript:void(0)" class="dash-link">
                            <span class="dash-micon">
                                <i class="ti ti-receipt"></i>
                            </span>
                            <span class="dash-mtext">État des ventes</span>
                        </a>
                    </li>
                    @endcanany

                    {{-- Flux Financier --}}
                    @if(\Auth::user()->type == 'Owner' || \Auth::user()->can('Manage Flux') || \Auth::user()->can('Show Flux'))
                    <li class="dash-item {{ Request::segment(1) == 'flux-financier' ? ' active' : 'collapsed' }}">
                        <a href="{{ route('flux-financier.index') }}"
                            class="dash-link {{ request()->is('flux-financier*') ? 'active' : '' }}">
                            <span class="dash-micon">
                                <i class="ti ti-cash-banknote"></i>
                            </span>
                            <span class="dash-mtext">Flux Financier</span>
                        </a>
                    </li>
                    @endif
                   <!-- @can('Manage Customers')
                        <li
                            class="dash-item {{ Request::segment(1) == 'customer.index' || Request::route()->getName() == 'customer.show' ? ' active dash-trigger ' : 'collapsed' }}">
                            <a href="{{ route('customer.index') }}"
                                class="dash-link {{ request()->is('customer.index') ? 'active' : '' }}">
                                <span class="dash-micon">
                                    <i class="ti ti-user"></i>
                                </span>
                                <span class="dash-mtext">{{ __('Customers') }}</span>
                            </a>
                        </li>
                    @endcan
                    @can('Manage Plans')
                        <li class="dash-item dash-hasmenu {{ Request::segment(1) == 'plans' || Request::route()->getName() == 'stripe' ? ' active dash-trigger' : 'collapsed' }}">
                            <a href="{{ route('plans.index') }}"
                                class="dash-link {{ request()->is('plans') ? 'active' : '' }}">
                                <span class="dash-micon">
                                    <i class="ti ti-trophy"></i>
                                </span>
                                <span class="dash-mtext">{{ __('Plans') }}</span>
                            </a>
                        </li>
                    @endcan

                    @if (Auth::user()->type == 'Owner')
                        <li class="dash-item dash-hasmenu  {{ Request::segment(1) == 'referral-program' ? 'active' : '' }}">
                            <a href="{{ route('referral-program.company') }}" class="dash-link">
                                <span class="dash-micon"><i class="ti ti-discount-2"></i></span><span
                                    class="dash-mtext">{{ __('Referral Program') }}</span>
                            </a>
                        </li>
                    @endif-->

                    @can('Manage Settings')
                    <li class="dash-item dash-hasmenu {{ Request::segment(1) == 'settings' || Request::route()->getName() == 'store.editproducts' ? ' active dash-trigger' : 'collapsed' }}">
                        <a href="{{ route('settings') }}" class="dash-link {{ request()->is('settings') ? 'active' : '' }}">
                            <span class="dash-micon">
                                <i class="ti ti-settings"></i>
                            </span>
                            <span class="dash-mtext">Paramètres</span>
                        </a>
                    </li>
                    @else
                    <li class="dash-item menu-disabled collapsed">
                        <a href="javascript:void(0)" class="dash-link">
                            <span class="dash-micon">
                                <i class="ti ti-settings"></i>
                            </span>
                            <span class="dash-mtext">Paramètres</span>
                        </a>
                    </li>
                    @endcan
                @endif
            </ul>

        </div>
    </div>
</nav>
