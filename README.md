<div align="center">

# Shadcn Admin UI for Sylius Stack

**Tailwind CSS v4 + shadcn/ui admin theme for [Sylius Stack](https://stack.sylius.com)**<br>
A drop-in alternative to `sylius/bootstrap-admin-ui`: same hooks, same macros, a modern look.

[![CI](https://github.com/rem42/shadcn-admin-ui/actions/workflows/ci.yml/badge.svg)](https://github.com/rem42/shadcn-admin-ui/actions/workflows/ci.yml)
[![Packagist](https://img.shields.io/packagist/v/rem42/shadcn-admin-ui.svg)](https://packagist.org/packages/rem42/shadcn-admin-ui)
![PHP](https://img.shields.io/badge/PHP-8.4%2B-777bb4.svg)
![Symfony](https://img.shields.io/badge/Symfony-7.4%20%7C%208.x-000.svg)
[![License](https://img.shields.io/badge/license-MIT-green.svg)](LICENSE)

[Installation](docs/installation.md) ·
[Configuration](docs/configuration.md) ·
[Theming](docs/theming.md) ·
[Grids](docs/grids.md) ·
[Menu](docs/menu.md) ·
[Components](docs/components.md) ·
[Migration](docs/migration.md)

</div>

---

## Why this theme?

|     | Feature                     | Details                                                                                                  |
|-----|-----------------------------|----------------------------------------------------------------------------------------------------------|
| 🔁  | **Drop-in replacement**     | Same hook and hookable names as BootstrapAdminUi: your `sylius_twig_hooks` customisations keep working.   |
| 🧩  | **Same macro APIs**         | `button`, `breadcrumbs`, `header`, `table`, `pagination`, `dropdown`…: just change the namespace.         |
| 🧭  | **shadcn sidebar**          | Collapsible to icons, <kbd>Ctrl</kbd>/<kbd>⌘</kbd> + <kbd>B</kbd>, state kept in a cookie, drawer on mobile, 3 variants. |
| 📊  | **Grids**                   | Sorting, filters, pagination, selection + bulk delete, card layout on mobile.          |
| 🎨  | **shadcn tokens**           | Paste a theme from [ui.shadcn.com/themes](https://ui.shadcn.com/themes) or [tweakcn](https://tweakcn.com). Dark mode included. |
| 📦  | **100% AssetMapper**        | No Node, no Webpack: Tailwind runs through `symfonycasts/tailwind-bundle`.                               |

## Quick start

> [!IMPORTANT]
> `sylius/bootstrap-admin-ui` can be installed alongside, but never enable both bundles in the same kernel.

```bash
composer require rem42/shadcn-admin-ui
```

```yaml
# config/packages/rem42_shadcn_admin_ui.yaml
imports:
    - { resource: '@Rem42ShadcnAdminUiBundle/config/app.php' }
```

```css
/* assets/styles/admin.css */
@import "tailwindcss";
@import "../../vendor/rem42/shadcn-admin-ui/assets/styles/theme.css";
```

```bash
php bin/console tailwind:build assets/styles/admin.css --watch
```

Then follow the [installation guide](docs/installation.md) for the JavaScript entrypoint, icons and
UX Autocomplete.

## Requirements

| Package                                                         | Version                                                     |
|-----------------------------------------------------------------|-------------------------------------------------------------|
| PHP                                                             | 8.4+                                                        |
| Symfony                                                         | 7.4 LTS or 8.x                                              |
| Sylius Stack (`sylius/admin-ui`, `twig-hooks`, `twig-extra`)    | 0.14                                                        |
| Symfony UX (`ux-twig-component`, `stimulus-bundle`, `ux-icons`) | 3.5+ (required by the shadcn kit: `provide()` / `inject()`) |
| `symfonycasts/tailwind-bundle`                                  | 1.x (Tailwind CSS v4)                                       |

## Documentation

| Guide                                         | You will learn to…                                                                 |
|-----------------------------------------------|------------------------------------------------------------------------------------|
| 📥 [Installation](docs/installation.md)       | Install the bundle, build the stylesheet, wire the entrypoint, icons, Autocomplete |
| ⚙️ [Configuration](docs/configuration.md)     | Configure the bundle: sidebar variant, branding, paths      |
| 🎨 [Theming](docs/theming.md)                 | Change colors, radius and font, use the tone palette, dark mode                    |
| 📊 [Grids](docs/grids.md)                     | Tune columns, mobile cards                      |
| 🧭 [Menu](docs/menu.md)                       | Build the sidebar menu: sections, collapsible items, headers, external links       |
| 🧩 [Components](docs/components.md)           | Use shadcn components, Sylius components, macros, Stimulus controllers, form theme |
| 🔀 [Migration](docs/migration.md)             | Move an existing project from BootstrapAdminUi                                     |
| 🛠️ [Contributing](docs/contributing.md)       | Run the demo application, the tests, and update the shadcn recipes                 |

## Try the demo

```bash
git clone git@github.com:rem42/shadcn-admin-ui.git && cd shadcn-admin-ui
composer install
make up    # http://localhost:8080/admin  (admin / admin)
```

A book CRUD with filters, quick filters, bulk delete, forms and a dashboard, on SQLite.
See [Contributing](docs/contributing.md).

## License

MIT. Includes the shadcn kit recipes from Symfony UX Toolkit (MIT), `tw-animate-css` (MIT) and
`shadcn/tailwind.css` (MIT).
