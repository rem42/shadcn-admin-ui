<?php

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

return static function (ContainerConfigurator $container): void {
    $container->extension('sylius_twig_hooks', [
        'hooks' => [
            'sylius_admin.common.component.navbar' => [
                'sidebar_trigger' => [
                    'template' => '@Rem42ShadcnAdminUi/shared/crud/common/navbar/sidebar_trigger.html.twig',
                    'priority' => 100,
                ],
                'menu' => [
                    'template' => '@Rem42ShadcnAdminUi/shared/crud/common/navbar/menu.html.twig',
                ],
                'items' => [
                    'template' => '@Rem42ShadcnAdminUi/shared/crud/common/navbar/items.html.twig',
                ],
            ],

            'sylius_admin.common.component.navbar.items' => [
                'theme_switcher' => [
                    'template' => '@Rem42ShadcnAdminUi/shared/crud/common/navbar/items/theme_switcher.html.twig',
                ],
                'user' => [
                    'template' => '@Rem42ShadcnAdminUi/shared/crud/common/navbar/items/user.html.twig',
                ],
            ],
        ],
    ]);
};
