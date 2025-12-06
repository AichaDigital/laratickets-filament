<?php

declare(strict_types=1);

namespace AichaDigital\LaraticketsFilament\Resources\TicketResource\Pages;

use AichaDigital\LaraticketsFilament\Resources\TicketResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditTicket extends EditRecord
{
    protected static string $resource = TicketResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
