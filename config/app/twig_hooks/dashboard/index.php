<?php

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

return static function (ContainerConfigurator $container): void {
    $container->extension('sylius_twig_hooks', [
        'hooks' => [
            'sylius_admin.dashboard.index' => [
                'sidebar' => [
                    'template' => '@Rem42ShadcnAdminUi/shared/crud/common/sidebar.html.twig',
                ],
                'navbar' => [
                    'template' => '@Rem42ShadcnAdminUi/shared/crud/common/navbar.html.twig',
                ],
                'content' => [
                    'template' => '@Rem42ShadcnAdminUi/shared/crud/common/content.html.twig',
                ],
            ],

            'sylius_admin.dashboard.index.content' => [
                'header' => [
                    'template' => '@Rem42ShadcnAdminUi/shared/crud/common/content/header.html.twig',
                ],
                'grid' => [
                    'enabled' => false,
                ],
            ],

            'sylius_admin.dashboard.index.content.header' => [
                'breadcrumbs' => [
                    'enabled' => false,
                ],
                'title_block' => [
                    'template' => '@Rem42ShadcnAdminUi/shared/crud/common/content/header/title_block.html.twig',
                ],
            ],

            'sylius_admin.dashboard.index.content.header.title_block' => [
                'title' => [
                    'template' => '@Rem42ShadcnAdminUi/shared/crud/common/content/header/title_block/title.html.twig',
                    'configuration' => [
                        'title' => 'sylius.ui.dashboard',
                        'sylius_test_html_attribute' => 'dashboard-header',
                    ],
                ],
                'actions' => [
                    'enabled' => false,
                ],
            ],
        ],
    ]);
};
