<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BannerResource\Pages;
use App\Models\Banner;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class BannerResource extends Resource
{
    protected static ?string $model = Banner::class;
    protected static ?string $navigationIcon = 'heroicon-o-photo';
    protected static ?string $navigationLabel = 'Баннеры';
    protected static ?string $navigationGroup = 'Контент';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Основная информация')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Заголовок')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\Textarea::make('description')
                            ->label('Описание')
                            ->rows(2)
                            ->columnSpanFull(),
                    ])->columns(2),

                Forms\Components\Section::make('Медиа и ссылка')
                    ->schema([
                        Forms\Components\FileUpload::make('image')
                            ->label('Изображение')
                            ->image()
                            ->directory('banners')
                            ->imageEditor()
                            ->required(),

                        Forms\Components\TextInput::make('button_text')
                            ->label('Текст кнопки')
                            ->maxLength(255)
                            ->nullable()
                            ->helperText('Текст на кнопке действия'),

                        Forms\Components\TextInput::make('button_url')
                            ->label('Ссылка кнопки')
                            ->url()
                            ->nullable()
                            ->helperText('URL для кнопки'),
                    ])->columns(2),

                Forms\Components\Section::make('Настройки')
                    ->schema([
                        Forms\Components\Select::make('position')
                            ->label('Позиция')
                            ->options([
                                'main_slider' => 'Главный слайдер',
                                'category_top' => 'Верх категории',
                                'sidebar' => 'Боковая панель',
                                'footer' => 'Подвал',
                            ])
                            ->required(),

                        Forms\Components\TextInput::make('order')
                            ->label('Порядок')
                            ->numeric()
                            ->default(0),

                        Forms\Components\DatePicker::make('start_date')
                            ->label('Дата начала')
                            ->nullable(),

                        Forms\Components\DatePicker::make('end_date')
                            ->label('Дата окончания')
                            ->nullable(),

                        Forms\Components\Toggle::make('is_active')
                            ->label('Активен')
                            ->default(true),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Изображение'),

                Tables\Columns\TextColumn::make('title')
                    ->label('Заголовок')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('position')
                    ->label('Позиция')
                    ->sortable()
                    ->formatStateUsing(fn ($state) => match($state) {
                        'main_slider' => 'Главный слайдер',
                        'category_top' => 'Верх категории',
                        'sidebar' => 'Боковая панель',
                        'footer' => 'Подвал',
                        default => $state
                    }),

                Tables\Columns\TextColumn::make('order')
                    ->label('Порядок')
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Активен')
                    ->boolean(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Создан')
                    ->dateTime('d.m.Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('order')
            ->filters([
                Tables\Filters\SelectFilter::make('position')
                    ->label('Позиция')
                    ->options([
                        'main_slider' => 'Главный слайдер',
                        'category_top' => 'Верх категории',
                        'sidebar' => 'Боковая панель',
                        'footer' => 'Подвал',
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
            'index' => Pages\ListBanners::route('/'),
            'create' => Pages\CreateBanner::route('/create'),
            'edit' => Pages\EditBanner::route('/{record}/edit'),
        ];
    }
}
