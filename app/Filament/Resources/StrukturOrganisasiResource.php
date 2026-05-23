<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StrukturOrganisasiResource\Pages;
use App\Models\StrukturOrganisasi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class StrukturOrganisasiResource extends Resource
{
    protected static ?string $model = StrukturOrganisasi::class;

    // PERBAIKAN: Gunakan ikon yang pasti tersedia
    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';

    protected static ?string $navigationLabel = 'Struktur Organisasi';
    protected static ?string $navigationGroup = 'Konten Website';
    protected static ?int $navigationSort = 6;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Struktur Organisasi')
                    ->schema([
                        Forms\Components\TextInput::make('judul')
                            ->default('Struktur Organisasi Sekolah')
                            ->maxLength(200),
                        Forms\Components\FileUpload::make('gambar')
                            ->required()
                            ->image()
                            ->directory('struktur-organisasi')
                            ->helperText('Upload gambar bagan struktur organisasi (format JPG/PNG)')
                            ->columnSpanFull(),
                        Forms\Components\RichEditor::make('deskripsi')
                            ->helperText('Deskripsi tambahan (opsional)'),
                        Forms\Components\TextInput::make('tahun')
                            ->numeric()
                            ->default(date('Y')),
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
                Tables\Columns\TextColumn::make('judul'),
                Tables\Columns\ImageColumn::make('gambar'),
                Tables\Columns\TextColumn::make('tahun'),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
            ])
            ->defaultSort('tahun', 'desc')
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
            'index' => Pages\ListStrukturOrganisasis::route('/'),
            'create' => Pages\CreateStrukturOrganisasi::route('/create'),
            'edit' => Pages\EditStrukturOrganisasi::route('/{record}/edit'),
        ];
    }
}
