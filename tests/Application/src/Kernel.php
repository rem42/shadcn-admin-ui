<?php

declare(strict_types=1);

namespace App;

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;

/**
 * Demo application of the bundle (see docker-compose.yml): http://localhost:8080/admin (admin / admin).
 *
 * It runs on the vendor/ directory of the bundle, whose sources are used as is: any change to a template,
 * a controller or the theme stylesheet shows up in the demo right away.
 */
final class Kernel extends BaseKernel
{
    use MicroKernelTrait;

    public function getProjectDir(): string
    {
        return \dirname(__DIR__);
    }
}
