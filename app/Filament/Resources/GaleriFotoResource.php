<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GaleriFotoResource\Pages;
use App\Models\GaleriFoto;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class GaleriFotoResource extends Resource
{
    protected static ?string $model = GaleriFoto::class;

    // PERBAIKAN: Ganti dengan ikon yang valid
    protected static ?string $navigationIcon = 'heroicon-o-photo';
    protected static ?string $navigationLabel = 'Semua Foto';
    protected static ?string $navigationGroup = 'Galeri';
    protected static ?int $navigationSort = 2;

    // Sembunyikan dari navigasi karena sudah ada di Relation Manager Album
    protected static bool $shouldRegisterNavigation = false;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Foto')
                    ->schema([
                        Forms\Components\Select::make('album_id')
                            ->relationship('album', 'nama_album')
                            ->required()
                            ->searchable()
                            ->preload(),
                        Forms\Components\TextInput::make('judul')
                            ->maxLength(200)
                            ->placeholder('Masukkan judul foto (opsional)'),
                        Forms\Components\Textarea::make('deskripsi')
                            ->rows(3)
                            ->placeholder('Deskripsi foto (opsional)'),
                        Forms\Components\FileUpload::make('foto')
                            ->required()
                            ->image()
                            ->directory('galeri/fotos')
                            ->imageEditor()
                            ->imageEditorAspectRatios(['16:9', '4:3', '1:1'])
                            ->helperText('Upload file gambar (JPG, PNG, WebP)')
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('urutan')
                            ->numeric()
                            ->default(0)
                            ->helperText('Semakin kecil angka, semakin atas posisinya'),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('foto')
                    ->label('Foto')
                    ->square()
                    ->width(80)
                    ->height(80),
                Tables\Columns\TextColumn::make('judul')
                    ->label('Judul')
                    ->searchable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('album.nama_album')
                    ->label('Album')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('deskripsi')
                    ->label('Deskripsi')
                    ->limit(50)
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('urutan')
                    ->label('Urutan')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('album_id')
                    ->label('Filter Album')
                    ->relationship('album', 'nama_album'),
            ])
            ->defaultSort('urutan', 'asc')
            ->reorderable('urutan')
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGaleriFotos::route('/'),
            'create' => Pages\CreateGaleriFoto::route('/create'),
            'edit' => Pages\EditGaleriFoto::route('/{record}/edit'),
        ];
    }
}
