<?php

namespace AichaDigital\LaraticketsFilament;

use AichaDigital\LaraticketsFilament\Commands\LaraticketsFilamentCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaraticketsFilamentServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laratickets-filament')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_laratickets_filament_table')
            ->hasCommand(LaraticketsFilamentCommand::class);
    }
}
