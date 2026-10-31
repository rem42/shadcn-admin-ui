# 🧩 Components

[Docs](README.md) › Components

- [shadcn components](#shadcn-components)
- [Sylius components](#sylius-components)
- [Macros](#macros)
- [Tabs](#tabs)
- [Form theme](#form-theme)
- [Stimulus controllers](#stimulus-controllers)

---

## shadcn components

The shadcn kit recipes of Symfony UX Toolkit are bundled under the `shadcn:` prefix and usable in any template:

```twig
<twig:shadcn:Card>
    <twig:shadcn:Card:Header>
        <twig:shadcn:Card:Title>Stock</twig:shadcn:Card:Title>
    </twig:shadcn:Card:Header>
    <twig:shadcn:Card:Content>
        <twig:shadcn:Badge variant="secondary">42 parcels</twig:shadcn:Badge>
    </twig:shadcn:Card:Content>
</twig:shadcn:Card>
```

| Category      | Components                                                                                   |
|---------------|----------------------------------------------------------------------------------------------|
| Layout        | `Card`, `Separator`, `Sidebar`, `Item`, `Empty`, `Skeleton`                                  |
| Forms         | `Field`, `Input`, `InputGroup`, `Label`, `NativeSelect`, `Checkbox`, `RadioGroup`, `Switch`, `Textarea` |
| Actions       | `Button`, `DropdownMenu`, `Kbd`, `KbdGroup`                                                  |
| Overlays      | `Dialog`, `AlertDialog`, `Sheet`, `Tooltip`                                                  |
| Feedback      | `Alert`, `Badge`, `Spinner`                                                                  |
| Navigation    | `Breadcrumb`, `Pagination`, `Collapsible`                                                    |
| Data          | `Avatar`, `Table`                                                                            |

> [!TIP]
> The [shadcn kit documentation](https://ux.symfony.com/toolkit/kits/shadcn) describes the props and sub-components
> of each recipe.

## Sylius components

Same components as BootstrapAdminUi, under the `shadcn_admin_ui:` prefix.

| Component                            | Purpose                                         | Main props                                                        |
|--------------------------------------|-------------------------------------------------|-------------------------------------------------------------------|
| `shadcn_admin_ui:delete_modal`       | Delete button + confirmation dialog + CSRF form | `id`, `path`, `label`, `icon`, `icon_only`, `disabled`, `form_attr` |
| `shadcn_admin_ui:confirmation_modal` | Generic confirmation dialog                     | `modal_id`, `title`, `description`, `size`; blocks `trigger`, `footer` |
| `shadcn_admin_ui:copyable`           | Value followed by a copy button                 | `value`, `copy_label`, `copied_label`, `error_label`              |
| `shadcn_admin_ui:copy_to_clipboard`  | Copy button alone                               | `value`, `button_class`, `disabled`                               |
| `shadcn_admin_ui:badge`              | Colored badge                                   | `color`, `light`, `href`, `label`                                 |
| `shadcn_admin_ui:dot`                | Status dot                                      | `color`, `pulse`                                                  |

```twig
<twig:shadcn_admin_ui:badge color="success">Paid</twig:shadcn_admin_ui:badge>
<twig:shadcn_admin_ui:badge color="orange" :light="false" label="Late" />
<twig:shadcn_admin_ui:dot color="green" pulse />

<twig:shadcn_admin_ui:delete_modal id="{{ book.id }}" path="{{ path('app_admin_book_delete', {id: book.id}) }}" />
```

`color` accepts every name of the [tone palette](theming.md#the-tone-macro). The `pulse` halo is disabled when the
user prefers reduced motion.

## Macros

Same macro APIs as `@SyliusBootstrapAdminUi`: only the namespace changes.

| Template (`@Rem42ShadcnAdminUi/shared/helper/…`) | Macros                                                              |
|--------------------------------------------------|---------------------------------------------------------------------|
| `button.html.twig`                               | `default`, `primary`, `delete`, `create`, `update`, `cancel`        |
| `breadcrumbs.html.twig`                          | `breadcrumbs(items)`                                                |
| `header.html.twig`                               | `default(level, header, icon, subheader)`, `h1(header, icon, subheader)` |
| `dropdown.html.twig`                             | `default(params)`, `list(params, items)`, `item(attributes, content, variant)` |
| `table.html.twig`                                | `headers`, `row`                                                    |
| `pagination.html.twig`                           | `simple(paginator, options)`, `results_count(paginator)`            |
| `accordion.html.twig`                            | `accordion(items, open, auto_close, flush)`                         |
| `avatar.html.twig`                               | `default(img, class, initials)`, `small(img, class, initials)`      |
| `palette.html.twig`                              | [`tone(color, kind)`](theming.md#the-tone-macro)                    |

The button macros accept an extra `variant` param: `default`, `secondary`, `outline`, `ghost`, `destructive`, `link`.

```twig
{% import '@Rem42ShadcnAdminUi/shared/helper/button.html.twig' as button %}

{{ button.primary({text: 'Export', icon: 'lucide:download', url: path('app_export')}) }}
{{ button.default({text: 'Archive', variant: 'ghost', size: 'small'}) }}
```

## Tabs

Accessible tabs with the `admin--tabs` controller (`tab` and `panel` targets):

- keyboard navigation: arrows, <kbd>Home</kbd>, <kbd>End</kbd> (roving tabindex);
- the selected tab is kept in the URL hash;
- tabs holding a validation error are flagged and opened on submit.

```twig
<div data-controller="admin--tabs">
    <div role="tablist">
        <button type="button" role="tab" aria-controls="general" data-admin--tabs-target="tab"
                data-action="admin--tabs#select keydown->admin--tabs#keydown">General</button>
        <button type="button" role="tab" aria-controls="seo" data-admin--tabs-target="tab"
                data-action="admin--tabs#select keydown->admin--tabs#keydown">SEO</button>
    </div>
    <div id="general" role="tabpanel" data-admin--tabs-target="panel">…</div>
    <div id="seo" role="tabpanel" data-admin--tabs-target="panel">…</div>
</div>
```

## Form theme

The admin forms use the shadcn form theme. Use it anywhere:

```twig
{% form_theme form '@Rem42ShadcnAdminUi/shared/form_theme.html.twig' %}
```

Render a checkbox as a switch with `label_attr: {class: 'checkbox-switch'}` or `attr: {role: 'switch'}`:

```php
$builder->add('enabled', CheckboxType::class, ['attr' => ['role' => 'switch']]);
```

## Stimulus controllers

Registered automatically by the bundle.

| Identifier                                  | Role                                                             |
|---------------------------------------------|------------------------------------------------------------------|
| `admin--tabs`                               | Accessible tabs ([see above](#tabs))                             |
| `admin--grid-selection`                     | Row selection, "select all", bulk action forms                   |
| `admin--copy-to-clipboard`                  | Copy buttons                                                     |
| `admin--dismissible`                        | Closable flash messages and alerts                               |
| `admin--menu-search`                        | Sidebar menu search                                              |
| `admin--sidebar-trigger`                    | Navbar button that toggles the sidebar                           |
| `admin--theme-switcher`                     | Light / dark switch                                              |
| `shadcn--sidebar`, `shadcn--dialog`, `shadcn--alert-dialog`, `shadcn--dropdown-menu`, `shadcn--dropdown-menu-sub`, `shadcn--collapsible`, `shadcn--tooltip`, `shadcn--input-group`, `shadcn--input-group-display` | Behaviour of the shadcn recipes |

---

<table width="100%"><tr>
<td align="left">← <a href="menu.md">Menu</a></td>
<td align="right"><a href="migration.md">Migration</a> →</td>
</tr></table>
