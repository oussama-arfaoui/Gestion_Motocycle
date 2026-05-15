# Application Audit Report
**Project:** Gestion Motocycle — mobi-nardo POS/Store Manager  
**Stack:** Laravel 11 · PHP 8.2 · MySQL · Blade · jQuery · Tabler UI  
**Audited:** May 15, 2026  
**Auditor:** Cascade AI  

---

## 1. Critical Issues

> These are **blocking bugs** or system-level problems that break core functionality or pose immediate risk.

---

### 1.1 — XSS Middleware Sanitization is DISABLED
**File:** `app/Http/Middleware/XSS.php` — lines 43–47  
**Severity:** 🔴 CRITICAL

The `strip_tags` sanitization loop is **commented out**. The middleware is named `XSS` but does **nothing** to sanitize user input:

```php
// array_walk_recursive(
//     $input, function (&$input){
//     $input = strip_tags($input);
// }
// );
```

**Impact:** All form inputs across the entire application pass through without sanitization. Any field stored in the database and rendered in the frontend is vulnerable to stored XSS attacks.  
**Fix:** Uncomment the `strip_tags` block, or implement a proper HTML purifier like `HTMLPurifier`.

---

### 1.2 — Typo in `User` Model `$fillable` — `currant_store`
**File:** `app/Models/User.php` — line 29  
**Severity:** 🔴 CRITICAL

```php
'currant_store',   // ← typo — should be 'current_store'
```

The actual database column is `current_store`, but the mass-assignment key is misspelled as `currant_store`. This means `User::create(['current_store' => $id])` silently **fails to persist** the `current_store` field via mass assignment.  
**Fix:** Change `'currant_store'` → `'current_store'` in `$fillable`.

---

### 1.3 — Semicolon Bug in `User::assignPlan()` — Always Executes Block
**File:** `app/Models/User.php` — line 98  
**Severity:** 🔴 CRITICAL

```php
if($this->trial_expire_date != null);   // ← trailing semicolon = null statement
{
    $this->trial_expire_date = null;    // always executes regardless of condition
}
```

The trailing semicolon after the `if` condition makes the block **always execute**, resetting `trial_expire_date` to `null` unconditionally every time a plan is assigned.  
**Fix:** Remove the semicolon: `if($this->trial_expire_date != null) {`

---

### 1.4 — `'Show Orders'` Permission Used in Code but Never Created
**Files:** `app/Http/Controllers/ChassisOrderController.php` lines 18, 46 · `app/Http/Controllers/OrderController.php` line 81  
**Migration:** `2026_05_15_000001_add_brands_orders_permissions.php`  
**Severity:** 🔴 CRITICAL

The permission `'Show Orders'` is checked in controllers but **is not created** in the migration. The migration creates: `Manage Orders`, `Create Order`, `Edit Order`, `Delete Order`, `Validate Order` — but not `Show Orders`.

```php
// ChassisOrderController.php line 18 — checks a permission that does not exist in DB
if (... !Auth::user()->can('Show Orders')) {
```

**Impact:** Any staff user with the `Show Orders` role can never be granted it because the permission record doesn't exist. The check always returns `false` for non-Owner users.  
**Fix:** Add `'Show Orders'` to the migration's `$newPermissions` array and re-run `artisan migrate` or add it manually via seeder.

---

### 1.5 — Brand Model Has No Multi-Tenancy Isolation (No `store_id`)
**File:** `app/Models/Brand.php` · `app/Http/Controllers/BrandController.php` line 17  
**Severity:** 🔴 CRITICAL

The `Brand` model's `$fillable` array does not include `store_id`. The `BrandController::index()` fetches ALL brands for ALL stores:

```php
$brands = Brand::with(['categories.variants.chassisNumbers'])->get();
```

In a multi-tenant SaaS, every Owner can see and modify brands created by other Owners. There is **no tenant isolation** on the brands, models (categories), families (variants), or chassis numbers.  
**Fix:** Add `store_id` to the `brands` table, populate it on creation, and filter by `Auth::user()->current_store` in all brand queries.

---

### 1.6 — Race Condition in `ChassisOrder::generateOrderNumber()`
**File:** `app/Models/ChassisOrder.php` — lines 47–51  
**Severity:** 🔴 CRITICAL

```php
public static function generateOrderNumber()
{
    $lastOrder = self::orderBy('id', 'desc')->first();
    $nextId = $lastOrder ? $lastOrder->id + 1 : 1;
    return 'CO-' . str_pad($nextId, 6, '0', STR_PAD_LEFT);
}
```

This method reads the last ID and increments it outside a transaction/lock. Under concurrent order creation, **two orders can receive the same order number**, violating the `UNIQUE` constraint on `order_number` and causing a 500 error.  
**Fix:** Use `DB::select('SELECT MAX(id) as max_id FROM chassis_orders FOR UPDATE')` inside a transaction, or use a dedicated auto-increment sequence column.

---

### 1.7 — Dead Stripe Test Code in Production `DashboardController`
**File:** `app/Http/Controllers/DashboardController.php` — lines 256–282  
**Severity:** 🔴 CRITICAL

```php
public function stripe(Request $request)
{
    $price = 100;
    $orderID = strtoupper(str_replace('.', '', uniqid('', true)));
    if ($price > 0.0) {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        // Creates a real charge with hardcoded test data...
    }
    // No return statement — function returns null
}
```

This method charges hardcoded `$100` with no CSRF protection, no actual route check, and returns `null`. It also hardcodes `"country" => "IN"` and fake address data.  
**Fix:** Remove this method entirely if unused. If needed for testing, protect it behind `APP_ENV !== 'production'`.

---

### 1.8 — `APP_DEBUG=true` in Production Environment
**File:** `.env` — line 4  
**Severity:** 🔴 CRITICAL

```
APP_DEBUG=true
APP_ENV=local
```

Debug mode is enabled, which causes Laravel to expose full stack traces, database queries, and environment variable contents to end users when any exception occurs.  
**Fix:** Set `APP_DEBUG=false` and `APP_ENV=production` before any production deployment.

---

## 2. UI/UX Issues

---

### 2.1 — Dashboard Greeting Hardcoded in English
**File:** `resources/views/home.blade.php` — lines 29–35  
**Severity:** 🟡 MEDIUM

```javascript
if (curHr < 12) {
    target.innerHTML = "Good Morning,";  // Not using __() for translation
}
```

Greeting messages are not translated. The app supports multilingual use but the greeting always shows in English.  
**Fix:** Pass translated strings from Blade to JavaScript: `@json(__('Good Morning,'))`.

---

### 2.2 — Default Timezone Hardcoded to `Asia/Kolkata`
**File:** `resources/views/home.blade.php` — line 21  
**Severity:** 🟡 MEDIUM

```javascript
var timezone = '{{ !empty($setting['timezone']) ? $setting['timezone'] : 'Asia/Kolkata' }}';
```

The fallback timezone is `Asia/Kolkata` — unrelated to this application's Moroccan context.  
**Fix:** Change fallback to `'Africa/Casablanca'` or `'UTC'`.

---

### 2.3 — Breadcrumb Uses Untranslatable Hardcoded French
**File:** `resources/views/chassis_orders/index.blade.php` — line 4  
**Severity:** 🟡 MEDIUM

```blade
<li class="breadcrumb-item"><a href="...">{{ __('Maison') }}</a></li>
```

`'Maison'` is French but it's passed to `__()` without an English default, so it won't translate to other languages correctly.  
**Fix:** Use `{{ __('Home') }}` consistently to match all other views.

---

### 2.4 — QR Code Container Has Fixed 220px — Breaks on Small Screens
**File:** `resources/views/home.blade.php` — line 206 · `public/custom/css/custom.css` — lines 1596–1611  
**Severity:** 🟡 MEDIUM

The QR code SVG is fixed to `max-width: 220px` with no fluid scaling below 220px. On very small viewports (< 320px) it overflows.  
**Fix:** Add `max-width: min(220px, 100%)` or use `vw` units.

---

### 2.5 — Chassis Orders Table Has No Search or Pagination
**File:** `resources/views/chassis_orders/index.blade.php`  
**Severity:** 🟡 MEDIUM

All chassis orders are loaded in a single query with no pagination, no search box, and no per-page limit. With large data this causes slow page loads and unusable scrolling.  
**Fix:** Add server-side pagination (`->paginate(25)`) and a search input filtering by `order_number`, `customer_name`, or `customer_phone`.

---

### 2.6 — Brand Index Has No Pagination
**File:** `app/Http/Controllers/BrandController.php` — line 17  
**Severity:** 🟡 MEDIUM

```php
$brands = Brand::with(['categories.variants.chassisNumbers'])->get();
```

This loads the entire brands dataset (with all nested relationships) into memory. With hundreds of brands + variants + chassis numbers, this will time out.  
**Fix:** Use `->paginate(20)` and lazy-load nested data via AJAX (already partially implemented).

---

### 2.7 — "Edit Plan" Popup Opens Full Plan Edit Form in an Ajax Modal
**File:** `resources/views/admin_store/index.blade.php` — line 136  
**Severity:** 🟡 MEDIUM

The new "Edit Plan" button opens the full plan form (with duration, trial days, ChatGPT toggles, etc.) in a small modal, which may be overwhelming and confusing for a super admin who only wants to change `max_stores`.  
**Recommendation:** Create a dedicated "quick edit" modal that only exposes `max_stores`, `max_products`, and `max_users` for faster editing from the stores list.

---

## 3. Functional Bugs

---

### 3.1 — `User::priceFormat()` Shows Position String Instead of Symbol
**File:** `app/Models/User.php` — lines 262–267  
**Severity:** 🟠 HIGH

```php
return (($settings['currency_symbol_position'] == "pre") ? $settings['currency_symbol_position'] : '')
    . number_format(...)
    . (($settings['currency_symbol_position'] == "post") ? $settings['currency_symbol_position'] : '');
```

The ternary returns the **string `"pre"`** or `"post"` instead of `$settings['currency_symbol']`. Prices display as `"pre100.00"` or `"100.00post"`.  
**Fix:** Replace both occurrences of `$settings['currency_symbol_position']` in the ternary **result** with `$settings['currency_symbol']`.

---

### 3.2 — `Plan::most_purchese_plan()` Fails Due to Case Mismatch
**File:** `app/Models/Plan.php` — line 61  
**Severity:** 🟠 HIGH

```php
->where('type', '=', 'owner')   // ← lowercase 'owner'
```

User types are stored as `'Owner'` (PascalCase) but the query filters by `'owner'`. This returns 0 results and `most_purchese_plan()` always returns `null`.  
**Fix:** Change `'owner'` → `'Owner'`.

---

### 3.3 — `OrderController::create()` and `store()` Are Empty Stubs
**File:** `app/Http/Controllers/OrderController.php` — lines 55–70  
**Severity:** 🟠 HIGH

Both `create()` and `store()` methods contain only `//` comments. Any user who accesses `GET /orders/create` or `POST /orders` gets a blank response or error.  
**Fix:** Either implement these methods or remove the routes and redirect to an informational page.

---

### 3.4 — `DashboardController::check()` is an Empty Exposed Method
**File:** `app/Http/Controllers/DashboardController.php` — lines 283–286  
**Severity:** 🟠 HIGH

```php
public function check()
{
    // empty
}
```

This public method is reachable and returns `null` (an empty 200 response). If a route points to it, it silently fails.  
**Fix:** Remove the method or implement its intended functionality.

---

### 3.5 — Email Configuration Broken — All Emails Will Fail Silently
**File:** `.env` — lines 24–29  
**Severity:** 🟠 HIGH

```
MAIL_HOST=smtp.mailtrap.io
MAIL_USERNAME=null
MAIL_PASSWORD=null
```

All SMTP credentials are `null` (string `"null"`, not empty). Emails (order confirmations, store creation notifications, password resets) will silently fail or throw exceptions caught by try-catch blocks that hide the error.  
**Fix:** Configure valid SMTP credentials or use a mail service like Mailgun, Amazon SES, or Postmark.

---

### 3.6 — `ChassisOrderController::reject()` May Violate Unique Chassis Constraint
**File:** `app/Http/Controllers/ChassisOrderController.php` — lines 243–249  
**Severity:** 🟠 HIGH

When rejecting an order, chassis numbers are **recreated** in the `chassis_numbers` table:

```php
$chassis = ChassisNumber::create([
    'chassis_number' => $item->chassis_number,
    ...
]);
```

The `chassis_numbers.chassis_number` column has a `UNIQUE` constraint (migration). If the order is rejected twice, or if the chassis was somehow manually re-added to stock, this will throw a `QueryException: Duplicate entry`.  
**Fix:** Use `ChassisNumber::firstOrCreate()` or check for existence before recreating.

---

### 3.7 — `DashboardController` Null Pointer if `$plan` is `null`
**File:** `app/Http/Controllers/DashboardController.php` — lines 160–167  
**Severity:** 🟠 HIGH

```php
$plan = Plan::find($users->plan);
if($plan->storage_limit > 0)  // ← fatal if $plan is null
```

If the Owner has `plan = 0` or a deleted plan ID, `Plan::find()` returns `null` and `$plan->storage_limit` throws a fatal error, crashing the dashboard.  
**Fix:** Add a null check: `if($plan && $plan->storage_limit > 0)`.

---

### 3.8 — `assignPlan()` Uses `Auth::user()` on the Wrong Context
**File:** `app/Models/User.php` — lines 120–122  
**Severity:** 🟠 HIGH

```php
$users    = User::where('created_by', '=', \Auth::user()->creatorId())->...
$products = Product::where('created_by', '=', \Auth::user()->creatorId())->...
$stores   = Store::where('created_by', '=', \Auth::user()->creatorId())->...
```

`assignPlan()` is an instance method on a `User` object, but it queries based on `Auth::user()` (the **currently logged in** user), not on `$this` (the user being assigned a plan). If a super admin assigns a plan to a different Owner, the active/inactive logic applies to the **wrong user's** stores and products.  
**Fix:** Replace `\Auth::user()->creatorId()` with `$this->creatorId()`.

---

## 4. Performance Issues

---

### 4.1 — `analyzeAllStock()` Loads Entire Database into Memory
**File:** `app/Http/Controllers/BrandController.php` — lines 482–573  
**Severity:** 🔴 CRITICAL PERFORMANCE

```php
$allChassis = \App\Models\ChassisNumber::with('variant.category.brand')->get();  // Loads ALL chassis
$allVariants = \App\Models\ProductVariant::all();                                  // Loads ALL variants
```

This route loads every single chassis number with 3 levels of eager loading, then performs all aggregations in PHP. With 10,000 chassis numbers, this would load thousands of rows and all relationships — causing memory exhaustion and timeouts.  
**Fix:** Aggregate at the database level with `DB::table('chassis_numbers')->selectRaw('location, COUNT(*) as count')->groupBy('location')->get()`.

---

### 4.2 — `BrandController::index()` Loads All Brands with All Nested Relations
**File:** `app/Http/Controllers/BrandController.php` — line 17  
**Severity:** 🟠 HIGH PERFORMANCE

```php
$brands = Brand::with(['categories.variants.chassisNumbers'])->get();
```

This executes 4 nested eager loads on the entire dataset with no `LIMIT` clause. For a dealership with 20+ brands × 5 models × 10 families × 500 chassis numbers = **100,000+ rows** loaded on every page visit.  
**Fix:** Paginate, and load nested data lazily via the already-implemented AJAX endpoints (`/brands/{id}/models`, etc.).

---

### 4.3 — Dashboard Order Loop Processes in PHP Instead of SQL
**File:** `app/Http/Controllers/DashboardController.php` — lines 138–158  
**Severity:** 🟡 MEDIUM PERFORMANCE

```php
$orders = Order::where('user_id', $store->current_store)->get();
foreach ($orders as $order) {
    $order_array = json_decode($order->product);
    foreach ($order_array as $key => $item) { ... }
    $totle_sale += $order['price'];
}
```

All orders are fetched to compute `$totle_sale` — a SUM that can be done in a single SQL query: `Order::where('user_id', $store->current_store)->sum('price')`. Loading all orders to sum their prices is an O(n) PHP loop that should be a single SQL aggregate.  
**Fix:** Replace with `$totle_sale = Order::where('user_id', $store->current_store)->sum('price')`.

---

### 4.4 — `getBrandStats()` API Called via AJAX on Every Brand Page Load
**File:** `app/Http/Controllers/BrandController.php` — lines 146–184 · `resources/views/brand/index.blade.php`  
**Severity:** 🟡 MEDIUM PERFORMANCE

The brand index page fires an AJAX request to `/api/brand/stats` on every load. This endpoint runs nested PHP loops with `sum()` callbacks over all brands/categories/variants/chassis. Add HTTP response caching (`Cache::remember`) or move stats calculation to a background job.

---

### 4.5 — `Utility::settings()` Static Cache Causes Stale Data
**File:** `app/Models/Utility.php` — lines 57–78  
**Severity:** 🟡 MEDIUM PERFORMANCE

```php
private static $settings = null;
private static $fetchsettings = null;
```

Settings are statically cached after first load. In CLI artisan commands or queue workers that process multiple users, this causes settings from the first user to be applied to all subsequent operations in the same process.  
**Fix:** Use `Cache::remember()` with a user-specific key, or flush the static cache when switching store contexts.

---

## 5. Code Quality Problems

---

### 5.1 — God Classes: Utility, StoreController, SettingController, PaymentController
**Severity:** 🟠 HIGH

| File | Size |
|------|------|
| `app/Models/Utility.php` | **126,021 bytes** (~2,800+ lines) |
| `app/Http/Controllers/StoreController.php` | **212,729 bytes** |
| `app/Http/Controllers/PaymentController.php` | **162,630 bytes** |
| `app/Http/Controllers/SettingController.php` | **101,934 bytes** |

These files violate the Single Responsibility Principle and are impossible to test, maintain, or safely modify. `Utility.php` contains methods for: email, file upload, storage, settings, date formatting, QR codes, language, payment settings, and more.  
**Fix:** Extract into dedicated service classes: `FileUploadService`, `MailService`, `SettingsService`, `StorageService`.

---

### 5.2 — Duplicate Route Groups in `web.php`
**File:** `routes/web.php` — lines 201–215, 231–238  
**Severity:** 🟡 MEDIUM

The `change-language` route group is **defined three times**:
- Lines 201–215 (middleware `['auth']`)
- Lines 208–215 (middleware `['auth', 'XSS']`)
- Lines 231–238 (identical to the second)

This creates redundant route registrations. Laravel will use the last registered route if names conflict.  
**Fix:** Remove duplicate route groups and keep a single `change-language` registration.

---

### 5.3 — PHPUnit Test Class Imported in Production Controller
**File:** `app/Http/Controllers/DashboardController.php` — line 17  
**Severity:** 🟡 MEDIUM

```php
use PHPUnit\Framework\Constraint\Count;
```

A PHPUnit class is imported in a production controller. It is never used, but it pollutes the production namespace and signals that test code was accidentally left in.  
**Fix:** Remove the unused import.

---

### 5.4 — Method Naming Typos
**File:** `app/Models/Plan.php` — line 53  
**Severity:** 🟡 MEDIUM

```php
public static function most_purchese_plan()  // ← "purchese" should be "purchase"
```

**Fix:** Rename to `most_purchase_plan()` and update all call sites.

---

### 5.5 — Mixed Auth Facade Usage
**Severity:** 🟡 LOW  
The codebase mixes `\Auth::user()` (with backslash) and `Auth::user()` (with `use` import) inconsistently across controllers. This is a style inconsistency that makes the code harder to read.  
**Fix:** Standardize to `Auth::user()` with a `use Illuminate\Support\Facades\Auth;` import in every file.

---

### 5.6 — Dead/Commented Code Blocks
**Files:** Throughout `routes/web.php`, `DashboardController.php`, `User.php`  
**Severity:** 🟡 LOW

Large blocks of commented-out code (routes, domain logic, store switching) clutter the codebase:
- `routes/web.php` lines 82–100: Large commented domain check block
- `DashboardController.php` lines 109–116: Commented subscription/login code
- `User.php` lines 113–117: Commented plan expiry else block

**Fix:** Remove dead code. Use version control (Git) to preserve history instead of keeping commented code.

---

### 5.7 — `ProductVariant::$fillable` Contains Timestamp Fields
**File:** `app/Models/ProductVariant.php` — lines 20–21  
**Severity:** 🟡 LOW

```php
'created_at',
'updated_at',
```

Timestamp fields should never be in `$fillable`. This allows external input to forge creation/update timestamps.  
**Fix:** Remove `created_at` and `updated_at` from `$fillable`.

---

## 6. Security Concerns

---

### 6.1 — Development Files Committed to Repository Root
**Severity:** 🔴 CRITICAL

The following sensitive/development files exist in the project root and should never be in version control or accessible on a public server:

| File | Risk |
|------|------|
| `mobinardopos.sql` (250KB) | **Full database dump** — contains all user data, hashed passwords, business data |
| `make_moto_svgs.php` (57KB) | Dev utility script — executable via web server |
| `verification.php` (5.3KB) | Unknown purpose — potentially bypasses auth |
| `sconfig-test.php` (3.9KB) | Test configuration — may expose credentials |
| `error_log` | PHP error log — exposes stack traces and internal paths |
| `redamd.md` (9KB) | Developer notes — may contain internal information |

**Fix:** Add all these to `.gitignore`, remove from repository with `git rm --cached`, and delete from the server.

---

### 6.2 — `APP_URL` Set to Local Network IP
**File:** `.env` — line 6  
**Severity:** 🟠 HIGH

```
APP_URL=http://192.168.1.69:8000
```

`APP_URL` is set to a local network IP. In production, this causes all generated URLs, QR codes, store links, email links, and asset paths to point to a non-resolvable address.  
**Fix:** Set `APP_URL` to the actual public domain: `https://gestion.mobi-nardo.com`.

---

### 6.3 — `env()` Called Directly Inside Controllers
**File:** `app/Http/Controllers/DashboardController.php` — line 128  
**Severity:** 🟠 HIGH

```php
$app_url = rtrim(env('APP_URL'), '/');
```

`env()` should never be called directly in production code — it returns `null` after `config:cache` is run. This causes store URLs to break after caching configuration.  
**Fix:** Use `config('app.url')` instead of `env('APP_URL')`.

---

### 6.4 — CSRF Exemptions Include Broad Wildcard Patterns
**File:** `app/Http/Middleware/VerifyCsrfToken.php`  
**Severity:** 🟠 HIGH

```php
'*/order-pay-with-paymentwall',
'/aamarpay*',
```

Wildcard CSRF exemptions can accidentally exclude more routes than intended. `'/aamarpay*'` exempts any route starting with `/aamarpay`, including any future routes.  
**Fix:** Use only explicit, specific path exemptions.

---

### 6.5 — No Rate Limiting on Authentication or API Routes
**Severity:** 🟠 HIGH

There is no visible rate limiting configuration on:
- `POST /login` — brute-force attack vector
- `POST /chassis-orders` — order creation flooding
- `/api/brand/stats` — query flooding

Laravel's built-in `throttle` middleware should be applied.  
**Fix:** Apply `->middleware('throttle:5,1')` on authentication routes and `->middleware('throttle:60,1')` on API routes.

---

### 6.6 — Authorization Logic Uses Inconsistent `type` Checks
**Severity:** 🟠 HIGH

Permission checks mix `Auth::user()->type !== 'Owner'` with `@can()` Blade directives and `$user->can()` checks inconsistently:

```php
// In BrandController — checks type AND permission with OR:
if (\Auth::user()->type !== 'Owner' && !\Auth::user()->can('Manage Brands') && ...)

// In ChassisOrderController — checks type OR permission:
if (Auth::user()->type !== 'Owner' && !Auth::user()->can('Manage Orders'))
```

The logic `type !== 'Owner' AND NOT can(X)` means **"only block if BOTH conditions are true"** — i.e., non-Owners who lack permission are blocked, but Owners are always allowed regardless of permissions. This is correct for some cases but not others.  
**Recommendation:** Standardize all permission checks through Spatie's `@can()` / `$user->can()` system. Apply Owner-level permissions to the Owner role explicitly rather than bypassing the permission system.

---

## 7. Responsive Design Problems

---

### 7.1 — Chassis Orders Table Overflows on Mobile
**File:** `resources/views/chassis_orders/index.blade.php`  
**Severity:** 🟡 MEDIUM

The orders table has columns: N°, Client, Téléphone, Doc, Montant, TVA, Date, Statut, Actions — 9 columns. On screens < 768px, this table requires horizontal scrolling with no visual indicator.  
**Fix:** Implement a responsive card layout for mobile using `d-md-table-cell d-none` on non-essential columns, or use a card list view on mobile.

---

### 7.2 — Brand Index Card Grid Uses `min-width: 300px` — Breaks on Small Screens
**File:** `resources/views/brand/index.blade.php`  
**Severity:** 🟡 MEDIUM

Brand cards use a CSS grid with `repeat(auto-fill, minmax(300px, 1fr))`. On screens 320–599px wide, only a single 300px card fits, creating tight margins.  
**Fix:** Reduce to `minmax(250px, 1fr)` or add a single-column fallback below `576px`.

---

### 7.3 — Action Buttons in Admin Store Table Overflow on Mobile
**File:** `resources/views/admin_store/index.blade.php` — lines 81–161  
**Severity:** 🟡 MEDIUM

The store index action column now has 9 buttons (Owner Info, Login, Store Links, Login Enable, Upgrade Plan, **Edit Plan**, Reset Password, Edit, Delete). On tablets, these wrap to multiple lines.  
**Fix:** Move action buttons to a dropdown `<div class="dropdown">` pattern to keep the row compact.

---

### 7.4 — Dashboard QR Card Fixed Height May Clip on Short Displays
**File:** `resources/views/home.blade.php` · `public/custom/css/custom.css`  
**Severity:** 🟡 LOW

The `qr-card` uses `h-100` (full height) in a flex row. On laptops with < 768px height, the QR card can be clipped or overflow.  
**Fix:** Add `min-height` and ensure the card degrades gracefully on smaller displays.

---

## 8. Missing Features

---

### 8.1 — No Export for Chassis Orders
**Severity:** 🟡 MEDIUM

The standard `Order` module has an export feature (`order/export`). Chassis orders (`/chassis-orders`) have no export to Excel/PDF functionality. Management needs to be able to export order lists for accounting.

---

### 8.2 — No Audit Log for Order Status Changes
**Severity:** 🟡 MEDIUM

When a chassis order is validated or rejected, no audit trail is recorded. Only the final `status` field is updated. For a financial/inventory system, every state change should be logged with: who changed it, when, from what status, to what status.

---

### 8.3 — No Stock Movement History
**Severity:** 🟡 MEDIUM

When a chassis number is deleted from stock (on sale), recreated (on rejection), or edited, there is no movement history table. You cannot trace the life cycle of a specific chassis number.

---

### 8.4 — No Email Notification on Chassis Order Validation/Rejection
**Severity:** 🟡 MEDIUM

When a chassis order is validated or rejected by a manager, no notification is sent to the creator of the order. The `OrderController` has email templates but `ChassisOrderController` has no email integration.

---

### 8.5 — `OrderController::create()` and `store()` Return No Content
**File:** `app/Http/Controllers/OrderController.php` — lines 55–70  
**Severity:** 🟠 HIGH

Standard store orders cannot be created from the admin panel — both methods are empty stubs. This appears to be an original template feature that was never implemented.

---

### 8.6 — No Pagination on Any Admin List With Potentially Large Data
- `Brand::with(...)->get()` — no limit
- `ChassisOrder::get()` — no limit
- `Order::get()` — no limit in dashboard
- `User::get()` — no limit in some views

---

## 9. Recommendations

---

### 9.1 — Immediate Security Hardening (Week 1)
1. Set `APP_DEBUG=false` and `APP_ENV=production` in `.env`
2. Set `APP_URL=https://gestion.mobi-nardo.com` (real domain)
3. Delete committed sensitive files: `mobinardopos.sql`, `make_moto_svgs.php`, `verification.php`, `sconfig-test.php`, `error_log`
4. Re-enable XSS sanitization in `XSS.php` middleware
5. Fix `APP_URL` references in controllers to use `config('app.url')`

### 9.2 — Critical Bug Fixes (Week 1–2)
1. Fix `User::$fillable` typo: `currant_store` → `current_store`
2. Fix semicolon bug in `User::assignPlan()` (line 98)
3. Add `'Show Orders'` permission to the migration
4. Fix `User::priceFormat()` — return `$settings['currency_symbol']` not the position string
5. Fix `Plan::most_purchese_plan()` — change `'owner'` to `'Owner'`
6. Add null check for `$plan` in `DashboardController::index()`
7. Fix `ChassisOrder::generateOrderNumber()` race condition
8. Fix `assignPlan()` to use `$this->creatorId()` not `Auth::user()->creatorId()`

### 9.3 — Architecture Refactoring (Month 1–2)
1. Extract `Utility.php` into service classes: `FileService`, `MailService`, `SettingsService`
2. Break `StoreController.php` into `StoreManagementController`, `StoreFrontController`, `StoreThemeController`
3. Add `store_id` to the `Brand` model and enforce multi-tenancy isolation
4. Remove duplicate route registrations in `web.php`
5. Remove dead code and PHPUnit imports from production files

### 9.4 — Performance (Month 1–2)
1. Add pagination to all admin list views (brands, orders, chassis)
2. Replace PHP aggregation loops with SQL aggregates (`SUM`, `COUNT`, `GROUP BY`)
3. Add `Cache::remember()` for settings and stats endpoints
4. Add database indexes on `chassis_orders.store_id`, `brands.store_id`, `chassis_numbers.variant_id`

### 9.5 — Missing Features (Month 2–3)
1. Chassis orders export (Excel/PDF)
2. Audit log for order status changes
3. Email notifications on order validation/rejection
4. Stock movement history
5. Add `'Show Orders'` permission to UI role assignment
6. Rate limiting on auth and API routes

---

## 10. Final Score

| Category | Score | Notes |
|----------|-------|-------|
| **UI/UX** | 6/10 | Good visual design (Tabler), responsive issues on mobile, untranslated strings |
| **Performance** | 4/10 | Critical N+1 queries, full-table loads, no pagination, no caching |
| **Maintainability** | 3/10 | God classes, typos, dead code, 200KB+ controllers |
| **Scalability** | 3/10 | No multi-tenancy on brands, no pagination, memory-intensive queries |
| **Security** | 3/10 | XSS disabled, debug=true, DB dump in repo, dev files exposed |
| **Overall Quality** | 4/10 | Functional for single-tenant low-volume use; needs hardening before scaling |

---

## Summary of Most Urgent Fixes

| Priority | Issue | File | Fix Time |
|----------|-------|------|----------|
| P0 | `APP_DEBUG=true` exposed | `.env` | 5 min |
| P0 | XSS sanitization disabled | `XSS.php` | 5 min |
| P0 | DB dump + dev scripts in repo | root | 10 min |
| P0 | `currant_store` typo in User | `User.php:29` | 5 min |
| P0 | Semicolon bug in `assignPlan()` | `User.php:98` | 5 min |
| P1 | `'Show Orders'` permission missing | Migration | 15 min |
| P1 | `priceFormat()` shows wrong value | `User.php:265` | 10 min |
| P1 | `Plan::most_purchese_plan()` case | `Plan.php:61` | 5 min |
| P1 | Null crash on missing plan | `DashboardController:161` | 5 min |
| P1 | Race condition order number | `ChassisOrder.php:47` | 30 min |
| P1 | Brand no store isolation | `Brand.php` + migration | 2 hours |
| P2 | Remove dead Stripe test code | `DashboardController:256` | 5 min |
| P2 | Pagination on brand/order lists | Controllers + views | 4 hours |
| P2 | `APP_URL` uses local IP | `.env` | 5 min |
| P2 | Extract god classes | All large controllers | 1–2 weeks |

---

## Suggested Implementation Priority Roadmap

### Sprint 1 — Security & Stability (Week 1)
- [ ] Fix all P0 items (ENV, XSS, repo cleanup, typos, semicolon bug)
- [ ] Fix P1 permission and null-check bugs
- [ ] Configure mail SMTP properly
- [ ] Fix `priceFormat()` and `most_purchese_plan()` bugs

### Sprint 2 — Data Integrity & Multi-tenancy (Week 2–3)
- [ ] Add `store_id` to `Brand` + update all brand queries
- [ ] Fix `assignPlan()` to use `$this->creatorId()`
- [ ] Fix race condition in `generateOrderNumber()`
- [ ] Fix chassis rejection unique constraint
- [ ] Remove duplicate route groups
- [ ] Remove dead code and PHPUnit imports

### Sprint 3 — Performance (Week 3–4)
- [ ] Add pagination to brands, orders, chassis
- [ ] Replace PHP loops with SQL aggregates in dashboard
- [ ] Cache brand stats with TTL
- [ ] Optimize `analyzeAllStock()` with DB aggregates
- [ ] Add missing DB indexes

### Sprint 4 — Features & UX (Month 2)
- [ ] Chassis orders export (Excel)
- [ ] Audit log for order state changes
- [ ] Email notifications for order events
- [ ] Mobile-responsive orders table (card layout)
- [ ] Action button dropdown on store list
- [ ] Fix hardcoded English greetings and timezone

### Sprint 5 — Architecture (Month 2–3)
- [ ] Extract `Utility.php` into service classes
- [ ] Break up `StoreController.php`
- [ ] Standardize permission checks through Spatie roles
- [ ] Add rate limiting to auth and API routes
- [ ] Unit tests for critical business logic (order creation, plan limits, stock management)
