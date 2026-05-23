<?php

namespace App\Filament\Resources\AlbumResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class FotoRelationManager extends RelationManager
{
    protected static string $relationship = 'foto';

    protected static ?string $recordTitleAttribute = 'judul';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('judul')
                    ->maxLength(255),
                Forms\Components\Textarea::make('deskripsi')
                    ->rows(3),
                Forms\Components\FileUpload::make('foto')
                    ->required()
                    ->image()
                    ->directory('galeri/fotos'),
                Forms\Components\TextInput::make('urutan')
                    ->numeric()
                    ->default(0),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('foto'),
                Tables\Columns\TextColumn::make('judul'),
                Tables\Columns\TextColumn::make('urutan'),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
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
}
