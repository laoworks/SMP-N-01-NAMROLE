<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KalenderAkademikResource\Pages;
use App\Models\KalenderAkademik;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class KalenderAkademikResource extends Resource
{
    protected static ?string $model = KalenderAkademik::class;
    protected static ?string $navigationIcon = 'heroicon-o-calendar';
    protected static ?string $navigationLabel = 'Kalender Akademik';
    protected static ?string $navigationGroup = 'Akademik';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Kegiatan')
                    ->schema([
                        Forms\Components\TextInput::make('judul_kegiatan')
                            ->required()
                            ->maxLength(200),
                        Forms\Components\RichEditor::make('deskripsi')
                            ->columnSpanFull(),
                        Forms\Components\DatePicker::make('tanggal_mulai')
                            ->required(),
                        Forms\Components\DatePicker::make('tanggal_selesai')
                            ->afterOrEqual('tanggal_mulai'),
                        Forms\Components\TextInput::make('waktu')
                            ->placeholder('Contoh: 08:00 - 12:00 WIB')
                            ->maxLength(50),
                        Forms\Components\TextInput::make('tempat')
                            ->maxLength(100),
                    ])->columns(2),

                Forms\Components\Section::make('Pengaturan')
                    ->schema([
                        Forms\Components\Select::make('jenis')
                            ->options([
                                'kegiatan' => 'Kegiatan',
                                'ujian' => 'Ujian',
                                'libur' => 'Libur',
                                'rapat' => 'Rapat',
                                'pendaftaran' => 'Pendaftaran',
                            ])
                            ->required(),
                        Forms\Components\TextInput::make('target_audience')
                            ->placeholder('Contoh: Seluruh Siswa, Guru, Orang Tua')
                            ->maxLength(100),
                        Forms\Components\ColorPicker::make('warna')
                            ->default('#3b82f6'),
                        Forms\Components\Toggle::make('is_published')
                            ->label('Publikasikan')
                            ->default(true),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('judul_kegiatan')
                    ->searchable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('jenis')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'kegiatan' => 'info',
                        'ujian' => 'warning',
                        'libur' => 'danger',
                        'rapat' => 'primary',
                        'pendaftaran' => 'success',
                    }),
                Tables\Columns\TextColumn::make('tanggal_mulai')
                    ->date('d M Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('tanggal_selesai')
                    ->date('d M Y'),
                Tables\Columns\TextColumn::make('tempat'),
                Tables\Columns\ColorColumn::make('warna'),
                Tables\Columns\IconColumn::make('is_published')
                    ->boolean()
                    ->label('Published'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('jenis'),
                Tables\Filters\TernaryFilter::make('is_published'),
                Tables\Filters\Filter::make('tanggal_mulai')
                    ->form([
                        Forms\Components\DatePicker::make('dari_tanggal'),
                        Forms\Components\DatePicker::make('sampai_tanggal'),
                    ]),
            ])
            ->defaultSort('tanggal_mulai', 'asc')
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
            'index' => Pages\ListKalenderAkademiks::route('/'),
            'create' => Pages\CreateKalenderAkademik::route('/create'),
            'edit' => Pages\EditKalenderAkademik::route('/{record}/edit'),
        ];
    }
}
