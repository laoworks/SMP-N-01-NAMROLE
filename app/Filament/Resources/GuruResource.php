<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GuruResource\Pages;
use App\Models\Guru;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class GuruResource extends Resource
{
    protected static ?string $model = Guru::class;
    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationLabel = 'Guru & Staf';
    protected static ?string $navigationGroup = 'Manajemen Sekolah';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Data Pribadi')
                    ->schema([
                        Forms\Components\TextInput::make('nip')
                            ->label('NIP')
                            ->unique(ignoreRecord: true)
                            ->maxLength(50),
                        Forms\Components\TextInput::make('nuptk')
                            ->label('NUPTK')
                            ->maxLength(50),
                        Forms\Components\TextInput::make('nama_lengkap')
                            ->required()
                            ->maxLength(100),
                        Forms\Components\TextInput::make('gelar_depan')
                            ->maxLength(20),
                        Forms\Components\TextInput::make('gelar_belakang')
                            ->maxLength(20),
                        Forms\Components\Select::make('jenis_kelamin')
                            ->options([
                                'L' => 'Laki-laki',
                                'P' => 'Perempuan',
                            ]),
                        Forms\Components\TextInput::make('tempat_lahir')
                            ->maxLength(100),
                        Forms\Components\DatePicker::make('tanggal_lahir'),
                        Forms\Components\FileUpload::make('foto')
                            ->image()
                            ->directory('guru')
                            ->avatar(),
                    ])->columns(2),

                Forms\Components\Section::make('Pendidikan')
                    ->schema([
                        Forms\Components\TextInput::make('pendidikan_terakhir')
                            ->maxLength(100),
                        Forms\Components\TextInput::make('jurusan')
                            ->maxLength(100),
                        Forms\Components\TextInput::make('universitas')
                            ->maxLength(100),
                        Forms\Components\TextInput::make('tahun_lulus')
                            ->numeric(),
                        Forms\Components\TextInput::make('mata_pelajaran')
                            ->maxLength(100),
                    ])->columns(2),

                Forms\Components\Section::make('Kontak & Alamat')
                    ->schema([
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->maxLength(100),
                        Forms\Components\TextInput::make('telepon')
                            ->tel()
                            ->maxLength(20),
                        Forms\Components\Textarea::make('alamat')
                            ->rows(3)
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Informasi Lainnya')
                    ->schema([
                        Forms\Components\TextInput::make('jabatan')
                            ->maxLength(100),
                        Forms\Components\Select::make('status')
                            ->options([
                                'pns' => 'PNS',
                                'pppk' => 'PPPK',
                                'honorer' => 'Honorer',
                                'tetap_yayasan' => 'Tetap Yayasan',
                            ]),
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
                Tables\Columns\ImageColumn::make('foto')
                    ->circular(),
                Tables\Columns\TextColumn::make('nip')
                    ->label('NIP')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama_lengkap')
                    ->searchable(),
                Tables\Columns\TextColumn::make('mata_pelajaran'),
                Tables\Columns\TextColumn::make('jabatan')
                    ->badge(),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean()
                    ->label('Aktif'),
                Tables\Columns\TextColumn::make('telepon'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status'),
                Tables\Filters\SelectFilter::make('jabatan'),
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
            'index' => Pages\ListGurus::route('/'),
            'create' => Pages\CreateGuru::route('/create'),
            'edit' => Pages\EditGuru::route('/{record}/edit'),
        ];
    }
}
