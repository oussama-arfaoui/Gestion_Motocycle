<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductCategorie;
use App\Models\Store;
use App\Models\StoreThemeSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WebsiteSettingsController extends Controller
{
    private const THEME_KEY = 'website_editor';
    private const SETTING_NAME = 'settings';

    private function storeId(): int
    {
        return (int) Auth::user()->current_store;
    }

    public function index()
    {
        if (!Auth::user()->can('Manage Themes')) {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }

        $storeId    = $this->storeId();
        $store      = Store::find($storeId);
        $brands     = Brand::all();
        $categories = ProductCategorie::where('store_id', $storeId)->get();
        $products   = Product::where('store_id', $storeId)->get();

        $row = StoreThemeSettings::where('store_id', $storeId)
            ->where('theme_name', self::THEME_KEY)
            ->where('name', self::SETTING_NAME)
            ->first();

        $settings = $row ? json_decode($row->value, true) : $this->defaultSettings();

        $storeUrl  = '';
        $iframeCode = '';
        if ($store) {
            $appUrl    = rtrim(env('APP_URL'), '/');
            $storeUrl  = $appUrl . '/store/' . $store->slug;
            $iframeCode = '<iframe' . "\n" .
                '  src="' . $storeUrl . '"' . "\n" .
                '  width="100%"' . "\n" .
                '  height="900"' . "\n" .
                '  frameborder="0"' . "\n" .
                '  style="border:none; border-radius:8px;">' . "\n" .
                '</iframe>';
        }

        return view('website-settings.index', compact(
            'store', 'brands', 'categories', 'products',
            'settings', 'storeUrl', 'iframeCode'
        ));
    }

    public function save(Request $request)
    {
        if (!Auth::user()->can('Manage Themes')) {
            return response()->json(['error' => 'Permission Denied'], 403);
        }

        $storeId = $this->storeId();
        $data    = $request->except('_token');

        StoreThemeSettings::updateOrCreate(
            [
                'store_id'   => $storeId,
                'theme_name' => self::THEME_KEY,
                'name'       => self::SETTING_NAME,
            ],
            [
                'value'      => json_encode($data),
                'type'       => 'json',
                'created_by' => Auth::id(),
            ]
        );

        return response()->json(['success' => true, 'message' => 'Settings saved successfully!']);
    }

    public function getSettings()
    {
        $storeId = $this->storeId();
        $row = StoreThemeSettings::where('store_id', $storeId)
            ->where('theme_name', self::THEME_KEY)
            ->where('name', self::SETTING_NAME)
            ->first();

        return response()->json(
            $row ? json_decode($row->value, true) : $this->defaultSettings()
        );
    }

    private function defaultSettings(): array
    {
        return [
            'mode' => 'integrate',
            'menu' => [
                'sticky'     => false,
                'bg_color'   => '#ffffff',
                'text_color' => '#333333',
            ],
            'hero' => [
                'enabled'  => true,
                'title'    => 'Welcome to Our Store',
                'subtitle' => 'Discover our amazing collection',
                'cta_text' => 'Shop Now',
                'cta_link' => '',
            ],
            'brands' => [
                'enabled'  => true,
                'title'    => 'Our Brands',
                'carousel' => true,
            ],
            'gamme' => [
                'enabled'     => true,
                'title'       => 'Notre Gamme',
                'layout'      => 'grid',
                'category_id' => null,
            ],
            'featured' => [
                'enabled'  => true,
                'limit'    => 8,
                'ordering' => 'latest',
            ],
            'video' => [
                'enabled'  => false,
                'url'      => '',
                'autoplay' => false,
            ],
            'cta' => [
                'enabled'     => true,
                'title'       => 'Ready to get started?',
                'description' => 'Contact us today and explore our full range.',
                'btn_text'    => 'Contact Us',
                'btn_link'    => '',
                'bg_color'    => '#f8f9fa',
            ],
            'footer' => [
                'enabled'   => true,
                'copyright' => '© ' . date('Y') . ' All rights reserved.',
                'social'    => [
                    'facebook'  => '',
                    'instagram' => '',
                    'twitter'   => '',
                    'youtube'   => '',
                ],
            ],
        ];
    }
}
