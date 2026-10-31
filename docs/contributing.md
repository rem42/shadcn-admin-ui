# 🛠️ Contributing

[Docs](README.md) › Contributing

- [Demo application](#demo-application)
- [Make commands](#make-commands)
- [Without Docker](#without-docker)
- [Tests and coding standards](#tests-and-coding-standards)
- [Updating the shadcn recipes](#updating-the-shadcn-recipes)

---

## Demo application

`tests/Application` is a complete Sylius Stack application running on the sources of the bundle: a book CRUD with
filters, sorting, pagination, bulk delete, forms, a detail page and a custom dashboard.

- **SQLite**: no database server needed.
- **Live sources**: its stylesheet imports `assets/styles/theme.css` straight from the bundle, so a change to a
  template, a controller or the theme shows up right away.

```bash
composer install
make up        # Docker (PHP-FPM + Nginx)
make watch     # rebuilds the stylesheet whenever a template of the bundle or of the demo changes
```

Open <http://localhost:8080/admin> and log in with **admin** / **admin**.

## Make commands

| Command                                                          | Description                                    |
|------------------------------------------------------------------|------------------------------------------------|
| `make up`                                                        | Builds and starts the container                |
| `make down`                                                      | Stops the container                            |
| `make install`                                                   | `composer install` in the container            |
| `make assets`                                                    | Installs the importmap and builds Tailwind     |
| `make watch`                                                     | Rebuilds the stylesheet on every change        |
| `make reset`                                                     | Reloads the demo data                          |
| `make test`                                                      | Runs the functional tests (`tests/Functional`) |
| `make cs-fix`                                                    | PHP CS Fixer                                   |
| `make twig-fix`                                                  | Twig CS Fixer                                  |
| `make bash`                                                      | Shell in the container                         |
| `make console c="sylius:debug:twig-hooks sylius_admin.common.index"` | Runs a console command of the demo         |
| `make shadcn-update r="button dialog"`                            | [Updates the shadcn recipes](#updating-the-shadcn-recipes) |

## Without Docker

```bash
make assets   # or run the two commands of the target directly
php tests/Application/bin/console doctrine:schema:update --force
php tests/Application/bin/console app:load-books
php -S localhost:8080 -t tests/Application/public
```

## Tests and coding standards

The CI runs on every push and pull request:

- `composer validate --strict`;
- PHP CS Fixer (`vendor/bin/php-cs-fixer check --diff`) and Twig CS Fixer (`vendor/bin/twig-cs-fixer lint`);
- the PHPUnit suite, on a PHP / Symfony matrix (including lowest dependencies), after building the demo assets.

> [!TIP]
> Run `make cs-fix twig-fix test` before opening a pull request.

## Updating the shadcn recipes

The components of `templates/components/shadcn/` and the controllers of `assets/controllers/shadcn/` are recipes of
the [shadcn kit of Symfony UX Toolkit](https://ux.symfony.com/toolkit/kits/shadcn), renamed for the bundle.
`app:shadcn:update`, a command of the demo application, installs them again from `symfony/ux-toolkit` (dev
dependency of the bundle) and applies the renaming:

| Recipe                                   | Bundle                                            |
|------------------------------------------|---------------------------------------------------|
| `templates/components/Button.html.twig`  | `templates/components/shadcn/Button.html.twig`    |
| `assets/controllers/dialog_controller.js`| `assets/controllers/shadcn/dialog_controller.js`  |
| `<twig:Button>`, `component('Button')`   | `<twig:shadcn:Button>`, `component('shadcn:Button')` |
| `data-controller="dialog"`, `click->dialog#open`, `data-dialog-target`, `data-dialog-open-value` | `shadcn--dialog` everywhere |

### 1. Update the kit

```bash
composer update symfony/ux-toolkit
```

### 2. Install the recipes

```bash
make shadcn-update                     # every bundled recipe
make shadcn-update r="button dialog"   # some of them
```

Without Docker: `APP_ENV=dev php tests/Application/bin/console app:shadcn:update [button dialog]`.

> [!NOTE]
> Without argument, the bundled recipes are deduced from the components of `templates/components/shadcn/`
> (`AlertDialog.html.twig` → `alert-dialog`). Recipe dependencies (e.g. `button` for `dialog`) are installed too.
> To add a new recipe, pass its name: `make shadcn-update r=popover`.

### 3. Review the diff

The files are **overwritten**: `git diff` shows both the changes of the kit and the local changes of the bundle that
were lost. Keep the former, restore the latter (`git checkout -p`).

<details>
<summary>Local changes to restore after an update (as of UX Toolkit 3.6)</summary>

| File                                                       | Local change                                                                 |
|------------------------------------------------------------|------------------------------------------------------------------------------|
| `DropdownMenu/{Item,CheckboxItem,RadioItem,SubTrigger}`    | `cursor-pointer` instead of `cursor-default`                                 |
| `DropdownMenu/Content`                                     | `left` / `right` sides combined with `align` (`start`, `center`, `end`)      |
| `dropdown_menu_controller.js`                              | A pointer click focuses the menu, not its first item (no highlighted item)   |
| `Sidebar`                                                  | Nested sidebar (`sidebar.nested`: `<div>` instead of `<aside>`), `p-2` around `floating` / `inset` |
| `Sidebar/Content`                                          | Hidden scrollbar, no overflow clipping while a dropdown menu is open         |
| `Sidebar/GroupLabel`                                       | `as` prop (`div` or `button`, to toggle a `Collapsible`)                     |
| `Sidebar/MenuButton`                                       | `[&_svg]` instead of `[&>svg]` (nested icons are sized too)                  |

Update this table when you add or drop a local change.

</details>

> [!WARNING]
> Classes copied outside the components must be synced **by hand**:
>
> - `shared/helper/ui.html.twig`
> - `shared/form_theme.html.twig`
> - `shared/crud/common/sidebar/menu/menu.html.twig`
> - `shared/pagerfanta.html.twig`

### 4. Check

```bash
make watch   # then browse the demo: sidebar, menus, dialogs, forms
make test
```

---

<table width="100%"><tr>
<td align="left">← <a href="migration.md">Migration</a></td>
<td align="right"><a href="README.md">Documentation</a> ↑</td>
</tr></table>
