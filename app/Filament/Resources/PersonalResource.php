<?php

namespace App\Filament\Resources;

use Filament\Tables\Actions\Action;
use Filament\Tables\Enums\FiltersLayout;
use App\Filament\Resources\PersonalResource\Pages;
use App\Filament\Resources\PersonalResource\RelationManagers;
use App\Models\CompaniaVista;
use App\Models\Personal;
use App\Models\Personal\Categoria;
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
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('nombres')->label('Nombres:')->required()->maxLength(45),
                        Forms\Components\TextInput::make('apellidos')->label('Apellidos:')->required()->maxLength(45),
                        Forms\Components\TextInput::make('codigo')->label('Codigo:')->required()->numeric()->mask('99999'),
                        Forms\Components\TextInput::make('fecha_juramento')->label('Fecha Juramento:')->required()->numeric()->mask('9999'),
                        Forms\Components\TextInput::make('documento')->label('Documento:')->required()->mask('999999999999999'),
                    ])->columns(3),
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\Select::make('categoria_id')->label('Categoria:')
                            ->required()
                            ->relationship('categoria', 'categoria')
                            ->preload(),
                        Forms\Components\Select::make('compania_id')->label('Compañia:')
                            ->required()
                            ->options(CompaniaVista::obtenerListadoCompanias())
                            ->preload()
                            ->searchable(),
                        Forms\Components\Select::make('estado_id')->label('Estado:')
                            ->required()
                            ->relationship('estado', 'estado')
                            ->preload()
                            ->searchable(),
                        Forms\Components\Select::make('sexo_id')->label('Sexo:')
                            ->required()
                            ->relationship('sexo', 'sexo')
                            ->preload(),
                        Forms\Components\Select::make('nacionalidad_id')->label('Nacionalidad:')
                            ->required()
                            ->relationship('pais', 'pais')
                            ->preload()
                            ->searchable(),
                    ])->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nombrecompleto')->label('Nombre Completo:')->sortable(),
                Tables\Columns\TextColumn::make('codigo')->label('Codigo:')->sortable(),
                Tables\Columns\TextColumn::make('documento')->label('Documento:')->sortable(),
                Tables\Columns\TextColumn::make('fecha_juramento')->label('Juramento:')->sortable(),
                Tables\Columns\TextColumn::make('categoria.categoria')->label('Categoria:')->sortable(),
                Tables\Columns\TextColumn::make('estado.estado')->label('Estado:')->badge()
                    ->color(function ($state) {
                        return match ($state) {
                            'ACTIVO' => 'success',
                            'PERIODO DE PRUEBA', 'REINTEGRO PROVISORIO' => 'warning',
                            default => 'danger'
                        };
                    })->sortable(),
                Tables\Columns\TextColumn::make('estadoActualizar.estado')->label('Actualizar:')->badge()
                    ->color(function ($state) {
                        return match ($state) {
                            'Falta actualizar' => 'danger',
                            'Actualizado' => 'success',
                            //default => 'danger'
                        };
                    })->sortable(),
                Tables\Columns\TextColumn::make('pais.pais')->label('Pais:')->sortable(),
                Tables\Columns\TextColumn::make('sexo.sexo')->label('Sexo:')->sortable(),
                //Tables\Columns\TextColumn::make('compania.compania')->label('Compania:')->sortable()->searchable(), //Genera un error la relacion al usar buscador
                Tables\Columns\TextColumn::make('obtenerNombreCompania')->label('Compania:')
                    ->getStateUsing(fn($record) => $record->obtenerNombreCompania())->sortable(),
            ])->paginated([5, 10, 20, 25])
            ->defaultPaginationPageOption(5)
            ->filters([
                // FILTRAR POR CAMPO NOMBRECOMPLETO
                Tables\Filters\Filter::make('nombrecompleto')
                    ->form([
                        Forms\Components\TextInput::make('nombrecompleto')->label('Nombre Completo:'),
                    ])->query(function (Builder $query, array $data): Builder {
                        return $query->when(
                            $data['nombrecompleto'],
                            fn(Builder $query, $nombrecompleto): Builder => $query->where('nombrecompleto', 'like', '%' . $nombrecompleto . '%') // Se agrega la funcion like debido a que el campo es de tipo TEXT
                        );
                    })->columnSpan(1),

                // FILTRAR POR CAMPO CODIGO
                Tables\Filters\Filter::make('codigo')
                    ->form([
                        Forms\Components\TextInput::make('codigo')->label('Codigo:'),
                    ])->query(function (Builder $query, array $data): Builder {
                        return $query->when(
                            $data['codigo'],
                            fn(Builder $query, $codigo): Builder => $query->where('codigo', $codigo)
                        );
                    })->columnSpan(1),

                // FILTRAR POR CAMPO DOCUMENTO
                Tables\Filters\Filter::make('documento')
                    ->form([
                        Forms\Components\TextInput::make('documento')->label('Documento:'),
                    ])->query(function (Builder $query, array $data): Builder {
                        return $query->when(
                            $data['documento'],
                            fn(Builder $query, $documento): Builder => $query->where('documento', $documento)
                        );
                    })
                    ->columnSpan(1),

                // FILTRAR POR CAMPO FECHA_JURAMENTO
                Tables\Filters\Filter::make('fecha_juramento')
                    ->form([
                        Forms\Components\TextInput::make('fecha_juramento')->label('Fecha Juramento:'),
                    ])->query(function (Builder $query, array $data): Builder {
                        return $query->when(
                            $data['fecha_juramento'],
                            fn(Builder $query, $fecha_juramento): Builder => $query->where('fecha_juramento', $fecha_juramento)
                        );
                    })
                    ->columnSpan(1),

                // FILTRAR POR CAMPO (RELACION) CATEGORIA
                Tables\Filters\SelectFilter::make('categoria_id')
                    ->label('Categoria:')
                    ->relationship('categoria', 'categoria')
                    ->preload()
                    ->multiple()
                    ->columnSpan(1),

                // FILTRAR POR CAMPO (RELACION) ESTADO
                Tables\Filters\SelectFilter::make('estado_id')
                    ->label('Estado:')
                    ->relationship('estado', 'estado')
                    ->preload()
                    ->multiple()
                    ->columnSpan(1),

                // FILTRAR POR CAMPO (RELACION) ESTADOACTUALIZAR
                Tables\Filters\SelectFilter::make('estado_actualizar_id')
                    ->label('Actualizar:')
                    ->relationship('estadoActualizar', 'estado')
                    ->preload()
                    ->multiple()
                    ->columnSpan(1),

                // FILTRAR POR CAMPO (RELACION) SEXO
                Tables\Filters\SelectFilter::make('sexo_id')
                    ->label('Sexo:')
                    ->relationship('sexo', 'sexo')
                    ->preload()
                    ->columnSpan(1),

                // FILTRAR POR CAMPO (RELACION) PAIS
                Tables\Filters\SelectFilter::make('pais_id')
                    ->label('Pais:')
                    ->relationship('pais', 'pais')
                    ->preload()
                    ->multiple()
                    ->columnSpan(1),

                // FILTRAR POR CAMPO COMPANIA_ID
                Tables\Filters\SelectFilter::make('compania_id')
                    ->label('Compania')
                    ->options(CompaniaVista::obtenerListadoCompanias())
                    ->searchable()
                    ->columnSpan(1)
            ], layout: FiltersLayout::AboveContentCollapsible)
            ->filtersTriggerAction(
                fn(Action $action) => $action
                    ->button()
                    ->label('Filtros'),
            )
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
        return parent::getEloquentQuery()
            ->select('idpersonal', 'nombres', 'apellidos', 'nombrecompleto', 'codigo', 'categoria_id', 'compania_id', 'fecha_juramento', 'estado_id', 'documento', 'sexo_id', 'nacionalidad_id', 'estado_actualizar_id')
            ->with(['categoria:idpersonal_categorias,categoria', 'estado:idpersonal_estados,estado', 'sexo:idpersonal_sexo,sexo', 'pais:idpaises,pais', 'estadoActualizar:idpersonal_estado_actualizar,estado'])
            ->orderBy('nombrecompleto', 'asc');
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
