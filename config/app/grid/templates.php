<?php

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

return static function (ContainerConfigurator $container): void {
    $container->extension('sylius_grid', [
        'templates' => [
            'action' => [
                'apply_transition' => '@Rem42ShadcnAdminUi/shared/grid/action/apply_transition.html.twig',
                'create' => '@Rem42ShadcnAdminUi/shared/grid/action/create.html.twig',
                'delete' => '@Rem42ShadcnAdminUi/shared/grid/action/delete.html.twig',
                'show' => '@Rem42ShadcnAdminUi/shared/grid/action/show.html.twig',
                'update' => '@Rem42ShadcnAdminUi/shared/grid/action/update.html.twig',
            ],
            'bulk_action' => [
                'delete' => '@Rem42ShadcnAdminUi/shared/grid/bulk_action/delete.html.twig',
            ],
            'filter' => [
                'boolean' => '@Rem42ShadcnAdminUi/shared/grid/filter/boolean.html.twig',
                'date' => '@Rem42ShadcnAdminUi/shared/grid/filter/date.html.twig',
                'entity' => '@Rem42ShadcnAdminUi/shared/grid/filter/entity.html.twig',
                'enum' => '@Rem42ShadcnAdminUi/shared/grid/filter/enum.html.twig',
                'exists' => '@Rem42ShadcnAdminUi/shared/grid/filter/exists.html.twig',
                'select' => '@Rem42ShadcnAdminUi/shared/grid/filter/select.html.twig',
                'string' => '@Rem42ShadcnAdminUi/shared/grid/filter/string.html.twig',
            ],
        ],
    ]);
};
