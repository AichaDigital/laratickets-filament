<?php

declare(strict_types=1);

namespace AichaDigital\LaraticketsFilament\Resources;

use AichaDigital\Laratickets\Models\Department;
use AichaDigital\LaraticketsFilament\Resources\DepartmentResource\Pages;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class DepartmentResource extends Resource
{
    protected static ?string $model = Department::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-building-office';

    protected static string|\UnitEnum|null $navigationGroup = 'Support';

    protected static ?int $navigationSort = 2;

    public static function getNavigationLabel(): string
    {
        return __('laratickets-filament::resources.department.navigation_label');
    }

    public static function getModelLabel(): string
    {
        return __('laratickets-filament::resources.department.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('laratickets-filament::resources.department.plural_model_label');
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make(__('laratickets-filament::resources.department.sections.basic_info'))
                    ->schema([
                        TextInput::make('name')
                            ->label(__('laratickets-filament::resources.department.fields.name'))
                            ->required()
                            ->maxLength(255),

                        Textarea::make('description')
                            ->label(__('laratickets-filament::resources.department.fields.description'))
                            ->rows(3)
                            ->columnSpanFull(),

                        Toggle::make('active')
                            ->label(__('laratickets-filament::resources.department.fields.active'))
                            ->default(true),
                    ])
                    ->columns(1)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label(__('laratickets-filament::resources.department.fields.name'))
                    ->searchable()
                    ->sortable(),

                TextColumn::make('description')
                    ->label(__('laratickets-filament::resources.department.fields.description'))
                    ->limit(50)
                    ->toggleable(),

                IconColumn::make('active')
                    ->label(__('laratickets-filament::resources.department.fields.active'))
                    ->boolean()
                    ->sortable(),

                TextColumn::make('tickets_count')
                    ->label(__('laratickets-filament::resources.department.fields.tickets_count'))
                    ->counts('tickets')
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label(__('laratickets-filament::resources.department.fields.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('name')
            ->filters([
                TernaryFilter::make('active')
                    ->label(__('laratickets-filament::resources.department.fields.active')),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDepartments::route('/'),
            'create' => Pages\CreateDepartment::route('/create'),
            'edit' => Pages\EditDepartment::route('/{record}/edit'),
        ];
    }
}
