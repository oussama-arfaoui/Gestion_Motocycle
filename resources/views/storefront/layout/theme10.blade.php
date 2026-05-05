@php
$data = DB::table('settings');
$data = $data
    ->where('created_by', '>', 1)
    ->where('store_id', $store->id)
    ->where('name', 'SITE_RTL')
    ->first(); 
    if(!isset($data)){
        $data = (object)[
            "name"=> "SITE_RTL",
            "value"=> "off"
            ];
    }
    $clang = session()->get('lang');
    if($clang == 'ar' || $clang == 'he'){
        $data->value = 'on';
    }

    $setting = DB::table('settings')
        ->where('name', 'company_favicon')
        ->where('store_id', $store->id)
        ->first();
    $settings = Utility::settings();
    $getStoreThemeSetting = Utility::getStoreThemeSetting($store->id, $store->theme_dir);
    $getStoreThemeSetting1 = [];
    if (!empty($getStoreThemeSetting['dashboard'])) {
        $getStoreThemeSetting = json_decode($getStoreThemeSetting['dashboard'], true);
        $getStoreThemeSetting1 = Utility::getStoreThemeSetting($store->id, $store->theme_dir);
    }
    if (empty($getStoreThemeSetting)) {
        $path = storage_path() . '/uploads/' . $store->theme_dir . '/' . $store->theme_dir . '.json';
        $getStoreThemeSetting = json_decode(file_get_contents($path), true);
    }
    $imgpath = \App\Models\Utility::get_file('uploads/');
    $s_logo = \App\Models\Utility::get_file('uploads/store_logo/');
    $brand_logo = \App\Models\Utility::get_file('uploads/theme10/brand_logo/');
    $metaImage = \App\Models\Utility::get_file('uploads/metaImage');
    $themeClass = $store->store_theme;
    $theme_name = $store->theme_dir;
    $storethemesetting1 = Utility::demoStoreThemeSetting($store->id, $store->theme_dir);
    if (!empty(session()->get('lang'))) {
        $currantLang = session()->get('lang');
    } else {
        $currantLang = $store->lang;
    }
    $languages = \App\Models\Utility::languages();
    $langName = \App\Models\Languages::where('code',$currantLang)->first();
@endphp
<!DOCTYPE html>
<html lang="en" dir="{{ empty($data) ? '' : ($data->value == 'on' ? 'rtl' : '') }}">
<head>

    @include('storefront.partials.head')

</head>

<body class="{{ !empty($themeClass)? $themeClass : 'theme10-v1' }}">
    <div class="overlay"></div>

    <header class="site-header" style="background: white; box-shadow: 0 2px 12px rgba(255,122,0,0.15); position: sticky; top: 0; z-index: 1000; border-bottom: 3px solid #FF7A00;">
        @if ($storethemesetting1['enable_top_bar'] == 'on')
            <div class="announcebar" style="background: linear-gradient(90deg, #FF7A00, #FF9A00); color: white; padding: 10px 0; font-weight: 600; letter-spacing: 0.5px;">
                <div class="container">
                    <p class="text-center" style="margin: 0;">{{ !empty($storethemesetting1['top_bar_title']) ? $storethemesetting1['top_bar_title'] : '' }}</p>
                </div>
            </div>
        @endif
        
        <nav style="padding: 12px 0;">
            <div class="container" style="display: flex; justify-content: space-between; align-items: center;">
                <div class="logo" style="display: flex; align-items: center;">
                    <a href="{{ route('store.slug', $store->slug) }}" style="display: flex; align-items: center; text-decoration: none;">
                        <img src="{{ asset('images/mobinardo-logo.png') }}" alt="MOBINARDO" style="max-height: 65px; max-width: 240px; object-fit: contain;">
                    </a>
                </div>
                
                <div class="nav-menu" style="display: flex; gap: 2rem; align-items: center;">
                    <a href="{{ route('store.slug', $store->slug) }}" style="color: #2c3e50; text-decoration: none; font-weight: 600; transition: color 0.3s; padding: 6px 0; border-bottom: 2px solid transparent;" onmouseover="this.style.color='#FF7A00'; this.style.borderBottomColor='#FF7A00'" onmouseout="this.style.color='#2c3e50'; this.style.borderBottomColor='transparent'">{{ __('Home') }}</a>
                    
                    @if (!empty($page_slug_urls))
                        @foreach ($page_slug_urls as $k => $page_slug_url)
                            @if ($page_slug_url->enable_page_header == 'on')
                                <a href="{{ route('pageoption.slug', $page_slug_url->slug) }}" style="color: #2c3e50; text-decoration: none; font-weight: 600; transition: color 0.3s; padding: 6px 0; border-bottom: 2px solid transparent;" onmouseover="this.style.color='#FF7A00'; this.style.borderBottomColor='#FF7A00'" onmouseout="this.style.color='#2c3e50'; this.style.borderBottomColor='transparent'">{{ ucfirst($page_slug_url->name) }}</a>
                            @endif
                        @endforeach
                    @endif
                    
                    @if ($store['blog_enable'] == 'on' && !empty($blog))
                        <a href="{{ route('store.blog', $store->slug) }}" style="color: #2c3e50; text-decoration: none; font-weight: 600; transition: color 0.3s; padding: 6px 0; border-bottom: 2px solid transparent;" onmouseover="this.style.color='#FF7A00'; this.style.borderBottomColor='#FF7A00'" onmouseout="this.style.color='#2c3e50'; this.style.borderBottomColor='transparent'">{{ __('Blog') }}</a>
                    @endif
                </div>
                
                <button class="mobile-menu-toggle" onclick="document.querySelector('.mobile-menu-wrapper').classList.toggle('active')" style="display: none; background: #FF7A00; border: none; cursor: pointer; border-radius: 8px; padding: 6px 10px;">
                    <svg width="24" height="24" viewBox="0 0 30 30" fill="white">
                        <path d="M3 7h24M3 15h24M3 23h24" stroke="white" stroke-width="2.5" stroke-linecap="round"/>
                    </svg>
                </button>
            </div>
        </nav>
    </header>

     @yield('content')


    @if ($getStoreThemeSetting[15]['section_enable'] == 'on')
        <script>
            {!! $getStoreThemeSetting[17]['inner-list'][0]['field_default_text'] !!}
        </script>
    @endif
    

    @include('storefront.partials.footer')

</body>
</html>
