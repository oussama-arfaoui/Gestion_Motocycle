# Dernières Modifications - Gestion Motocycle

## 2. Permission "Validate Orders" pour la validation des commandes

### Problème
L'utilisateur pouvait voir et cliquer le bouton vert de validation des commandes même sans la permission appropriée.

### Fichiers modifiés

#### `resources/views/roles/create.blade.php`
- **Ligne 56** : Ajout de `'Validate'` au tableau des permissions du module `Orders`
```php
'Orders' => ['Manage', 'Show', 'Delete', 'Validate'],
```

#### `resources/views/roles/edit.blade.php`
- **Ligne 56** : Ajout de `'Validate'` au tableau des permissions du module `Orders`
```php
'Orders' => ['Manage', 'Show', 'Delete', 'Validate'],
```

#### `resources/views/chassis_orders/index.blade.php`
- **Ligne 349** : Restriction stricte de la condition pour afficher les boutons Valider/Rejeter
  - **Avant** : `@if(\Auth::user()->type == 'Owner' || \Auth::user()->can('Manage Orders') || \Auth::user()->can('Validate Orders'))`
  - **Après** : `@if(\Auth::user()->can('Validate Orders'))`

### Base de données
- Création de la permission `"Validate Orders"` (guard: web) via script PHP
- Attribution de cette permission au rôle `Owner`

---

## 1. Correction du menu admin (affichage grisé au lieu de caché)

### Problème
Les éléments du menu admin étaient complètement cachés si l'utilisateur n'avait pas la permission. L'utilisateur voulait qu'ils soient visibles mais grisés.

### Fichiers modifiés

#### `resources/views/partials/admin/menu.blade.php`
- Remplacement des conditions PHP personnalisées par les directives Blade natives `@canany`, `@can`, `@else`, `@endcan`
- Ajout de la classe `menu-disabled` pour les éléments sans permission
- Correction du menu **Store** : vérification avec `@canany` incluant `Create Products`, `Edit Products`, `Show Products`

#### `public/custom/css/custom.css`
- Ajout du style `.menu-disabled` :
```css
.menu-disabled > a {
    opacity: 0.4;
    pointer-events: none;
    cursor: not-allowed;
}
```

#### `app/Http/Controllers/BrandController.php`
- Expansion des vérifications de permission dans toutes les méthodes CRUD (`index`, `create`, `store`, `edit`, `update`, `destroy`)
- Ajout des permissions `Create Products`, `Edit Products`, `Show Products`, `Delete Products` en plus de `Manage Brands`/`Manage Products`

---

## Corrections antérieures (helper.php)

### `app/helper.php`
- Correction de `getPlanMaxStores()` : traverse correctement la chaîne `created_by` pour trouver le super admin
- Correction de `canCreateStore()` : même logique de traversée + comptage correct des stores
- Correction de `getSuperAdminStoreCount()` : comptage des utilisateurs `Owner` créés par le super admin

### `resources/views/partials/store-limit-overlay.blade.php`
- Réactivation du JavaScript d'interception avec les fonctions helper corrigées
- Le modal d'upgrade s'affiche uniquement quand la limite est réellement atteinte

### `resources/views/admin_store/index.blade.php` & `resources/views/user/grid.blade.php`
- Suppression de la logique conditionnelle du bouton "Créer un magasin" dans la vue
- Le bouton s'affiche toujours ; la limitation est gérée par le JS overlay

---

**Commit Git :** `e84fb150` — *Add Validate Orders permission for order validation buttons*
