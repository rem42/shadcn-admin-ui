<?php

declare(strict_types=1);

namespace Rem42\ShadcnAdminUi;

use Symfony\Component\AssetMapper\AssetMapperInterface;
use Symfony\Component\Config\Definition\Configurator\DefinitionConfigurator;
use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

/**
 * Tailwind CSS + shadcn/ui flavour of the Sylius Stack admin panel.
 *
 * It fills the "empty" templates of sylius/admin-ui through Twig Hooks, exactly like
 * sylius/bootstrap-admin-ui does, and keeps the same hook and hookable names so that
 * existing customisations keep working after switching themes.
 */
final class Rem42ShadcnAdminUiBundle extends AbstractBundle
{
    /** Page hooks of sylius/admin-ui that render the "sidebar" hookable. */
    private const array SIDEBAR_HOOKS = [
        'sylius_admin.common.index',
        'sylius_admin.common.show',
        'sylius_admin.common.create',
        'sylius_admin.common.update',
        'sylius_admin.dashboard.index',
    ];

    public function getPath(): string
    {
        return \dirname(__DIR__);
    }

    public function configure(DefinitionConfigurator $definition): void
    {
        $definition->rootNode()
            ->children()
            ->arrayNode('sidebar')
            ->addDefaultsIfNotSet()
            ->children()
            ->enumNode('variant')
            ->info('Default variant of the sidebar on every admin page, overridable per page hook.')
            ->values(['sidebar', 'floating', 'inset'])
            ->defaultValue('sidebar')
            ->end()
            ->end()
            ->end()
            ->end()
        ;
    }

    public function prependExtension(ContainerConfigurator $container, ContainerBuilder $builder): void
    {
        $bundles = $builder->getParameter('kernel.bundles');

        // Hooks, grid templates and anonymous component prefixes live in "config/app.php",
        // imported by the application (see README), exactly like sylius/bootstrap-admin-ui.
        // Importing them here would append them after the application configuration
        // and silently override its hooks.

        if (isset($bundles['SyliusAdminUiBundle'])) {
            $container->extension('sylius_twig_hooks', [
                'enable_autoprefixing' => true,
                'hook_name_section_separator' => '#',
            ], prepend: true);

            // Prepended, so a "sidebar" hookable configured on one page hook by the application still wins.
            $variant = $this->processConfiguration($builder)['sidebar']['variant'];
            $container->extension('sylius_twig_hooks', [
                'hooks' => array_fill_keys(self::SIDEBAR_HOOKS, [
                    'sidebar' => ['configuration' => ['variant' => $variant]],
                ]),
            ], prepend: true);
        }

        if ($this->isAssetMapperAvailable($builder)) {
            // Exposes the theme stylesheet and the Stimulus controllers to AssetMapper.
            $container->extension('framework', [
                'asset_mapper' => [
                    'paths' => [
                        $this->getPath() . '/assets' => '@rem42/shadcn-admin-ui',
                    ],
                ],
            ], prepend: true);

            // Registers the bundle controllers next to the application ones.
            // Their identifiers come from their sub-directory: "shadcn--dialog", "admin--grid-selection"...
            $container->extension('stimulus', [
                'controller_paths' => [
                    '%kernel.project_dir%/assets/controllers',
                    $this->getPath() . '/assets/controllers',
                ],
            ], prepend: true);
        }
    }

    public function loadExtension(array $config, ContainerConfigurator $container, ContainerBuilder $builder): void
    {
        $container->import('../config/services.php');
    }

    /**
     * @return array{sidebar: array{variant: string}}
     */
    private function processConfiguration(ContainerBuilder $builder): array
    {
        $extension = $this->getContainerExtension();
        $configs = $builder->getExtensionConfig($extension->getAlias());

        return new Processor()->processConfiguration($extension->getConfiguration($configs, $builder), $configs);
    }

    private function isAssetMapperAvailable(ContainerBuilder $builder): bool
    {
        if (!interface_exists(AssetMapperInterface::class)) {
            return false;
        }

        $bundlesMetadata = $builder->getParameter('kernel.bundles_metadata');

        return isset($bundlesMetadata['FrameworkBundle']);
    }
}
