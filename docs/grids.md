# 📊 Grids

[Docs](README.md) › Grids

- [What you get](#what-you-get)
- [Column options](#column-options)
- [Mobile cards](#mobile-cards)

---

## What you get

Sylius grids are rendered as a shadcn data table with:

- sorting, filters panel and pagination;
- row selection with a "select all" checkbox and bulk delete;
- actions `create`, `show`, `update`, `delete` and `apply_transition` (with `symfony/workflow`);
- filters `string`, `boolean`, `date`, `enum`, `entity`, `exists`, `select`;
- a card layout below the `md` breakpoint.

## Column options

Cells are `whitespace-nowrap`: the table scrolls horizontally when needed. A field's `vars` option accepts:

| Var        | Type                                     | Effect                                                                                  |
|------------|------------------------------------------|-----------------------------------------------------------------------------------------|
| `th_class` | `string`                                 | Classes added to the column header                                                      |
| `td_class` | `string`                                 | Classes added to every cell of the column                                               |
| `wrap`     | `bool`                                   | Lets a long-text column wrap (`min-w-48 whitespace-normal break-words`) instead of widening the table |
| `mobile`   | `title` \| `badge` \| `meta` \| `hidden` | Place of the field in the [mobile card](#mobile-cards)                                  |

```php
StringField::create('comment')->setOptions(['vars' => ['wrap' => true]]);
StringField::create('price')->setOptions(['vars' => ['td_class' => 'text-right tabular-nums']]);
```

## Mobile cards

Below the `md` breakpoint each row becomes a card (CSS only, same markup), where each cell is a
"label … value" line. The `mobile` var moves a field:

| Value    | Place in the card                              |
|----------|------------------------------------------------|
| `title`  | Card heading                                   |
| `badge`  | Short line under the title, e.g. a status      |
| `meta`   | Muted line, without label                      |
| `hidden` | Not shown on mobile                            |

```php
StringField::create('number')->setOptions(['vars' => ['mobile' => 'title']]);
TwigField::create('state', 'admin/order/state.html.twig')->setOptions(['vars' => ['mobile' => 'badge']]);
```

Quick filter tabs, the environment indicator and searchable entity filters live in [rem42/sylius-admin-kit-bundle](https://github.com/rem42/sylius-admin-kit-bundle).

---

<table width="100%"><tr>
<td align="left">← <a href="theming.md">Theming</a></td>
<td align="right"><a href="menu.md">Menu</a> →</td>
</tr></table>
