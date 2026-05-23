<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PendaftarResource\Pages;
use App\Models\Pendaftar;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PendaftarResource extends Resource
{
    protected static ?string $model = Pendaftar::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Pendaftar';
    protected static ?string $navigationGroup = 'PPDB';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Wizard::make([
                    Forms\Components\Wizard\Step::make('Data Pribadi')
                        ->schema([
                            Forms\Components\TextInput::make('no_pendaftaran')
                                ->default(function () {
                                    return 'PPDB-' . date('Y') . '-' . Str::random(8);
                                })
                                ->disabled()
                                ->dehydrated(),
                            Forms\Components\Select::make('gelombang_id')
                                ->relationship('gelombang', 'nama_gelombang')
                                ->required(),
                            Forms\Components\TextInput::make('nama_lengkap')
                                ->required(),
                            Forms\Components\TextInput::make('nik'),
                            Forms\Components\Select::make('jenis_kelamin')
                                ->options(['L' => 'Laki-laki', 'P' => 'Perempuan']),
                            Forms\Components\TextInput::make('tempat_lahir'),
                            Forms\Components\DatePicker::make('tanggal_lahir'),
                            Forms\Components\TextInput::make('agama'),
                        ])->columns(2),

                    Forms\Components\Wizard\Step::make('Kontak & Alamat')
                        ->schema([
                            Forms\Components\TextInput::make('email')
                                ->email(),
                            Forms\Components\TextInput::make('no_hp')
                                ->required(),
                            Forms\Components\Textarea::make('alamat'),
                            Forms\Components\TextInput::make('rt_rw'),
                            Forms\Components\TextInput::make('kelurahan'),
                            Forms\Components\TextInput::make('kecamatan'),
                            Forms\Components\TextInput::make('kota'),
                            Forms\Components\TextInput::make('provinsi'),
                        ])->columns(2),

                    Forms\Components\Wizard\Step::make('Pendidikan Asal')
                        ->schema([
                            Forms\Components\TextInput::make('asal_sekolah'),
                            Forms\Components\TextInput::make('nisn'),
                            Forms\Components\TextInput::make('tahun_lulus'),
                            Forms\Components\TextInput::make('ijazah_number'),
                        ])->columns(2),

                    Forms\Components\Wizard\Step::make('Data Orang Tua')
                        ->schema([
                            Forms\Components\TextInput::make('ayah_nama'),
                            Forms\Components\TextInput::make('ayah_pekerjaan'),
                            Forms\Components\TextInput::make('ayah_pendidikan'),
                            Forms\Components\TextInput::make('ayah_no_hp'),
                            Forms\Components\TextInput::make('ibu_nama'),
                            Forms\Components\TextInput::make('ibu_pekerjaan'),
                            Forms\Components\TextInput::make('ibu_pendidikan'),
                            Forms\Components\TextInput::make('ibu_no_hp'),
                            Forms\Components\TextInput::make('wali_nama'),
                            Forms\Components\TextInput::make('wali_pekerjaan'),
                            Forms\Components\TextInput::make('wali_hubungan'),
                        ])->columns(2),

                    Forms\Components\Wizard\Step::make('Pilihan Jurusan')
                        ->schema([
                            Forms\Components\Select::make('jurusan_pilihan_1')
                                ->relationship('jurusanPilihan1', 'nama_jurusan')
                                ->required(),
                            Forms\Components\Select::make('jurusan_pilihan_2')
                                ->relationship('jurusanPilihan2', 'nama_jurusan'),
                        ])->columns(2),

                    Forms\Components\Wizard\Step::make('Dokumen')
                        ->schema([
                            Forms\Components\FileUpload::make('foto_kk')
                                ->image()
                                ->directory('ppdb/dokumen'),
                            Forms\Components\FileUpload::make('foto_akte')
                                ->image()
                                ->directory('ppdb/dokumen'),
                            Forms\Components\FileUpload::make('foto_ijazah')
                                ->image()
                                ->directory('ppdb/dokumen'),
                            Forms\Components\FileUpload::make('foto_nilai')
                                ->image()
                                ->directory('ppdb/dokumen'),
                            Forms\Components\FileUpload::make('foto_sertifikat')
                                ->image()
                                ->directory('ppdb/dokumen'),
                        ])->columns(2),

                    Forms\Components\Wizard\Step::make('Verifikasi')
                        ->schema([
                            Forms\Components\Select::make('status_verifikasi')
                                ->options([
                                    'pending' => 'Pending',
                                    'verifikasi' => 'Verifikasi',
                                    'diterima' => 'Diterima',
                                    'cadangan' => 'Cadangan',
                                    'ditolak' => 'Ditolak',
                                ])
                                ->required(),
                            Forms\Components\Textarea::make('keterangan'),
                            Forms\Components\Select::make('verifikator_id')
                                ->relationship('verifikator', 'name')
                                ->searchable(),
                        ])->columns(2),
                ])->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('no_pendaftaran')
                    ->searchable()
                    ->copyable(),
                Tables\Columns\TextColumn::make('nama_lengkap')
                    ->searchable(),
                Tables\Columns\TextColumn::make('gelombang.nama_gelombang'),
                Tables\Columns\TextColumn::make('jurusanPilihan1.nama_jurusan')
                    ->label('Jurusan Pilihan'),
                Tables\Columns\TextColumn::make('status_verifikasi')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'pending' => 'gray',
                        'verifikasi' => 'warning',
                        'diterima' => 'success',
                        'cadangan' => 'info',
                        'ditolak' => 'danger',
                    }),
                Tables\Columns\TextColumn::make('no_hp'),
                Tables\Columns\TextColumn::make('tanggal_daftar')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('gelombang_id')
                    ->relationship('gelombang', 'nama_gelombang'),
                Tables\Filters\SelectFilter::make('status_verifikasi'),
                Tables\Filters\SelectFilter::make('jurusan_pilihan_1')
                    ->relationship('jurusanPilihan1', 'nama_jurusan'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\Action::make('verifikasi')
                    ->icon('heroicon-o-check-badge')
                    ->color('success')
                    ->form([
                        Forms\Components\Select::make('status_verifikasi')
                            ->options([
                                'diterima' => 'Diterima',
                                'cadangan' => 'Cadangan',
                                'ditolak' => 'Ditolak',
                            ])
                            ->required(),
                        Forms\Components\Textarea::make('keterangan'),
                    ])
                    ->action(function (Pendaftar $record, array $data): void {
                        $record->update([
                            'status_verifikasi' => $data['status_verifikasi'],
                            'keterangan' => $data['keterangan'],
                            'tanggal_verifikasi' => now(),
                            'verifikator_id' => Auth::id(),
                        ]);
                    }),
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
            'index' => Pages\ListPendaftars::route('/'),
            'create' => Pages\CreatePendaftar::route('/create'),
            'edit' => Pages\EditPendaftar::route('/{record}/edit'),
        ];
    }
}
