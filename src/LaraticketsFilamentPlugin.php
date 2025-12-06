<?php

declare(strict_types=1);

namespace AichaDigital\LaraticketsFilament;

use AichaDigital\LaraticketsFilament\Resources\DepartmentResource;
use AichaDigital\LaraticketsFilament\Resources\TicketResource;
use Filament\Contracts\Plugin;
use Filament\Panel;

class LaraticketsFilamentPlugin implements Plugin
{
    protected bool $hasTicketResource = true;

    protected bool $hasDepartmentResource = true;

    public function getId(): string
    {
        return 'laratickets-filament';
    }

    public function register(Panel $panel): void
    {
        $resources = [];

        if ($this->hasTicketResource) {
            $resources[] = TicketResource::class;
        }

        if ($this->hasDepartmentResource) {
            $resources[] = DepartmentResource::class;
        }

        $panel->resources($resources);
    }

    public function boot(Panel $panel): void
    {
        //
    }

    public static function make(): static
    {
        return app(static::class);
    }

    public static function get(): static
    {
        /** @var static $plugin */
        $plugin = filament(app(static::class)->getId());

        return $plugin;
    }

    public function ticketResource(bool $condition = true): static
    {
        $this->hasTicketResource = $condition;

        return $this;
    }

    public function hasTicketResource(): bool
    {
        return $this->hasTicketResource;
    }

    public function departmentResource(bool $condition = true): static
    {
        $this->hasDepartmentResource = $condition;

        return $this;
    }

    public function hasDepartmentResource(): bool
    {
        return $this->hasDepartmentResource;
    }
}
