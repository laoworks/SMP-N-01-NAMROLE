<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AlbumResource\Pages;
use App\Filament\Resources\AlbumResource\RelationManagers\FotoRelationManager;
use App\Models\Album;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class AlbumResource extends Resource
{
    protected static ?string $model = Album::class;

    // PERBAIKAN: Ganti dari 'heroicon-o-photo-album' menjadi 'heroicon-o-photo'
    protected static ?string $navigationIcon = 'heroicon-o-photo';

    protected static ?string $navigationLabel = 'Album Foto';
    protected static ?string $navigationGroup = 'Galeri';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Album')
                    ->schema([
                        Forms\Components\TextInput::make('nama_album')
                            ->required()
                            ->maxLength(100),
                        Forms\Components\RichEditor::make('deskripsi')
                            ->columnSpanFull(),
                        Forms\Components\DatePicker::make('tanggal')
                            ->default(now()),
                        Forms\Components\FileUpload::make('cover')
                            ->image()
                            ->directory('galeri/album-covers')
                            ->helperText('Cover album (opsional, jika tidak diisi akan menggunakan foto pertama)'),
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
                Tables\Columns\ImageColumn::make('cover')
                    ->square()
                    ->defaultImageUrl(function ($record) {
                        if ($record->cover) {
                            return asset('storage/' . $record->cover);
                        }
                        // Ambil foto pertama sebagai cover
                        $firstPhoto = $record->foto()->first();
                        if ($firstPhoto && $firstPhoto->foto) {
                            return asset('storage/' . $firstPhoto->foto);
                        }
                        return null;
                    }),
                Tables\Columns\TextColumn::make('nama_album')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tanggal')
                    ->date('d M Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('foto_count')
                    ->label('Jumlah Foto')
                    ->counts('foto')
                    ->badge()
                    ->color('success'),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean()
                    ->label('Aktif'),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Status Aktif'),
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

    public static function getRelations(): array
    {
        return [
            FotoRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAlbums::route('/'),
            'create' => Pages\CreateAlbum::route('/create'),
            'edit' => Pages\EditAlbum::route('/{record}/edit'),
        ];
    }
}
