<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GelombangPpdbResource\Pages;
use App\Models\GelombangPpdb;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class GelombangPpdbResource extends Resource
{
    protected static ?string $model = GelombangPpdb::class;
    protected static ?string $navigationIcon = 'heroicon-o-clock';
    protected static ?string $navigationLabel = 'Gelombang PPDB';
    protected static ?string $navigationGroup = 'PPDB';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Gelombang')
                    ->schema([
                        Forms\Components\TextInput::make('nama_gelombang')
                            ->required()
                            ->maxLength(50),
                        Forms\Components\DatePicker::make('periode_mulai')
                            ->required(),
                        Forms\Components\DatePicker::make('periode_selesai')
                            ->required()
                            ->afterOrEqual('periode_mulai'),
                        Forms\Components\TextInput::make('kuota')
                            ->numeric()
                            ->minValue(0),
                        Forms\Components\TextInput::make('biaya_pendaftaran')
                            ->numeric()
                            ->prefix('Rp')
                            ->minValue(0),
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
                Tables\Columns\TextColumn::make('nama_gelombang')
                    ->searchable(),
                Tables\Columns\TextColumn::make('periode_mulai')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('periode_selesai')
                    ->date(),
                Tables\Columns\TextColumn::make('kuota'),
                Tables\Columns\TextColumn::make('biaya_pendaftaran')
                    ->money('IDR'),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean()
                    ->label('Aktif'),
                Tables\Columns\TextColumn::make('pendaftar_count')
                    ->label('Jumlah Pendaftar')
                    ->counts('pendaftar')
                    ->badge()
                    ->color('primary'),
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
            'index' => Pages\ListGelombangPpdbs::route('/'),
            'create' => Pages\CreateGelombangPpdb::route('/create'),
            'edit' => Pages\EditGelombangPpdb::route('/{record}/edit'),
        ];
    }
}
