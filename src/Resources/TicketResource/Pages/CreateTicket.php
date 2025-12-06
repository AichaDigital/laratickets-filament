<?php

declare(strict_types=1);

namespace AichaDigital\LaraticketsFilament\Resources\TicketResource\Pages;

use AichaDigital\LaraticketsFilament\Resources\TicketResource;
use Filament\Resources\Pages\CreateRecord;

class CreateTicket extends CreateRecord
{
    protected static string $resource = TicketResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['created_by'] = auth()->id();

        return $data;
    }
}
