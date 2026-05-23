<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PengaturanWebsiteResource\Pages;
use App\Models\PengaturanWebsite;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Cache;

class PengaturanWebsiteResource extends Resource
{
    protected static ?string $model = PengaturanWebsite::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog-8-tooth';

    protected static ?string $navigationLabel = 'Pengaturan Website';

    protected static ?string $navigationGroup = 'Pengaturan';

    protected static ?int $navigationSort = 1;

    /*
    |--------------------------------------------------------------------------
    | Hanya 1 Record
    |--------------------------------------------------------------------------
    */
    public static function canCreate(): bool
    {
        return false;
    }

    public static function canDelete($record): bool
    {
        return false;
    }

    /*
    |--------------------------------------------------------------------------
    | Form
    |--------------------------------------------------------------------------
    */
    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                /*
                |--------------------------------------------------------------------------
                | Informasi Website
                |--------------------------------------------------------------------------
                */
                Forms\Components\Section::make('Informasi Website')
                    ->schema([
                        Forms\Components\TextInput::make('nama_website')
                            ->label('Nama Website')
                            ->required()
                            ->maxLength(100)
                            ->live(onBlur: true)
                            ->helperText('Nama website yang tampil pada header dan browser tab'),
                    ]),

                /*
                |--------------------------------------------------------------------------
                | Warna
                |--------------------------------------------------------------------------
                */
                Forms\Components\Section::make('Warna Website')
                    ->schema([
                        Forms\Components\ColorPicker::make('primary_color')
                            ->label('Warna Utama')
                            ->default('#4361ee')
                            ->live(onBlur: true)
                            ->helperText('Warna utama tema website'),
                    ]),

                /*
                |--------------------------------------------------------------------------
                | Logo & Favicon
                |--------------------------------------------------------------------------
                */
                Forms\Components\Section::make('Logo & Favicon')
                    ->schema([

                        /*
                        |--------------------------------------------------------------------------
                        | Logo Besar
                        |--------------------------------------------------------------------------
                        */
                        Forms\Components\FileUpload::make('logo')
                            ->label('Logo Website')
                            ->image()
                            ->imageEditor()
                            ->directory('website')
                            ->disk('public')
                            ->visibility('public')
                            ->preserveFilenames()
                            ->maxSize(1024)
                            ->helperText('Gunakan PNG transparan ukuran kecil (< 100KB)')
                            ->downloadable()
                            ->openable()
                            ->previewable(true),

                        /*
                        |--------------------------------------------------------------------------
                        | Logo Small
                        |--------------------------------------------------------------------------
                        */
                        Forms\Components\FileUpload::make('logo_small')
                            ->label('Logo Sidebar / Mobile')
                            ->image()
                            ->imageEditor()
                            ->directory('website')
                            ->disk('public')
                            ->visibility('public')
                            ->preserveFilenames()
                            ->maxSize(512)
                            ->downloadable()
                            ->openable()
                            ->previewable(true),

                        /*
                        |--------------------------------------------------------------------------
                        | Favicon
                        |--------------------------------------------------------------------------
                        */
                        Forms\Components\FileUpload::make('favicon')
                            ->label('Favicon')
                            ->image()
                            ->imageEditor()
                            ->directory('website')
                            ->disk('public')
                            ->visibility('public')
                            ->preserveFilenames()
                            ->maxSize(256)
                            ->helperText('Ukuran ideal 32x32 atau 64x64')
                            ->downloadable()
                            ->openable()
                            ->previewable(true),

                    ])
                    ->columns(1),
            ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Table
    |--------------------------------------------------------------------------
    */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\ImageColumn::make('logo')
                    ->label('Logo')
                    ->square()
                    ->height(50),

                Tables\Columns\TextColumn::make('nama_website')
                    ->label('Nama Website')
                    ->searchable(),

                Tables\Columns\ColorColumn::make('primary_color')
                    ->label('Warna Utama'),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Terakhir Diupdate')
                    ->since(),
            ])

            ->actions([
                Tables\Actions\EditAction::make(),
            ])

            ->bulkActions([]);
    }

    /*
    |--------------------------------------------------------------------------
    | Clear Cache Setelah Save
    |--------------------------------------------------------------------------
    */
    public static function afterSave(): void
    {
        Cache::forget('website_settings');
    }

    /*
    |--------------------------------------------------------------------------
    | Pages
    |--------------------------------------------------------------------------
    */
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPengaturanWebsites::route('/'),
            'create' => Pages\CreatePengaturanWebsite::route('/create'),
            'edit' => Pages\EditPengaturanWebsite::route('/{record}/edit'),
        ];
    }
}
