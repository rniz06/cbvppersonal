<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PersonalResource\Pages;
use App\Filament\Resources\PersonalResource\RelationManagers;
use App\Models\Personal;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PersonalResource extends Resource
{
    protected static ?string $model = Personal::class;

    protected static ?string $navigationLabel = 'Personales';

    protected static ?string $slug = 'personales';

    protected static ?string $navigationIcon = 'heroicon-s-user-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nombrecompleto')->label('Nombre:')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('codigo')->label('Codigo:')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('documento')->label('Documento:')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('fecha_juramento')->label('Juramento:')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('categoria.categoria')->label('Categoria:')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('estado.estado')->label('Estado:')->badge()
                    ->color(function ($state) {
                        return match ($state) {
                            'ACTIVO' => 'success',
                            'PERIODO DE PRUEBA', 'REINTEGRO PROVISORIO' => 'warning',
                            default => 'danger'
                        };
                    })->searchable()->sortable(),
                Tables\Columns\TextColumn::make('pais.pais')->label('Pais:')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('sexo.sexo')->label('Sexo:')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('compania_id')->label('Compania:')->sortable()->searchable(),
            ])
            ->filters([
                //
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

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->orderBy('nombrecompleto', 'asc');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPersonals::route('/'),
            'create' => Pages\CreatePersonal::route('/create'),
            'edit' => Pages\EditPersonal::route('/{record}/edit'),
        ];
    }
}
