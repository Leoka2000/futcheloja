<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource

{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('tracking_code')

                    ->maxLength(255),

                Forms\Components\Select::make('category')
                    ->options([
                        'america' => 'América',
                        'europa' => 'Europa',
                        'asia' => 'Ásia',
                        'africa' => 'África',
                        'liga_alema' => 'liga_alema',
                        'liga_espanhola' => 'liga_espanhola',
                        'liga_espanhola' => 'liga_espanhola',
                        'liga_inglesa' => 'liga_italiana',
                        'outra_liga' => 'outra_liga',
                        'paulistas' => 'paulistas',
                        'mineiros' => 'mineiros',
                        'nordestinos' => 'nordestinos',
                        'ultimos_lancamentos' => 'ultimos_lancamentos',
                        'edicao_retro' => 'edicao_retro',
                        'brasileirao_lancamentos' => 'brasileirao_lancamentos',
                    ])
                    ->required(),



                Forms\Components\Select::make('size')
                    ->options([
                        'P' => 'P',
                        'M' => 'M',
                        'G' => 'G',
                        'GG' => 'GG',
                        '2GG' => '2GG',
                        '3GG' => '3GG',
                        '4GG' => '4GG',
                    ])
                    ->required(),
                Forms\Components\RichEditor::make('description')
                    ->nullable()
                    ->columnSpanFull(),

                Forms\Components\TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('BRL')
                    ->minValue(0),

                Forms\Components\FileUpload::make('image')
                    ->label('Product Images')
                    ->multiple()
                    ->disk('public')
                    ->image()
                    ->maxSize(10240) // 10 MB in kilobytes
                    ->columnSpanFull()

                    ->visibility('public')

                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),


                Tables\Columns\TextColumn::make('size')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('tracking_code')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('price')
                    ->money('BRL')
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),

                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                // Add filters if needed
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // Add relations if needed
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
