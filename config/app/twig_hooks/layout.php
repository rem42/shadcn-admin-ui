<?php

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

return static function (ContainerConfigurator $container): void {
    $container->extension('sylius_twig_hooks', [
        'hooks' => [
            'sylius_admin.base#base_title' => [
                'default' => [
                    'template' => '@Rem42ShadcnAdminUi/shared/layout/title.html.twig',
                ],
            ],

            'sylius_admin.base#metatags' => [
                'color_scheme' => [
                    'template' => '@Rem42ShadcnAdminUi/shared/layout/metatags.html.twig',
                ],
            ],

            'sylius_admin.base#stylesheets' => [
                'theme' => [
                    'template' => '@Rem42ShadcnAdminUi/shared/layout/theme.html.twig',
                    'priority' => 200,
                ],
                'styles' => [
                    'template' => '@Rem42ShadcnAdminUi/shared/layout/stylesheets.html.twig',
                    'configuration' => [
                        'path' => 'styles/admin.css',
                    ],
                ],
            ],

            'sylius_admin.base#javascripts' => [
                'javascripts' => [
                    'template' => '@Rem42ShadcnAdminUi/shared/layout/javascripts.html.twig',
                    'configuration' => [
                        'entrypoint' => 'admin',
                    ],
                ],
            ],
        ],
    ]);
};
