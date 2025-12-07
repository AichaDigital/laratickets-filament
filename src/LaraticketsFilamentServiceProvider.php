<?php

declare(strict_types=1);

namespace AichaDigital\LaraticketsFilament;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaraticketsFilamentServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laratickets-filament')
            ->hasTranslations();
    }
}
