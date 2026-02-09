<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Infolists;
use Filament\Infolists\Infolist;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;
    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';
    protected static ?string $navigationLabel = 'Заказы';
    protected static ?string $navigationGroup = 'Продажи';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Информация о заказе')
                    ->schema([
                        Forms\Components\TextInput::make('order_number')
                            ->label('Номер заказа')
                            ->disabled()
                            ->dehydrated(false),

                        Forms\Components\Select::make('status')
                            ->label('Статус')
                            ->options([
                                'new' => 'Новый',
                                'processing' => 'В обработке',
                                'shipped' => 'Отправлен',
                                'delivered' => 'Доставлен',
                                'cancelled' => 'Отменен',
                            ])
                            ->required(),

                        Forms\Components\Select::make('payment_status')
                            ->label('Статус оплаты')
                            ->options([
                                'pending' => 'Ожидает оплаты',
                                'paid' => 'Оплачен',
                                'failed' => 'Ошибка оплаты',
                            ])
                            ->required(),
                    ])->columns(3),

                Forms\Components\Section::make('Данные покупателя')
                    ->schema([
                        Forms\Components\TextInput::make('customer_name')
                            ->label('Имя')
                            ->required(),

                        Forms\Components\TextInput::make('customer_email')
                            ->label('Email')
                            ->email()
                            ->required(),

                        Forms\Components\TextInput::make('customer_phone')
                            ->label('Телефон')
                            ->tel()
                            ->required(),

                        Forms\Components\Textarea::make('shipping_address')
                            ->label('Адрес доставки')
                            ->rows(2)
                            ->columnSpanFull(),

                        Forms\Components\TextInput::make('city')
                            ->label('Город')
                            ->required(),

                        Forms\Components\TextInput::make('postal_code')
                            ->label('Индекс'),
                    ])->columns(3),

                Forms\Components\Section::make('Детали заказа')
                    ->schema([
                        Forms\Components\Repeater::make('items')
                            ->label('Товары')
                            ->relationship('items')
                            ->schema([
                                Forms\Components\Select::make('product_id')
                                    ->label('Товар')
                                    ->relationship('product', 'name')
                                    ->required()
                                    ->searchable()
                                    ->preload()
                                    ->reactive()
                                    ->afterStateUpdated(function ($state, callable $set) {
                                        $product = \App\Models\Product::find($state);
                                        if ($product) {
                                            $set('price', $product->price);
                                            $set('product_name', $product->name);
                                        }
                                    }),

                                Forms\Components\TextInput::make('quantity')
                                    ->label('Количество')
                                    ->numeric()
                                    ->default(1)
                                    ->required()
                                    ->reactive()
                                    ->afterStateUpdated(fn ($state, callable $get, callable $set) =>
                                        $set('total', $state * $get('price'))
                                    ),

                                Forms\Components\TextInput::make('price')
                                    ->label('Цена')
                                    ->numeric()
                                    ->required()
                                    ->prefix('₽')
                                    ->reactive()
                                    ->afterStateUpdated(fn ($state, callable $get, callable $set) =>
                                        $set('total', $state * $get('quantity'))
                                    ),

                                Forms\Components\TextInput::make('total')
                                    ->label('Сумма')
                                    ->numeric()
                                    ->disabled()
                                    ->prefix('₽')
                                    ->dehydrated(),
                            ])
                            ->columns(4)
                            ->defaultItems(1)
                            ->reorderable(false)
                            ->collapsible(),

                        Forms\Components\Textarea::make('comment')
                            ->label('Комментарий')
                            ->rows(3)
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('order_number')
                    ->label('Номер')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('customer_name')
                    ->label('Покупатель')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('customer_phone')
                    ->label('Телефон')
                    ->searchable(),

                Tables\Columns\TextColumn::make('total')
                    ->label('Сумма')
                    ->money('RUB')
                    ->sortable(),

                Tables\Columns\BadgeColumn::make('status')
                    ->label('Статус')
                    ->colors([
                        'warning' => 'new',
                        'info' => 'processing',
                        'primary' => 'shipped',
                        'success' => 'delivered',
                        'danger' => 'cancelled',
                    ])
                    ->formatStateUsing(fn ($state) => Order::getStatuses()[$state] ?? $state),

                Tables\Columns\BadgeColumn::make('payment_status')
                    ->label('Оплата')
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'paid',
                        'danger' => 'failed',
                    ])
                    ->formatStateUsing(fn ($state) => match($state) {
                        'pending' => 'Ожидает',
                        'paid' => 'Оплачен',
                        'failed' => 'Ошибка',
                        default => $state
                    }),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Дата создания')
                    ->dateTime('d.m.Y H:i')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Статус')
                    ->options(Order::getStatuses()),

                Tables\Filters\SelectFilter::make('payment_status')
                    ->label('Статус оплаты')
                    ->options([
                        'pending' => 'Ожидает оплаты',
                        'paid' => 'Оплачен',
                        'failed' => 'Ошибка оплаты',
                    ]),

                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('created_from')
                            ->label('С'),
                        Forms\Components\DatePicker::make('created_until')
                            ->label('По'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when($data['created_from'], fn ($q, $date) => 
                                $q->whereDate('created_at', '>=', $date)
                            )
                            ->when($data['created_until'], fn ($q, $date) => 
                                $q->whereDate('created_at', '<=', $date)
                            );
                    }),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Section::make('Информация о заказе')
                    ->schema([
                        Infolists\Components\TextEntry::make('order_number')
                            ->label('Номер заказа'),
                        Infolists\Components\TextEntry::make('status')
                            ->label('Статус')
                            ->badge()
                            ->formatStateUsing(fn ($state) => Order::getStatuses()[$state] ?? $state),
                        Infolists\Components\TextEntry::make('created_at')
                            ->label('Дата создания')
                            ->dateTime('d.m.Y H:i'),
                    ])->columns(3),

                Infolists\Components\Section::make('Покупатель')
                    ->schema([
                        Infolists\Components\TextEntry::make('customer_name')
                            ->label('Имя'),
                        Infolists\Components\TextEntry::make('customer_email')
                            ->label('Email'),
                        Infolists\Components\TextEntry::make('customer_phone')
                            ->label('Телефон'),
                        Infolists\Components\TextEntry::make('shipping_address')
                            ->label('Адрес доставки')
                            ->columnSpanFull(),
                    ])->columns(3),

                Infolists\Components\Section::make('Товары')
                    ->schema([
                        Infolists\Components\RepeatableEntry::make('items')
                            ->label('')
                            ->schema([
                                Infolists\Components\TextEntry::make('product_name')
                                    ->label('Товар'),
                                Infolists\Components\TextEntry::make('quantity')
                                    ->label('Кол-во'),
                                Infolists\Components\TextEntry::make('price')
                                    ->label('Цена')
                                    ->money('RUB'),
                                Infolists\Components\TextEntry::make('total')
                                    ->label('Сумма')
                                    ->money('RUB'),
                            ])
                            ->columns(4),
                    ]),

                Infolists\Components\Section::make('Итого')
                    ->schema([
                        Infolists\Components\TextEntry::make('subtotal')
                            ->label('Подытог')
                            ->money('RUB'),
                        Infolists\Components\TextEntry::make('shipping_cost')
                            ->label('Доставка')
                            ->money('RUB'),
                        Infolists\Components\TextEntry::make('discount')
                            ->label('Скидка')
                            ->money('RUB'),
                        Infolists\Components\TextEntry::make('total')
                            ->label('Итого')
                            ->money('RUB')
                            ->weight('bold')
                            ->size('lg'),
                    ])->columns(4),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'view' => Pages\ViewOrder::route('/{record}'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
