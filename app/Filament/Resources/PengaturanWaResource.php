<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PengaturanWaResource\Pages;
use App\Models\PengaturanWa;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PengaturanWaResource extends Resource
{
    protected static ?string $model = PengaturanWa::class;
    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';
    protected static ?string $navigationLabel = 'WhatsApp Gateway';
    protected static ?string $navigationGroup = 'Pengaturan';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Pengaturan WhatsApp')
                    ->schema([
                        Forms\Components\TextInput::make('nomor_wa')
                            ->required()
                            ->prefix('+62')
                            ->placeholder('81234567890')
                            ->helperText('Masukkan nomor WhatsApp dengan format 81234567890 (tanpa 0 di depan)')
                            ->maxLength(20),
                        Forms\Components\Textarea::make('pesan_otomatis')
                            ->rows(5)
                            ->helperText('Pesan otomatis yang akan dikirim saat user mengklik tombol WhatsApp'),
                        Forms\Components\Toggle::make('is_active')
                            ->label('Aktifkan Tombol WhatsApp')
                            ->default(true),
                    ]),

                Forms\Components\Section::make('Preview Tombol WhatsApp')
                    ->schema([
                        Forms\Components\Placeholder::make('preview')
                            ->label('')
                            ->content(function (Forms\Get $get) {
                                $nomor = $get('nomor_wa') ?: '81234567890';
                                $pesan = $get('pesan_otomatis') ?: 'Halo, saya ingin bertanya tentang...';
                                $encodedMessage = urlencode($pesan);
                                return view('filament.preview.whatsapp-button', compact('nomor', 'encodedMessage'));
                            }),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nomor_wa')
                    ->label('Nomor WhatsApp'),
                Tables\Columns\TextColumn::make('pesan_otomatis')
                    ->limit(50),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean()
                    ->label('Aktif'),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Terakhir Update')
                    ->since(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPengaturanWas::route('/'),
            'edit' => Pages\EditPengaturanWa::route('/{record}/edit'),
        ];
    }
}
