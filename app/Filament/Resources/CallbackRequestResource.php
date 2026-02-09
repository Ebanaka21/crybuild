<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CallbackRequestResource\Pages;
use App\Models\CallbackRequest;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CallbackRequestResource extends Resource
{
    protected static ?string $model = CallbackRequest::class;
    protected static ?string $navigationIcon = 'heroicon-o-phone-arrow-down-left';
    protected static ?string $navigationLabel = 'Заявки на звонок';
    protected static ?string $navigationGroup = 'Обращения';
    protected static ?int $navigationSort = 1;
    protected static ?string $modelLabel = 'Заявка';
    protected static ?string $pluralModelLabel = 'Заявки на звонок';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('status', 'new')->count() ?: null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'danger';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Информация о заявке')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Имя')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('phone')
                            ->label('Телефон')
                            ->tel()
                            ->maxLength(255),

                        Forms\Components\Select::make('subject')
                            ->label('Тема')
                            ->options([
                                'order' => 'Вопрос по заказу',
                                'product' => 'Вопрос о товаре',
                                'delivery' => 'Доставка',
                                'payment' => 'Оплата',
                                'return' => 'Возврат/обмен',
                                'cooperation' => 'Сотрудничество',
                                'other' => 'Другое',
                            ])
                            ->required(),

                        Forms\Components\Textarea::make('message')
                            ->label('Сообщение')
                            ->required()
                            ->rows(5)
                            ->columnSpanFull(),

                        Forms\Components\Select::make('status')
                            ->label('Статус')
                            ->options(CallbackRequest::getStatuses())
                            ->required()
                            ->default('new'),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('#')
                    ->sortable(),

                Tables\Columns\TextColumn::make('name')
                    ->label('Имя')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('phone')
                    ->label('Телефон')
                    ->searchable(),

                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),

                Tables\Columns\TextColumn::make('subject')
                    ->label('Тема')
                    ->formatStateUsing(fn ($state) => match($state) {
                        'order' => 'Заказ',
                        'product' => 'Товар',
                        'delivery' => 'Доставка',
                        'payment' => 'Оплата',
                        'return' => 'Возврат',
                        'cooperation' => 'Сотрудничество',
                        default => 'Другое',
                    })
                    ->badge(),

                Tables\Columns\TextColumn::make('status')
                    ->label('Статус')
                    ->formatStateUsing(fn ($state) => CallbackRequest::getStatuses()[$state] ?? $state)
                    ->badge()
                    ->color(fn ($state) => match($state) {
                        'new' => 'danger',
                        'in_progress' => 'warning',
                        'done' => 'success',
                        default => 'gray',
                    }),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Дата')
                    ->dateTime('d.m.Y H:i')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Статус')
                    ->options(CallbackRequest::getStatuses()),

                Tables\Filters\SelectFilter::make('subject')
                    ->label('Тема')
                    ->options([
                        'order' => 'Вопрос по заказу',
                        'product' => 'Вопрос о товаре',
                        'delivery' => 'Доставка',
                        'payment' => 'Оплата',
                        'return' => 'Возврат/обмен',
                        'cooperation' => 'Сотрудничество',
                        'other' => 'Другое',
                    ]),
            ])
            ->actions([
                Tables\Actions\Action::make('markInProgress')
                    ->label('В работу')
                    ->icon('heroicon-o-arrow-path')
                    ->color('warning')
                    ->action(fn (CallbackRequest $record) => $record->update(['status' => 'in_progress']))
                    ->visible(fn (CallbackRequest $record) => $record->status === 'new'),

                Tables\Actions\Action::make('markDone')
                    ->label('Обработана')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->action(fn (CallbackRequest $record) => $record->update(['status' => 'done']))
                    ->visible(fn (CallbackRequest $record) => $record->status !== 'done'),

                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCallbackRequests::route('/'),
            'view' => Pages\ViewCallbackRequest::route('/{record}'),
            'edit' => Pages\EditCallbackRequest::route('/{record}/edit'),
        ];
    }
}
