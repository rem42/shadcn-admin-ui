# 🔀 Migrating from BootstrapAdminUi

[Docs](README.md) › Migration

The theme keeps the hook names, hookable names and macro APIs of `sylius/bootstrap-admin-ui`: most of a migration
is a search and replace.

---

## Steps

1. **Swap the packages** (see [Installation](installation.md)):

   ```bash
   composer remove sylius/bootstrap-admin-ui
   composer require rem42/shadcn-admin-ui
   ```

2. **Replace the namespace** in your templates and hook configuration:

   ```diff
   - {% import '@SyliusBootstrapAdminUi/shared/helper/button.html.twig' as button %}
   + {% import '@Rem42ShadcnAdminUi/shared/helper/button.html.twig' as button %}
   ```

3. **Replace the component prefix**:

   ```diff
   - <twig:sylius_bootstrap_admin_ui:delete_modal … />
   + <twig:shadcn_admin_ui:delete_modal … />
   ```

4. **Rewrite Bootstrap classes** of your custom templates with Tailwind utilities.

5. **Icons**: nothing to do. `tabler:*` names keep working through UX Icons; the theme itself uses `lucide:*`.

> [!TIP]
> Find what is left to migrate:
>
> ```bash
> grep -rn "SyliusBootstrapAdminUi\|sylius_bootstrap_admin_ui" templates config
> ```

## Equivalences

| BootstrapAdminUi                           | Shadcn Admin UI                           |
|--------------------------------------------|-------------------------------------------|
| `@SyliusBootstrapAdminUi/…`                | `@Rem42ShadcnAdminUi/…`                   |
| `sylius_bootstrap_admin_ui:*` components   | `shadcn_admin_ui:*` components            |
| Bootstrap 5 / Tabler classes               | Tailwind CSS v4 utilities                 |
| `tabler:*` icons                           | `lucide:*` (`tabler:*` still works)       |
| Webpack Encore / AssetMapper               | AssetMapper + `symfonycasts/tailwind-bundle` |

## Hook differences

| Change     | Hook / hookable                                                                     |
|------------|-------------------------------------------------------------------------------------|
| ➖ Removed | `toggle_button` hookable of the sidebar                                             |
| ➕ Added   | `sylius_admin.common.component.navbar.sidebar_trigger` (the toggle, now in the navbar) |
| ➕ Added   | `sylius_admin.base#metatags.color_scheme`                                           |

> [!TIP]
> List the hookables of a page to check your overrides:
> `php bin/console sylius:debug:twig-hooks sylius_admin.common.index`

---

<table width="100%"><tr>
<td align="left">← <a href="components.md">Components</a></td>
<td align="right"><a href="contributing.md">Contributing</a> →</td>
</tr></table>
