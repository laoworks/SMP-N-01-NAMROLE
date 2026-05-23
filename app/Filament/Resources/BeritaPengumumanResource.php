<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BeritaPengumumanResource\Pages;
use App\Models\BeritaPengumuman;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BeritaPengumumanResource extends Resource
{
    protected static ?string $model = BeritaPengumuman::class;
    protected static ?string $navigationIcon = 'heroicon-o-newspaper';
    protected static ?string $navigationLabel = 'Berita & Pengumuman';
    protected static ?string $navigationGroup = 'Konten Website';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Berita')
                    ->schema([
                        Forms\Components\TextInput::make('judul')
                            ->required()
                            ->maxLength(200)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn(string $operation, $state, Forms\Set $set) =>
                            $operation === 'create' ? $set('slug', Str::slug($state)) : null),
                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(200),
                        Forms\Components\Select::make('jenis')
                            ->options([
                                'berita' => 'Berita',
                                'pengumuman' => 'Pengumuman',
                            ])
                            ->required(),
                        Forms\Components\Select::make('kategori')
                            ->relationship('kategori', 'nama_kategori')
                            ->multiple()
                            ->preload(),
                        Forms\Components\Toggle::make('is_urgent')
                            ->label('Pengumuman Penting?')
                            ->visible(fn(Forms\Get $get) => $get('jenis') === 'pengumuman'),
                        Forms\Components\FileUpload::make('gambar_utama')
                            ->image()
                            ->directory('berita')
                            ->columnSpanFull(),
                    ])->columns(2),

                Forms\Components\Section::make('Konten')
                    ->schema([
                        Forms\Components\RichEditor::make('konten')
                            ->required()
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Pengaturan Publikasi')
                    ->schema([
                        Forms\Components\Toggle::make('is_published')
                            ->label('Publikasikan')
                            ->default(false),
                        Forms\Components\DateTimePicker::make('published_at')
                            ->label('Tanggal Publikasi')
                            ->default(now()),
                        Forms\Components\DateTimePicker::make('expired_at')
                            ->label('Tanggal Kadaluarsa')
                            ->visible(fn(Forms\Get $get) => $get('jenis') === 'pengumuman'),
                        Forms\Components\TextInput::make('penulis')
                            ->default(Auth::user()->name)
                            ->maxLength(100),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('gambar_utama')
                    ->square(),
                Tables\Columns\TextColumn::make('judul')
                    ->searchable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('jenis')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'berita' => 'info',
                        'pengumuman' => 'warning',
                    }),
                Tables\Columns\IconColumn::make('is_urgent')
                    ->boolean()
                    ->label('Penting'),
                Tables\Columns\TextColumn::make('penulis'),
                Tables\Columns\TextColumn::make('views')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_published')
                    ->boolean()
                    ->label('Published'),
                Tables\Columns\TextColumn::make('published_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('jenis')
                    ->options([
                        'berita' => 'Berita',
                        'pengumuman' => 'Pengumuman',
                    ]),
                Tables\Filters\TernaryFilter::make('is_published')
                    ->label('Status Publikasi'),
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
            'index' => Pages\ListBeritaPengumumen::route('/'),
            'create' => Pages\CreateBeritaPengumuman::route('/create'),
            'edit' => Pages\EditBeritaPengumuman::route('/{record}/edit'),
        ];
    }
}
