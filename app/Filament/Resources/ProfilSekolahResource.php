<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProfilSekolahResource\Pages;
use App\Models\ProfilSekolah;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProfilSekolahResource extends Resource
{
    protected static ?string $model = ProfilSekolah::class;
    protected static ?string $navigationIcon = 'heroicon-o-building-office';
    protected static ?string $navigationLabel = 'Profil Sekolah';
    protected static ?string $navigationGroup = 'Pengaturan Sekolah';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Profil Sekolah')
                    ->tabs([
                        // TAB 1: Informasi Dasar
                        Forms\Components\Tabs\Tab::make('Informasi Dasar')
                            ->schema([
                                Forms\Components\TextInput::make('nama_sekolah')
                                    ->label('Nama Sekolah')
                                    ->required()
                                    ->maxLength(200)
                                    ->columnSpanFull(),
                                Forms\Components\TextInput::make('npsn')
                                    ->label('NPSN')
                                    ->maxLength(20),
                                Forms\Components\TextInput::make('nss')
                                    ->label('NSS')
                                    ->maxLength(50),
                                Forms\Components\TextInput::make('akreditasi')
                                    ->label('Akreditasi')
                                    ->placeholder('Contoh: A, B, atau C')
                                    ->maxLength(50),
                                Forms\Components\TextInput::make('tahun_akreditasi')
                                    ->label('Tahun Akreditasi')
                                    ->numeric()
                                    ->minValue(1900)
                                    ->maxValue(date('Y')),
                                Forms\Components\FileUpload::make('logo')
                                    ->label('Logo Sekolah')
                                    ->image()
                                    ->directory('sekolah')
                                    ->helperText('Upload logo sekolah (ukuran: 200x200px)'),
                                Forms\Components\FileUpload::make('favicon')
                                    ->label('Favicon')
                                    ->image()
                                    ->directory('sekolah')
                                    ->helperText('Ikon yang tampil di tab browser (ukuran: 32x32px)'),
                            ])->columns(2),

                        // TAB 2: Alamat & Kontak
                        Forms\Components\Tabs\Tab::make('Alamat & Kontak')
                            ->schema([
                                Forms\Components\Textarea::make('alamat')
                                    ->label('Alamat Lengkap')
                                    ->rows(3)
                                    ->columnSpanFull(),
                                Forms\Components\TextInput::make('desa'),
                                Forms\Components\TextInput::make('kecamatan'),
                                Forms\Components\TextInput::make('kabupaten'),
                                Forms\Components\TextInput::make('provinsi'),
                                Forms\Components\TextInput::make('kode_pos'),
                                Forms\Components\TextInput::make('telepon')
                                    ->tel(),
                                Forms\Components\TextInput::make('email')
                                    ->email(),
                                Forms\Components\TextInput::make('website')
                                    ->url(),
                            ])->columns(2),

                        // TAB 3: Sejarah Sekolah
                        Forms\Components\Tabs\Tab::make('Sejarah')
                            ->icon('heroicon-o-clock')
                            ->schema([
                                Forms\Components\TextInput::make('tahun_berdiri')
                                    ->label('Tahun Berdiri')
                                    ->numeric()
                                    ->minValue(1900)
                                    ->maxValue(date('Y')),
                                Forms\Components\TextInput::make('pendiri')
                                    ->label('Pendiri Sekolah'),
                                Forms\Components\RichEditor::make('sejarah')
                                    ->label('Sejarah Sekolah')
                                    ->helperText('Tuliskan sejarah berdirinya sekolah secara lengkap')
                                    ->toolbarButtons([
                                        'bold',
                                        'italic',
                                        'underline',
                                        'strike',
                                        'bulletList',
                                        'orderedList',
                                        'link',
                                        'alignLeft',
                                        'alignCenter',
                                        'alignRight',
                                        'h2',
                                        'h3',
                                        'blockquote'
                                    ])
                                    ->columnSpanFull(),
                                Forms\Components\FileUpload::make('gambar_ilustrasi')
                                    ->label('Gambar Ilustrasi Sejarah')
                                    ->image()
                                    ->directory('sekolah/sejarah')
                                    ->helperText('Upload gambar ilustrasi untuk mempercantik halaman sejarah (ukuran: 800x500px)')
                                    ->columnSpanFull(),
                            ])->columns(2),

                        // TAB 4: Visi & Misi (Tanpa Petunjuk)
                        Forms\Components\Tabs\Tab::make('Visi & Misi')
                            ->icon('heroicon-o-eye')
                            ->schema([
                                Forms\Components\Section::make('Gambar Visi & Misi')
                                    ->schema([
                                        Forms\Components\FileUpload::make('gambar_misi_1')
                                            ->label('Gambar 1')
                                            ->image()
                                            ->directory('sekolah/visi-misi')
                                            ->helperText('Upload gambar pertama'),

                                        Forms\Components\FileUpload::make('gambar_misi_2')
                                            ->label('Gambar 2')
                                            ->image()
                                            ->directory('sekolah/visi-misi')
                                            ->helperText('Upload gambar kedua'),

                                        Forms\Components\FileUpload::make('gambar_misi_3')
                                            ->label('Gambar 3')
                                            ->image()
                                            ->directory('sekolah/visi-misi')
                                            ->helperText('Upload gambar ketiga'),
                                    ])->columns(1),
                            ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('logo')
                    ->circular(),
                Tables\Columns\TextColumn::make('nama_sekolah')
                    ->searchable(),
                Tables\Columns\TextColumn::make('npsn')
                    ->label('NPSN')
                    ->searchable(),
                Tables\Columns\TextColumn::make('akreditasi')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'A' => 'success',
                        'B' => 'warning',
                        'C' => 'danger',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('telepon'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProfilSekolahs::route('/'),
            'create' => Pages\CreateProfilSekolah::route('/create'),
            'edit' => Pages\EditProfilSekolah::route('/{record}/edit'),
        ];
    }
}
