<?php

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

return static function (ContainerConfigurator $container): void {
    $container->extension('sylius_twig_hooks', [
        'hooks' => [
            'sylius_admin.security.login' => [
                'page' => [
                    'template' => '@Rem42ShadcnAdminUi/security/common/page.html.twig',
                ],
            ],

            'sylius_admin.security.login.page' => [
                'logo' => [
                    'template' => '@Rem42ShadcnAdminUi/security/common/logo.html.twig',
                ],
                'content' => [
                    'template' => '@Rem42ShadcnAdminUi/security/common/content.html.twig',
                ],
            ],

            'sylius_admin.security.login.page.logo' => [
                'image' => [
                    'template' => '@Rem42ShadcnAdminUi/security/common/logo/image.html.twig',
                ],
            ],

            'sylius_admin.security.login.page.content' => [
                'header' => [
                    'template' => '@Rem42ShadcnAdminUi/security/common/content/header.html.twig',
                ],
                'flashes' => [
                    'template' => '@Rem42ShadcnAdminUi/shared/crud/common/content/flashes.html.twig',
                ],
                'form' => [
                    'template' => '@Rem42ShadcnAdminUi/security/login/page/content/form.html.twig',
                ],
            ],

            'sylius_admin.security.login.page.content.form' => [
                'error' => [
                    'template' => '@Rem42ShadcnAdminUi/security/login/page/content/form/error.html.twig',
                ],
                'username' => [
                    'template' => '@Rem42ShadcnAdminUi/security/login/page/content/form/username.html.twig',
                ],
                'password' => [
                    'template' => '@Rem42ShadcnAdminUi/security/login/page/content/form/password.html.twig',
                ],
                'remember_me' => [
                    'template' => '@Rem42ShadcnAdminUi/security/login/page/content/form/remember_me.html.twig',
                ],
                'submit' => [
                    'template' => '@Rem42ShadcnAdminUi/security/login/page/content/form/submit.html.twig',
                ],
            ],
        ],
    ]);
};
