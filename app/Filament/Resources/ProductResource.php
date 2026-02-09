<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Repeater;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;
    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';
    protected static ?string $navigationLabel = 'Товары';
    protected static ?string $navigationGroup = 'Каталог';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Товар')
                    ->tabs([
                        Forms\Components\Tabs\Tab::make('Основная информация')
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->label('Название')
                                    ->required()
                                    ->maxLength(255)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn ($state, callable $set) => 
                                        $set('slug', \Str::slug($state))
                                    ),

                                Forms\Components\TextInput::make('sku')
                                    ->label('Артикул')
                                    ->required()
                                    ->unique(ignoreRecord: true)
                                    ->maxLength(255),

                                Forms\Components\Select::make('category_id')
                                    ->label('Категория')
                                    ->relationship('category', 'name')
                                    ->required()
                                    ->searchable()
                                    ->preload(),

                                Forms\Components\Select::make('brand_id')
                                    ->label('Бренд')
                                    ->relationship('brand', 'name')
                                    ->searchable()
                                    ->preload()
                                    ->createOptionForm([
                                        Forms\Components\TextInput::make('name')
                                            ->required(),
                                    ]),

                                Forms\Components\RichEditor::make('description')
                                    ->label('Описание')
                                    ->columnSpanFull()
                                    ->toolbarButtons([
                                        'bold',
                                        'bulletList',
                                        'orderedList',
                                        'h2',
                                        'h3',
                                        'italic',
                                        'link',
                                        'redo',
                                        'undo',
                                    ]),
                            ]),

                        Forms\Components\Tabs\Tab::make('Цены и склад')
                            ->schema([
                                Forms\Components\TextInput::make('price')
                                    ->label('Цена')
                                    ->required()
                                    ->numeric()
                                    ->prefix('₽')
                                    ->minValue(0),

                                Forms\Components\TextInput::make('old_price')
                                    ->label('Старая цена')
                                    ->numeric()
                                    ->prefix('₽')
                                    ->helperText('Отображается перечеркнутой'),

                                Forms\Components\TextInput::make('stock')
                                    ->label('Количество на складе')
                                    ->required()
                                    ->numeric()
                                    ->minValue(0)
                                    ->default(0),

                                Forms\Components\TextInput::make('min_order_quantity')
                                    ->label('Минимальное количество для заказа')
                                    ->numeric()
                                    ->default(1)
                                    ->minValue(1),

                                Forms\Components\TextInput::make('unit')
                                    ->label('Единица измерения')
                                    ->default('шт.')
                                    ->maxLength(10),
                            ])->columns(2),

                        Forms\Components\Tabs\Tab::make('Изображения')
                            ->schema([
                                Repeater::make('images')
                                    ->label('Изображения товара')
                                    ->relationship('images')
                                    ->schema([
                                        Forms\Components\FileUpload::make('image_path')
                                            ->label('Изображение')
                                            ->image()
                                            ->directory('products')
                                            ->imageEditor()
                                            ->required(),

                                        Forms\Components\TextInput::make('order')
                                            ->label('Порядок')
                                            ->numeric()
                                            ->default(0),

                                        Forms\Components\Toggle::make('is_primary')
                                            ->label('Главное изображение')
                                            ->default(false),
                                    ])
                                    ->columns(3)
                                    ->defaultItems(1)
                                    ->reorderable()
                                    ->collapsible(),
                            ]),

                        Forms\Components\Tabs\Tab::make('Характеристики')
                            ->schema([
                                Forms\Components\KeyValue::make('features')
                                    ->label('Характеристики')
                                    ->keyLabel('Название')
                                    ->valueLabel('Значение')
                                    ->reorderable()
                                    ->addActionLabel('Добавить характеристику'),
                            ]),

                        Forms\Components\Tabs\Tab::make('SEO и настройки')
                            ->schema([
                                Forms\Components\Toggle::make('is_featured')
                                    ->label('Хит продаж')
                                    ->default(false),

                                Forms\Components\Toggle::make('is_new')
                                    ->label('Новинка')
                                    ->default(false),

                                Forms\Components\Toggle::make('is_active')
                                    ->label('Активен')
                                    ->default(true),

                                Forms\Components\TextInput::make('slug')
                                    ->label('URL (slug)')
                                    ->required()
                                    ->unique(ignoreRecord: true)
                                    ->maxLength(255),
                            ])->columns(2),
                    ])
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Фото')
                    ->circular()
                    ->getStateUsing(function ($record) {
                        $primaryImage = $record->primaryImage();
                        return $primaryImage ? $primaryImage->image_path : null;
                    })
                    ->defaultImageUrl(url('/images/no-image.png')),

                Tables\Columns\TextColumn::make('name')
                    ->label('Название')
                    ->searchable()
                    ->sortable()
                    ->limit(40),

                Tables\Columns\TextColumn::make('sku')
                    ->label('Артикул')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('category.name')
                    ->label('Категория')
                    ->sortable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('brand.name')
                    ->label('Бренд')
                    ->sortable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('price')
                    ->label('Цена')
                    ->money('RUB')
                    ->sortable(),

                Tables\Columns\TextColumn::make('stock')
                    ->label('Склад')
                    ->sortable()
                    ->badge()
                    ->color(fn ($state) => $state > 10 ? 'success' : ($state > 0 ? 'warning' : 'danger')),

                Tables\Columns\IconColumn::make('is_featured')
                    ->label('Хит')
                    ->boolean()
                    ->toggleable(),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Активен')
                    ->boolean(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Создан')
                    ->dateTime('d.m.Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category_id')
                    ->label('Категория')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload(),

                Tables\Filters\SelectFilter::make('brand_id')
                    ->label('Бренд')
                    ->relationship('brand', 'name')
                    ->searchable()
                    ->preload(),

                Tables\Filters\TernaryFilter::make('is_featured')
                    ->label('Хиты продаж'),

                Tables\Filters\TernaryFilter::make('is_new')
                    ->label('Новинки'),

                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Активность'),

                Tables\Filters\Filter::make('out_of_stock')
                    ->label('Нет в наличии')
                    ->query(fn ($query) => $query->where('stock', 0)),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
