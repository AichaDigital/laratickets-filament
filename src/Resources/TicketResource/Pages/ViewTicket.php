<?php

declare(strict_types=1);

namespace AichaDigital\LaraticketsFilament\Resources\TicketResource\Pages;

use AichaDigital\LaraticketsFilament\Resources\TicketResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewTicket extends ViewRecord
{
    protected static string $resource = TicketResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
