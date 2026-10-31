# 📥 Installation

[Docs](README.md) › Installation

- [Requirements](#requirements)
- [1. Composer](#1-composer)
- [2. Stylesheet (Tailwind)](#2-stylesheet-tailwind)
- [3. JavaScript entrypoint](#3-javascript-entrypoint)
- [4. Icons](#4-icons)
- [Optional: Symfony UX Autocomplete](#optional-symfony-ux-autocomplete)
- [Checklist](#checklist)

---

## Requirements

| Package                                                         | Version                                                     |
|-----------------------------------------------------------------|-------------------------------------------------------------|
| PHP                                                             | 8.4+                                                        |
| Symfony                                                         | 7.4 LTS or 8.x                                              |
| Sylius Stack (`sylius/admin-ui`, `twig-hooks`, `twig-extra`)    | 0.14                                                        |
| Symfony UX (`ux-twig-component`, `stimulus-bundle`, `ux-icons`) | 3.5+ (required by the shadcn kit: `provide()` / `inject()`) |
| `symfonycasts/tailwind-bundle`                                  | 1.x (Tailwind CSS v4)                                       |

Optional packages:

| Package                           | Enables                                     |
|-----------------------------------|---------------------------------------------|
| `pagerfanta/doctrine-orm-adapter` | Grids backed by Doctrine ORM                |
| `symfony/ux-autocomplete`         | Autocomplete fields |
| `symfony/ux-live-component`       | Live Component based forms                  |
| `symfony/workflow`                | The `apply_transition` grid action          |

## 1. Composer

> [!IMPORTANT]
> `sylius/bootstrap-admin-ui` can be installed alongside, but never enable both bundles in the same kernel.

```bash
composer require rem42/shadcn-admin-ui
composer require pagerfanta/doctrine-orm-adapter   # if your grids use Doctrine ORM
```

If Flex does not register the bundle, add it to `config/bundles.php`:

```php
Rem42\ShadcnAdminUi\Rem42ShadcnAdminUiBundle::class => ['all' => true],
```

Then import the theme configuration (hooks, grid templates, anonymous component prefixes), as with
`sylius/bootstrap-admin-ui`:

```yaml
# config/packages/rem42_shadcn_admin_ui.yaml
imports:
    - { resource: '@Rem42ShadcnAdminUiBundle/config/app.php' }
```

> [!NOTE]
> This import is loaded with your own configuration, so hook definitions loaded **after** it override the theme
> ones: further down this file, in a `config/packages/` file that comes after it, or in `config/services/`.

The bundle registers on its own:

- the AssetMapper path `@rem42/shadcn-admin-ui`;
- its Stimulus controllers (`shadcn--*` and `admin--*`), next to the ones of `assets/controllers`.

## 2. Stylesheet (Tailwind)

Create `assets/styles/admin.css`:

```css
@import "tailwindcss";
@import "../../vendor/rem42/shadcn-admin-ui/assets/styles/theme.css";

/* Your token overrides */
:root {
    /* --primary: oklch(0.55 0.2 260); */
    /* --radius: 0.5rem; */
}
```

Declare it in `config/packages/symfonycasts_tailwind.yaml`:

```yaml
symfonycasts_tailwind:
    binary_version: 'v4.3.3'
    input_css:
        - '%kernel.project_dir%/assets/styles/app.css'     # your front end, if any
        - '%kernel.project_dir%/assets/styles/admin.css'
```

Build it:

```bash
php bin/console tailwind:build assets/styles/admin.css --watch   # in dev
php bin/console tailwind:build assets/styles/admin.css --minify  # in prod, before asset-map:compile
```

> [!TIP]
> `theme.css` declares an `@source` on the bundle templates (Tailwind ignores `vendor/` by default). Your own
> templates are detected automatically: no extra configuration needed.

Another file name? See [Configuration › Stylesheet and entrypoint paths](configuration.md#stylesheet-and-entrypoint-paths).

## 3. JavaScript entrypoint

`assets/admin.js`:

```js
import './stimulus_bootstrap.js';
```

`importmap.php`:

```php
'admin' => ['path' => './assets/admin.js', 'entrypoint' => true],
```

## 4. Icons

The theme uses `lucide:*` icons through Symfony UX Icons.

> [!WARNING]
> In production, lock them locally, otherwise they are fetched from the Iconify API at runtime:
>
> ```bash
> php bin/console ux:icons:lock
> ```

## Optional: Symfony UX Autocomplete

`theme.css` draws Tom Select fields as a shadcn combobox and **fully replaces** the Tom Select stylesheet.

> [!IMPORTANT]
> Disable the automatic import of the Tom Select stylesheet in `assets/controllers.json`: it is not in a CSS layer,
> so it would win over the theme.

```json
"@symfony/ux-autocomplete": {
    "autocomplete": {
        "autoimport": {
            "tom-select/dist/css/tom-select.default.css": false,
            "tom-select/dist/css/tom-select.bootstrap4.css": false,
            "tom-select/dist/css/tom-select.bootstrap5.css": false
        }
    }
}
```

Searchable `entity` grid filters are provided by [rem42/sylius-admin-kit-bundle](https://github.com/rem42/sylius-admin-kit-bundle).

## Checklist

- [ ] `rem42/shadcn-admin-ui` installed, and only one of the two bundles enabled in the kernel
- [ ] `@Rem42ShadcnAdminUiBundle/config/app.php` imported
- [ ] `assets/styles/admin.css` created and listed in `symfonycasts_tailwind.input_css`
- [ ] `admin` entrypoint declared in `importmap.php`
- [ ] `tailwind:build --watch` running in dev
- [ ] `ux:icons:lock` run before deploying
- [ ] Tom Select stylesheets disabled (only with UX Autocomplete)

---

<table width="100%"><tr>
<td align="left">← <a href="README.md">Documentation</a></td>
<td align="right"><a href="configuration.md">Configuration</a> →</td>
</tr></table>
