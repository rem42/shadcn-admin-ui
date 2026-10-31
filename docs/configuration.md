# ⚙️ Configuration

[Docs](README.md) › Configuration

- [Configuration reference](#configuration-reference)
- [Branding: logo, name, title](#branding-logo-name-title)
- [Stylesheet and entrypoint paths](#stylesheet-and-entrypoint-paths)
- [Sidebar variant](#sidebar-variant)

---

## Configuration reference

Full default configuration of the bundle:

```yaml
# config/packages/rem42_shadcn_admin_ui.yaml
rem42_shadcn_admin_ui:
    sidebar:
        variant: sidebar            # sidebar | floating | inset
```

> [!TIP]
> `php bin/console config:dump-reference rem42_shadcn_admin_ui` prints this reference with every option documented.

## Branding: logo, name, title

```yaml
# config/packages/sylius_twig_hooks.yaml
sylius_twig_hooks:
    hooks:
        'sylius_admin.common.component.sidebar.logo':
            image:
                configuration:
                    name: 'Camalo'
                    subtitle: 'WMS'
                    icon: 'lucide:warehouse'   # or image: 'images/logo.svg'
        'sylius_admin.security.login.page.logo':
            image:
                configuration: { name: 'Camalo', icon: 'lucide:warehouse' }
        'sylius_admin.base#base_title':
            default:
                configuration: { title: 'Camalo' }
```

| Hook                                          | Hookable  | Options                                       |
|-----------------------------------------------|-----------|-----------------------------------------------|
| `sylius_admin.common.component.sidebar.logo`  | `image`   | `name`, `subtitle`, `icon` **or** `image`     |
| `sylius_admin.security.login.page.logo`       | `image`   | `name`, `icon` **or** `image`                 |
| `sylius_admin.base#base_title`                | `default` | `title` (browser tab)                         |

## Stylesheet and entrypoint paths

By default the layout loads `styles/admin.css` and the `admin` entrypoint. To use other names:

```yaml
sylius_twig_hooks:
    hooks:
        'sylius_admin.base#stylesheets':
            styles: { configuration: { path: 'styles/back-office.css' } }
        'sylius_admin.base#javascripts':
            javascripts: { configuration: { entrypoint: 'back-office' } }
```

## Sidebar variant

| Variant    | Look                                                                 |
|------------|----------------------------------------------------------------------|
| `sidebar`  | Default. Attached to the edge of the screen.                         |
| `floating` | Detached card with rounded corners and a shadow.                     |
| `inset`    | The page content becomes a rounded panel next to the sidebar.        |

Set it for every admin page:

```yaml
# config/packages/rem42_shadcn_admin_ui.yaml
rem42_shadcn_admin_ui:
    sidebar:
        variant: inset
```

The value is set on the `sidebar` hookable of every page hook that renders it (`index`, `show`, `create`,
`update`, `dashboard`), so it can still be overridden page by page:

```yaml
sylius_twig_hooks:
    hooks:
        'sylius_admin.common.show':
            sidebar:
                configuration: { variant: 'floating' }
```

> [!NOTE]
> Keyboard shortcut: <kbd>Ctrl</kbd>/<kbd>⌘</kbd> + <kbd>B</kbd> collapses the sidebar to icons. Its state is kept in a
> cookie; on mobile, the sidebar opens as a drawer.

Quick filter tabs, the environment indicator and searchable entity filters live in [rem42/sylius-admin-kit-bundle](https://github.com/rem42/sylius-admin-kit-bundle).

---

<table width="100%"><tr>
<td align="left">← <a href="installation.md">Installation</a></td>
<td align="right"><a href="theming.md">Theming</a> →</td>
</tr></table>
