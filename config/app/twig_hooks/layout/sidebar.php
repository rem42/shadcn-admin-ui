<?php

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

return static function (ContainerConfigurator $container): void {
    $container->extension('sylius_twig_hooks', [
        'hooks' => [
            'sylius_admin.common.component.sidebar' => [
                'logo' => [
                    'template' => '@Rem42ShadcnAdminUi/shared/crud/common/sidebar/logo.html.twig',
                ],
                'menu' => [
                    'template' => '@Rem42ShadcnAdminUi/shared/crud/common/sidebar/menu.html.twig',
                ],
            ],

            'sylius_admin.common.component.sidebar.logo' => [
                'image' => [
                    'template' => '@Rem42ShadcnAdminUi/shared/crud/common/sidebar/logo/image.html.twig',
                    'configuration' => [
                        'name' => 'Sylius',
                        'subtitle' => 'Admin panel',
                    ],
                ],
            ],
        ],
    ]);
};
