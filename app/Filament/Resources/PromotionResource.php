<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PromotionResource\Pages;
use App\Models\Promotion;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PromotionResource extends Resource
{
    protected static ?string $model = Promotion::class;
    protected static ?string $navigationIcon = 'heroicon-o-gift';
    protected static ?string $navigationLabel = 'Акции';
    protected static ?string $navigationGroup = 'Маркетинг';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Основная информация')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Название')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn ($state, callable $set) => 
                                $set('slug', \Str::slug($state))
                            ),

                        Forms\Components\TextInput::make('slug')
                            ->label('URL (slug)')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),

                        Forms\Components\Textarea::make('description')
                            ->label('Описание')
                            ->rows(3)
                            ->columnSpanFull(),
                    ])->columns(2),

                Forms\Components\Section::make('Медиа')
                    ->schema([
                        Forms\Components\FileUpload::make('image')
                            ->label('Изображение')
                            ->image()
                            ->directory('promotions')
                            ->imageEditor(),
                    ]),

                Forms\Components\Section::make('Настройки скидки')
                    ->schema([
                        Forms\Components\Select::make('discount_type')
                            ->label('Тип скидки')
                            ->options([
                                'percent' => 'Процент',
                                'fixed' => 'Фиксированная сумма',
                            ])
                            ->required()
                            ->live()
                            ->afterStateUpdated(function ($state, callable $get, callable $set) {
                                if ($state === 'percent') {
                                    $set('discount_value', $get('discount_value') / 100);
                                } else {
                                    $set('discount_value', $get('discount_value') * 100);
                                }
                            }),

                        Forms\Components\TextInput::make('discount_value')
                            ->label('Значение скидки')
                            ->required()
                            ->numeric()
                            ->prefix(fn ($get) => $get('discount_type') === 'percent' ? '%' : '₽')
                            ->minValue(0),
                    ])->columns(2),

                Forms\Components\Section::make('Период действия')
                    ->schema([
                        Forms\Components\DatePicker::make('start_date')
                            ->label('Дата начала')
                            ->required(),

                        Forms\Components\DatePicker::make('end_date')
                            ->label('Дата окончания')
                            ->required(),

                        Forms\Components\Toggle::make('is_active')
                            ->label('Активна')
                            ->default(true),
                    ])->columns(2),

                Forms\Components\Section::make('Товары')
                    ->schema([
                        Forms\Components\Select::make('products')
                            ->label('Выберите товары для акции')
                            ->relationship('products', 'name')
                            ->multiple()
                            ->searchable()
                            ->preload()
                            ->helperText('Выберите товары, которые участвуют в акции'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Изображение'),

                Tables\Columns\TextColumn::make('name')
                    ->label('Название')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('discount_type')
                    ->label('Тип')
                    ->sortable()
                    ->formatStateUsing(fn ($state) => $state === 'percent' ? '%' : '₽'),

                Tables\Columns\TextColumn::make('discount_value')
                    ->label('Скидка')
                    ->sortable()
                    ->formatStateUsing(fn ($state, $record) => 
                        $record->discount_type === 'percent' 
                            ? $state . '%' 
                            : number_format($state, 0, ',', ' ') . ' ₽'
                    ),

                Tables\Columns\TextColumn::make('start_date')
                    ->label('Начало')
                    ->date('d.m.Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('end_date')
                    ->label('Окончание')
                    ->date('d.m.Y')
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Активна')
                    ->boolean(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Создана')
                    ->dateTime('d.m.Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('discount_type')
                    ->label('Тип скидки')
                    ->options([
                        'percent' => 'Процент',
                        'fixed' => 'Фиксированная сумма',
                    ]),

                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Активность'),
            ])
            ->actions([
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
            'index' => Pages\ListPromotions::route('/'),
            'create' => Pages\CreatePromotion::route('/create'),
            'edit' => Pages\EditPromotion::route('/{record}/edit'),
        ];
    }
}
