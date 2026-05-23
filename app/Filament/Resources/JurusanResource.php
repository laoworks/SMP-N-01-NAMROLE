<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JurusanResource\Pages;
use App\Models\Jurusan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class JurusanResource extends Resource
{
    protected static ?string $model = Jurusan::class;
    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationLabel = 'Jurusan';
    protected static ?string $navigationGroup = 'Akademik';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Jurusan')
                    ->schema([
                        Forms\Components\TextInput::make('kode_jurusan')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(20),
                        Forms\Components\TextInput::make('nama_jurusan')
                            ->required()
                            ->maxLength(100),
                        Forms\Components\TextInput::make('singkatan')
                            ->maxLength(20),
                        Forms\Components\FileUpload::make('gambar')
                            ->image()
                            ->directory('jurusan'),
                        Forms\Components\FileUpload::make('thumbnail')
                            ->image()
                            ->directory('jurusan'),
                        Forms\Components\Toggle::make('is_active')
                            ->label('Aktif')
                            ->default(true),
                        Forms\Components\TextInput::make('urutan')
                            ->numeric()
                            ->default(0),
                    ])->columns(2),

                Forms\Components\Section::make('Deskripsi')
                    ->schema([
                        Forms\Components\RichEditor::make('deskripsi')
                            ->columnSpanFull(),
                        Forms\Components\RichEditor::make('kurikulum')
                            ->label('Kurikulum')
                            ->columnSpanFull(),
                        Forms\Components\RichEditor::make('prospek_karir')
                            ->label('Prospek Karir')
                            ->columnSpanFull(),
                        Forms\Components\RichEditor::make('fasilitas')
                            ->label('Fasilitas Jurusan')
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('thumbnail')
                    ->circular(),
                Tables\Columns\TextColumn::make('kode_jurusan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama_jurusan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('singkatan')
                    ->badge(),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean()
                    ->label('Aktif'),
                Tables\Columns\TextColumn::make('urutan'),
            ])
            ->reorderable('urutan')
            ->defaultSort('urutan')
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
            'index' => Pages\ListJurusans::route('/'),
            'create' => Pages\CreateJurusan::route('/create'),
            'edit' => Pages\EditJurusan::route('/{record}/edit'),
        ];
    }
}
