<?php

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Rem42\ShadcnAdminUi\Twig\Component\UserDropdownComponent;

return static function (ContainerConfigurator $container): void {
    $services = $container->services();

    $services->set('rem42_shadcn_admin_ui.twig.component.navbar.user_dropdown', UserDropdownComponent::class)
        ->public()
        ->args([
            param('sylius_admin_ui.routing'),
            service('security.token_storage'),
            service('router'),
        ])
        ->tag('twig.component', [
            'key' => 'shadcn_admin_ui:navbar:user_dropdown',
            'template' => '@Rem42ShadcnAdminUi/shared/components/navbar/user.html.twig',
        ]);
};
