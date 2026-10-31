<?php

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

return static function (ContainerConfigurator $container): void {
    $container->extension('sylius_twig_extra', [
        'twig_ux' => [
            'anonymous_component_template_prefixes' => [
                // <twig:shadcn_admin_ui:delete_modal>, <twig:shadcn_admin_ui:copyable>...
                'shadcn_admin_ui' => '@Rem42ShadcnAdminUi/shared/components',
                // <twig:shadcn:Button>, <twig:shadcn:Card:Header>... (recipes copied from the UX Toolkit shadcn kit)
                'shadcn' => '@Rem42ShadcnAdminUi/components/shadcn',
            ],
        ],
    ]);
};
