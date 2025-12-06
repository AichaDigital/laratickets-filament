<?php

declare(strict_types=1);

namespace AichaDigital\LaraticketsFilament\Resources\TicketResource\Pages;

use AichaDigital\LaraticketsFilament\Resources\TicketResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTickets extends ListRecords
{
    protected static string $resource = TicketResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
