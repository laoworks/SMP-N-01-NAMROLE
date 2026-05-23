<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PesanKontakResource\Pages;
use App\Models\PesanKontak;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Notifications\Notification;

class PesanKontakResource extends Resource
{
    protected static ?string $model = PesanKontak::class;
    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';
    protected static ?string $navigationLabel = 'Pesan Masuk';
    protected static ?string $navigationGroup = 'Komunikasi';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Pengirim')
                    ->schema([
                        Forms\Components\TextInput::make('nama')
                            ->disabled(),
                        Forms\Components\TextInput::make('email')
                            ->disabled(),
                        Forms\Components\TextInput::make('no_hp')
                            ->disabled(),
                        Forms\Components\TextInput::make('subjek')
                            ->disabled(),
                    ])->columns(2),

                Forms\Components\Section::make('Pesan')
                    ->schema([
                        Forms\Components\Textarea::make('pesan')
                            ->disabled()
                            ->rows(5),
                    ]),

                Forms\Components\Section::make('Status')
                    ->schema([
                        Forms\Components\Toggle::make('is_read')
                            ->label('Sudah Dibaca'),
                        Forms\Components\Toggle::make('is_replied')
                            ->label('Sudah Dibalas'),
                        Forms\Components\DateTimePicker::make('replied_at')
                            ->disabled(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('subjek')
                    ->limit(30),
                Tables\Columns\TextColumn::make('pesan')
                    ->limit(50),
                Tables\Columns\IconColumn::make('is_read')
                    ->boolean()
                    ->label('Dibaca'),
                Tables\Columns\IconColumn::make('is_replied')
                    ->boolean()
                    ->label('Dibalas'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_read'),
                Tables\Filters\TernaryFilter::make('is_replied'),
            ])
            ->defaultSort('created_at', 'desc')
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                // PERBAIKAN: Ganti icon 'heroicon-o-reply' dengan 'heroicon-o-arrow-up-right'
                Tables\Actions\Action::make('reply')
                    ->icon('heroicon-o-arrow-up-right')
                    ->color('primary')
                    ->url(fn(PesanKontak $record): string => "mailto:{$record->email}?subject=Re: {$record->subjek}")
                    ->openUrlInNewTab(),
                Tables\Actions\Action::make('mark_as_read')
                    ->icon('heroicon-o-check')
                    ->color('success')
                    ->action(function (PesanKontak $record): void {
                        $record->update(['is_read' => true]);
                        Notification::make()
                            ->title('Pesan ditandai sudah dibaca')
                            ->success()
                            ->send();
                    })
                    ->visible(fn(PesanKontak $record): bool => !$record->is_read),
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
            'index' => Pages\ListPesanKontaks::route('/'),
            'create' => Pages\CreatePesanKontak::route('/create'),
            'view' => Pages\ViewPesanKontak::route('/{record}'),
            'edit' => Pages\EditPesanKontak::route('/{record}/edit'),
        ];
    }
}
