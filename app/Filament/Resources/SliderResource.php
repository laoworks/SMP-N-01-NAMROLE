<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SliderResource\Pages;
use App\Models\Slider;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SliderResource extends Resource
{
    protected static ?string $model = Slider::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    protected static ?string $navigationLabel = 'Slider';

    protected static ?string $navigationGroup = 'Website';

    protected static ?int $navigationSort = 1;

    /*
    |--------------------------------------------------------------------------
    | FORM
    |--------------------------------------------------------------------------
    */

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                /*
                |--------------------------------------------------------------------------
                | Informasi Slider
                |--------------------------------------------------------------------------
                */
                Forms\Components\Section::make('Informasi Slider')
                    ->schema([

                        Forms\Components\TextInput::make('judul')
                            ->label('Judul')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\Textarea::make('deskripsi')
                            ->label('Deskripsi')
                            ->rows(4)
                            ->columnSpanFull(),

                    ])
                    ->columns(1),

                /*
                |--------------------------------------------------------------------------
                | Upload Gambar
                |--------------------------------------------------------------------------
                */
                Forms\Components\Section::make('Gambar Slider')
                    ->schema([

                        Forms\Components\FileUpload::make('gambar')
                            ->label('Upload Gambar')

                            // IMAGE
                            ->image()

                            // STORAGE
                            ->disk('public')
                            ->directory('sliders')
                            ->visibility('public')

                            // PERFORMANCE
                            ->moveFiles()
                            ->preserveFilenames(false)

                            // IMAGE EDITOR
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                '16:9',
                                '4:3',
                                '1:1',
                            ])

                            // PREVIEW
                            ->previewable(true)
                            ->openable()
                            ->downloadable()

                            // VALIDATION
                            ->required()
                            ->maxSize(2048)

                            ->acceptedFileTypes([
                                'image/jpeg',
                                'image/png',
                                'image/webp',
                            ])

                            // UI
                            ->helperText('Format: JPG, PNG, WEBP. Maksimal 2MB')

                            ->columnSpanFull(),

                    ]),
            ]);
    }

    /*
    |--------------------------------------------------------------------------
    | TABLE
    |--------------------------------------------------------------------------
    */

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\ImageColumn::make('gambar')
                    ->label('Gambar')
                    ->square()
                    ->height(80),

                Tables\Columns\TextColumn::make('judul')
                    ->label('Judul')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y H:i'),

            ])

            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])

            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public static function getRelations(): array
    {
        return [];
    }

    /*
    |--------------------------------------------------------------------------
    | PAGES
    |--------------------------------------------------------------------------
    */

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSliders::route('/'),
            'create' => Pages\CreateSlider::route('/create'),
            'edit' => Pages\EditSlider::route('/{record}/edit'),
        ];
    }
}
