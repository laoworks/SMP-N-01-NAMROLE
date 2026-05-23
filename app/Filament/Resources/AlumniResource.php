<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AlumniResource\Pages;
use App\Models\Alumni;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class AlumniResource extends Resource
{
    protected static ?string $model = Alumni::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationLabel = 'Alumni';
    protected static ?string $navigationGroup = 'Manajemen Sekolah';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Data Diri')
                    ->schema([
                        Forms\Components\TextInput::make('nama_lengkap')
                            ->required()
                            ->maxLength(100),
                        Forms\Components\TextInput::make('tahun_lulus')
                            ->numeric()
                            ->minValue(1900)
                            ->maxValue(date('Y')),
                        Forms\Components\Select::make('jurusan_id')
                            ->relationship('jurusan', 'nama_jurusan')
                            ->searchable()
                            ->preload(),
                        Forms\Components\FileUpload::make('foto')
                            ->image()
                            ->directory('alumni')
                            ->avatar(),
                    ])->columns(2),

                Forms\Components\Section::make('Pendidikan Lanjutan')
                    ->schema([
                        Forms\Components\TextInput::make('universitas')
                            ->maxLength(100),
                        Forms\Components\TextInput::make('jurusan_kuliah')
                            ->maxLength(100),
                        Forms\Components\TextInput::make('tahun_masuk_kuliah')
                            ->numeric(),
                    ])->columns(2),

                Forms\Components\Section::make('Pekerjaan')
                    ->schema([
                        Forms\Components\TextInput::make('pekerjaan')
                            ->maxLength(100),
                        Forms\Components\TextInput::make('perusahaan')
                            ->maxLength(100),
                        Forms\Components\TextInput::make('posisi')
                            ->maxLength(100),
                    ])->columns(2),

                Forms\Components\Section::make('Kontak')
                    ->schema([
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->maxLength(100),
                        Forms\Components\TextInput::make('no_hp')
                            ->tel()
                            ->maxLength(20),
                        Forms\Components\TextInput::make('linkedin')
                            ->url()
                            ->maxLength(100),
                    ])->columns(2),

                Forms\Components\Section::make('Kisah Sukses')
                    ->schema([
                        Forms\Components\RichEditor::make('kisah_sukses')
                            ->columnSpanFull(),
                        Forms\Components\RichEditor::make('prestasi_alumni')
                            ->label('Prestasi')
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Pengaturan Tampilan')
                    ->schema([
                        Forms\Components\Toggle::make('is_featured')
                            ->label('Tampilkan di Halaman Utama')
                            ->helperText('Alumni akan ditampilkan di slider testimonial homepage'),
                        Forms\Components\Toggle::make('is_verified')
                            ->label('Data Terverifikasi')
                            ->default(false),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('foto')
                    ->circular(),
                Tables\Columns\TextColumn::make('nama_lengkap')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tahun_lulus')
                    ->sortable(),
                Tables\Columns\TextColumn::make('jurusan.nama_jurusan')
                    ->label('Jurusan'),
                Tables\Columns\TextColumn::make('pekerjaan'),
                Tables\Columns\TextColumn::make('perusahaan'),
                Tables\Columns\IconColumn::make('is_featured')
                    ->boolean()
                    ->label('Featured'),
                Tables\Columns\IconColumn::make('is_verified')
                    ->boolean()
                    ->label('Verified'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('tahun_lulus'),
                Tables\Filters\SelectFilter::make('jurusan_id')
                    ->relationship('jurusan', 'nama_jurusan'),
                Tables\Filters\TernaryFilter::make('is_featured'),
                Tables\Filters\TernaryFilter::make('is_verified'),
            ])
            ->defaultSort('tahun_lulus', 'desc')
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
            'index' => Pages\ListAlumnis::route('/'),
            'create' => Pages\CreateAlumni::route('/create'),
            'edit' => Pages\EditAlumni::route('/{record}/edit'),
        ];
    }
}
