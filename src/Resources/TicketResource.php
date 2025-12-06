<?php

declare(strict_types=1);

namespace AichaDigital\LaraticketsFilament\Resources;

use AichaDigital\Laratickets\Enums\Priority;
use AichaDigital\Laratickets\Enums\RiskLevel;
use AichaDigital\Laratickets\Enums\TicketStatus;
use AichaDigital\Laratickets\Models\Ticket;
use AichaDigital\LaraticketsFilament\Resources\TicketResource\Pages;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class TicketResource extends Resource
{
    protected static ?string $model = Ticket::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-ticket';

    protected static string|\UnitEnum|null $navigationGroup = 'Support';

    protected static ?int $navigationSort = 1;

    public static function getNavigationLabel(): string
    {
        return __('laratickets-filament::resources.ticket.navigation_label');
    }

    public static function getModelLabel(): string
    {
        return __('laratickets-filament::resources.ticket.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('laratickets-filament::resources.ticket.plural_model_label');
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make(__('laratickets-filament::resources.ticket.sections.basic_info'))
                    ->schema([
                        TextInput::make('subject')
                            ->label(__('laratickets-filament::resources.ticket.fields.subject'))
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),

                        Textarea::make('description')
                            ->label(__('laratickets-filament::resources.ticket.fields.description'))
                            ->required()
                            ->rows(4)
                            ->columnSpanFull(),

                        Select::make('department_id')
                            ->label(__('laratickets-filament::resources.ticket.fields.department'))
                            ->relationship('department', 'name')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->native(false),

                        Select::make('user_priority')
                            ->label(__('laratickets-filament::resources.ticket.fields.priority'))
                            ->options(collect(Priority::cases())->mapWithKeys(
                                fn (Priority $priority) => [$priority->value => $priority->label()]
                            ))
                            ->required()
                            ->native(false),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),

                Section::make(__('laratickets-filament::resources.ticket.sections.status_info'))
                    ->schema([
                        Select::make('status')
                            ->label(__('laratickets-filament::resources.ticket.fields.status'))
                            ->options(collect(TicketStatus::cases())->mapWithKeys(
                                fn (TicketStatus $status) => [$status->value => $status->label()]
                            ))
                            ->required()
                            ->native(false),

                        Select::make('assessed_risk')
                            ->label(__('laratickets-filament::resources.ticket.fields.risk_level'))
                            ->options(collect(RiskLevel::cases())->mapWithKeys(
                                fn (RiskLevel $risk) => [$risk->value => $risk->label()]
                            ))
                            ->native(false),

                        DateTimePicker::make('estimated_deadline')
                            ->label(__('laratickets-filament::resources.ticket.fields.deadline')),
                    ])
                    ->columns(3)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('#')
                    ->sortable(),

                TextColumn::make('subject')
                    ->label(__('laratickets-filament::resources.ticket.fields.subject'))
                    ->searchable()
                    ->sortable()
                    ->limit(40),

                TextColumn::make('department.name')
                    ->label(__('laratickets-filament::resources.ticket.fields.department'))
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('status')
                    ->label(__('laratickets-filament::resources.ticket.fields.status'))
                    ->badge()
                    ->color(fn (TicketStatus $state): string => match ($state) {
                        TicketStatus::NEW => 'info',
                        TicketStatus::ASSIGNED => 'warning',
                        TicketStatus::IN_PROGRESS => 'primary',
                        TicketStatus::ESCALATION_REQUESTED => 'warning',
                        TicketStatus::ESCALATED => 'danger',
                        TicketStatus::RESOLVED => 'success',
                        TicketStatus::CLOSED => 'gray',
                        TicketStatus::CANCELLED => 'gray',
                    })
                    ->formatStateUsing(fn (TicketStatus $state): string => $state->label())
                    ->sortable(),

                TextColumn::make('user_priority')
                    ->label(__('laratickets-filament::resources.ticket.fields.priority'))
                    ->badge()
                    ->color(fn (Priority $state): string => match ($state) {
                        Priority::LOW => 'gray',
                        Priority::MEDIUM => 'info',
                        Priority::HIGH => 'warning',
                        Priority::CRITICAL => 'danger',
                    })
                    ->formatStateUsing(fn (Priority $state): string => $state->label())
                    ->sortable(),

                TextColumn::make('assessed_risk')
                    ->label(__('laratickets-filament::resources.ticket.fields.risk_level'))
                    ->badge()
                    ->color(fn (?RiskLevel $state): string => match ($state) {
                        RiskLevel::LOW => 'gray',
                        RiskLevel::MEDIUM => 'info',
                        RiskLevel::HIGH => 'warning',
                        RiskLevel::CRITICAL => 'danger',
                        null => 'gray',
                    })
                    ->formatStateUsing(fn (?RiskLevel $state): string => $state?->label() ?? '-')
                    ->toggleable(),

                TextColumn::make('estimated_deadline')
                    ->label(__('laratickets-filament::resources.ticket.fields.deadline'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('created_at')
                    ->label(__('laratickets-filament::resources.ticket.fields.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('status')
                    ->label(__('laratickets-filament::resources.ticket.fields.status'))
                    ->options(collect(TicketStatus::cases())->mapWithKeys(
                        fn (TicketStatus $status) => [$status->value => $status->label()]
                    ))
                    ->multiple(),

                SelectFilter::make('user_priority')
                    ->label(__('laratickets-filament::resources.ticket.fields.priority'))
                    ->options(collect(Priority::cases())->mapWithKeys(
                        fn (Priority $priority) => [$priority->value => $priority->label()]
                    )),

                SelectFilter::make('department_id')
                    ->label(__('laratickets-filament::resources.ticket.fields.department'))
                    ->relationship('department', 'name'),

                SelectFilter::make('assessed_risk')
                    ->label(__('laratickets-filament::resources.ticket.fields.risk_level'))
                    ->options(collect(RiskLevel::cases())->mapWithKeys(
                        fn (RiskLevel $risk) => [$risk->value => $risk->label()]
                    )),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTickets::route('/'),
            'create' => Pages\CreateTicket::route('/create'),
            'view' => Pages\ViewTicket::route('/{record}'),
            'edit' => Pages\EditTicket::route('/{record}/edit'),
        ];
    }
}
