<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GaleriVideoResource\Pages;
use App\Models\GaleriVideo;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class GaleriVideoResource extends Resource
{
    protected static ?string $model = GaleriVideo::class;
    protected static ?string $navigationIcon = 'heroicon-o-video-camera';
    protected static ?string $navigationLabel = 'Video Galeri';
    protected static ?string $navigationGroup = 'Galeri';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Video')
                    ->schema([
                        Forms\Components\TextInput::make('judul')
                            ->required()
                            ->maxLength(200),
                        Forms\Components\Textarea::make('deskripsi')
                            ->rows(3),
                        Forms\Components\TextInput::make('url_youtube')
                            ->label('URL YouTube')
                            ->url()
                            ->helperText('Contoh: https://www.youtube.com/watch?v=xxxxx atau https://youtu.be/xxxxx')
                            ->live(onBlur: true)
                            ->afterStateUpdated(function ($state, Forms\Set $set) {
                                // Extract YouTube ID
                                preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([\w-]+)/', $state, $matches);
                                if (isset($matches[1])) {
                                    $embedCode = '<iframe width="100%" height="315" src="https://www.youtube.com/embed/' . $matches[1] . '" frameborder="0" allowfullscreen></iframe>';
                                    $set('embed_code', $embedCode);
                                    $set('thumbnail', 'https://img.youtube.com/vi/' . $matches[1] . '/maxresdefault.jpg');
                                }
                            }),
                        Forms\Components\Hidden::make('embed_code'),
                        Forms\Components\Hidden::make('thumbnail'),
                        Forms\Components\DatePicker::make('tanggal')
                            ->default(now()),
                        Forms\Components\Toggle::make('is_active')
                            ->label('Aktif')
                            ->default(true),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('thumbnail')
                    ->label('Thumbnail')
                    ->width(120)
                    ->height(68),
                Tables\Columns\TextColumn::make('judul')
                    ->searchable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('tanggal')
                    ->date('d M Y')
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean()
                    ->label('Aktif'),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active'),
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
            'index' => Pages\ListGaleriVideos::route('/'),
            'create' => Pages\CreateGaleriVideo::route('/create'),
            'edit' => Pages\EditGaleriVideo::route('/{record}/edit'),
        ];
    }
}
