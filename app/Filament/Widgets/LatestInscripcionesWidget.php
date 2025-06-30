<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\InscripcionResource;
use App\Models\Inscripcion;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class LatestInscripcionesWidget extends BaseWidget
{
    protected static ?string $heading = 'Últimas Inscripciones';
    protected static ?int $sort = 2;
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Inscripcion::query()
                    ->latest('fecha_registro')
                    ->limit(5)
            )
            ->columns([
                Tables\Columns\TextColumn::make('codigo_inscripcion')
                    ->label('Código')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nombre')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('fecha_registro')
                    ->label('Fecha')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
                Tables\Columns\TextColumn::make('profesion')
                    ->label('Profesión')
                    ->formatStateUsing(fn (string $state): string => match($state) {
                        'estudiante_pregrado' => 'Estudiante',
                        'especialista' => 'Especialista',
                        'medico_cirujano' => 'Médico',
                        default => $state,
                    })
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'estudiante_pregrado' => 'info',
                        'especialista' => 'success',
                        'medico_cirujano' => 'primary',
                        default => 'gray',
                    }),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->url(fn (Inscripcion $record): string => InscripcionResource::getUrl('view', ['record' => $record])),
            ])
            ->emptyStateHeading('No hay inscripciones aún')
            ->defaultSort('fecha_registro', 'desc');
    }

    public static function canView(): bool
    {
        return true;
    }
}
