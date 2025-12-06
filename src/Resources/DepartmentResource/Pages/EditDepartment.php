<?php

declare(strict_types=1);

namespace AichaDigital\LaraticketsFilament\Resources\DepartmentResource\Pages;

use AichaDigital\LaraticketsFilament\Resources\DepartmentResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditDepartment extends EditRecord
{
    protected static string $resource = DepartmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
