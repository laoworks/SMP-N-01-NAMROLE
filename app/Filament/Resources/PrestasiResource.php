<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PrestasiResource\Pages;
use App\Models\Prestasi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PrestasiResource extends Resource
{
    protected static ?string $model = Prestasi::class;
    protected static ?string $navigationIcon = 'heroicon-o-trophy';
    protected static ?string $navigationLabel = 'Prestasi';
    protected static ?string $navigationGroup = 'Konten Website';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('judul')
                    ->required()
                    ->maxLength(200),
                Forms\Components\Select::make('jenis')
                    ->options([
                        'akademik' => 'Akademik',
                        'non-akademik' => 'Non Akademik',
                    ]),
                Forms\Components\Select::make('tingkat')
                    ->options([
                        'kecamatan' => 'Kecamatan',
                        'kabupaten' => 'Kabupaten',
                        'provinsi' => 'Provinsi',
                        'nasional' => 'Nasional',
                        'internasional' => 'Internasional',
                    ]),
                Forms\Components\TextInput::make('juara')
                    ->maxLength(100),
                Forms\Components\TextInput::make('tahun')
                    ->numeric(),
                Forms\Components\TextInput::make('peserta_nama')
                    ->label('Nama Peserta')
                    ->maxLength(100),
                Forms\Components\TextInput::make('peserta_kelas')
                    ->label('Kelas')
                    ->maxLength(20),
                Forms\Components\FileUpload::make('sertifikat')
                    ->image()
                    ->directory('prestasi'),
                Forms\Components\FileUpload::make('foto')
                    ->image()
                    ->directory('prestasi'),
                Forms\Components\RichEditor::make('deskripsi')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('foto')
                    ->square(),
                Tables\Columns\TextColumn::make('judul')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tingkat')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'internasional' => 'success',
                        'nasional' => 'primary',
                        'provinsi' => 'info',
                        'kabupaten' => 'warning',
                        'kecamatan' => 'gray',
                    }),
                Tables\Columns\TextColumn::make('juara'),
                Tables\Columns\TextColumn::make('tahun')
                    ->sortable(),
                Tables\Columns\TextColumn::make('peserta_nama')
                    ->label('Peserta'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('tingkat'),
                Tables\Filters\SelectFilter::make('tahun'),
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
            'index' => Pages\ListPrestasis::route('/'),
            'create' => Pages\CreatePrestasi::route('/create'),
            'edit' => Pages\EditPrestasi::route('/{record}/edit'),
        ];
    }
}
