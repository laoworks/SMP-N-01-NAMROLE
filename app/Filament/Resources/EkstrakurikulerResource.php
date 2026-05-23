<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EkstrakurikulerResource\Pages;
use App\Models\Ekstrakurikuler;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class EkstrakurikulerResource extends Resource
{
    protected static ?string $model = Ekstrakurikuler::class;
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationLabel = 'Ekstrakurikuler';
    protected static ?string $navigationGroup = 'Konten Website';
    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Ekskul')
                    ->schema([
                        Forms\Components\TextInput::make('nama_ekskul')
                            ->required()
                            ->maxLength(100),
                        Forms\Components\Select::make('pembina_id')
                            ->relationship('pembina', 'nama_lengkap')
                            ->searchable()
                            ->preload(),
                        Forms\Components\FileUpload::make('gambar')
                            ->image()
                            ->directory('ekskul'),
                        Forms\Components\TextInput::make('kuota')
                            ->numeric(),
                        Forms\Components\Toggle::make('is_active')
                            ->label('Aktif')
                            ->default(true),
                    ])->columns(2),

                Forms\Components\Section::make('Jadwal & Tempat')
                    ->schema([
                        Forms\Components\TextInput::make('jadwal_latihan')
                            ->placeholder('Contoh: Rabu & Jumat, 15:00 - 17:00')
                            ->maxLength(200),
                        Forms\Components\TextInput::make('tempat_latihan')
                            ->maxLength(100),
                    ])->columns(2),

                Forms\Components\Section::make('Deskripsi & Prestasi')
                    ->schema([
                        Forms\Components\RichEditor::make('deskripsi')
                            ->columnSpanFull(),
                        Forms\Components\RichEditor::make('prestasi')
                            ->label('Prestasi yang pernah diraih')
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('gambar'),
                Tables\Columns\TextColumn::make('nama_ekskul')
                    ->searchable(),
                Tables\Columns\TextColumn::make('pembina.nama_lengkap')
                    ->label('Pembina'),
                Tables\Columns\TextColumn::make('jadwal_latihan'),
                Tables\Columns\TextColumn::make('kuota'),
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEkstrakurikulers::route('/'),
            'create' => Pages\CreateEkstrakurikuler::route('/create'),
            'edit' => Pages\EditEkstrakurikuler::route('/{record}/edit'),
        ];
    }
}
