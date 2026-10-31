<?php

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

return static function (ContainerConfigurator $container): void {
    $container->extension('sylius_twig_hooks', [
        'hooks' => [
            'sylius_admin.common.create#title' => [
                'current' => [
                    'template' => '@Rem42ShadcnAdminUi/shared/crud/common/title/current.html.twig',
                    'priority' => 200,
                ],
                'separator' => [
                    'template' => '@Rem42ShadcnAdminUi/shared/crud/common/title/separator.html.twig',
                    'priority' => 100,
                ],
                'parent' => [
                    'template' => '@Rem42ShadcnAdminUi/shared/crud/common/title/parent.html.twig',
                    'priority' => 0,
                ],
            ],

            'sylius_admin.common.create' => [
                'sidebar' => [
                    'template' => '@Rem42ShadcnAdminUi/shared/crud/common/sidebar.html.twig',
                ],
                'navbar' => [
                    'template' => '@Rem42ShadcnAdminUi/shared/crud/common/navbar.html.twig',
                ],
                'content' => [
                    'template' => '@Rem42ShadcnAdminUi/shared/crud/common/content.html.twig',
                ],
                'footer' => [
                    'template' => '@Rem42ShadcnAdminUi/shared/crud/common/content/footer.html.twig',
                    'priority' => -100,
                ],
            ],

            'sylius_admin.common.create.content' => [
                'flashes' => [
                    'template' => '@Rem42ShadcnAdminUi/shared/crud/common/content/flashes.html.twig',
                ],
                'header' => [
                    'template' => '@Rem42ShadcnAdminUi/shared/crud/common/content/header.html.twig',
                ],
                'form_error_alert' => [
                    'template' => '@Rem42ShadcnAdminUi/shared/crud/common/content/form_error_alert.html.twig',
                ],
                'form' => [
                    'template' => '@Rem42ShadcnAdminUi/shared/crud/common/content/form.html.twig',
                ],
            ],

            'sylius_admin.common.create.content.header' => [
                'breadcrumbs' => [
                    'template' => '@Rem42ShadcnAdminUi/shared/crud/create/content/header/breadcrumbs.html.twig',
                ],
                'title_block' => [
                    'template' => '@Rem42ShadcnAdminUi/shared/crud/common/content/header/title_block.html.twig',
                ],
            ],

            'sylius_admin.common.create.content.header.title_block' => [
                'title' => [
                    'template' => '@Rem42ShadcnAdminUi/shared/crud/create/content/header/title_block/title.html.twig',
                ],
                'actions' => [
                    'template' => '@Rem42ShadcnAdminUi/shared/crud/create/content/header/title_block/actions.html.twig',
                ],
            ],

            'sylius_admin.common.create.content.header.title_block.actions' => [
                'cancel' => [
                    'template' => '@Rem42ShadcnAdminUi/shared/crud/common/content/header/title_block/actions/cancel.html.twig',
                ],
                'create' => [
                    'template' => '@Rem42ShadcnAdminUi/shared/crud/common/content/header/title_block/actions/create.html.twig',
                ],
            ],

            'sylius_admin.common.create.content.form' => [
                'sections' => [
                    'template' => '@Rem42ShadcnAdminUi/shared/crud/common/content/form/sections.html.twig',
                ],
            ],

            'sylius_admin.common.create.content.form.sections' => [
                'general' => [
                    'template' => '@Rem42ShadcnAdminUi/shared/crud/common/content/form/sections/general.html.twig',
                ],
            ],

            'sylius_admin.common.create.content.form.sections.general' => [
                'default' => [
                    'template' => '@Rem42ShadcnAdminUi/shared/crud/common/content/form/sections/general/default.html.twig',
                ],
            ],
        ],
    ]);
};
