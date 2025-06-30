<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InscripcionResource\Pages;
use App\Filament\Resources\InscripcionResource\RelationManagers;
use App\Models\Inscripcion;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InscripcionResource extends Resource
{
    protected static ?string $model = Inscripcion::class;

    protected static ?string $modelLabel = 'Inscripción';
    protected static ?string $pluralModelLabel = 'Inscripciones';
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Gestión';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Información Personal')
                    ->schema([
                        Forms\Components\TextInput::make('nombre')
                            ->required()
                            ->maxLength(100),
                        Forms\Components\TextInput::make('cedula')
                            ->label('Cédula')
                            ->required()
                            ->maxLength(20)
                            ->unique(ignoreRecord: true),
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->required()
                            ->maxLength(100),
                        Forms\Components\TextInput::make('telefono')
                            ->label('Teléfono')
                            ->tel()
                            ->required()
                            ->maxLength(20),
                        Forms\Components\Select::make('profesion')
                            ->options([
                                'estudiante_pregrado' => 'Estudiante de Pregrado',
                                'especialista' => 'Especialista',
                                'medico_cirujano' => 'Médico Cirujano',
                            ])
                            ->required(),
                        Forms\Components\DateTimePicker::make('fecha_registro')
                            ->label('Fecha de Registro')
                            ->default(now())
                            ->required(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('codigo_inscripcion')
                    ->label('Código')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nombre')
                    ->searchable(),
                Tables\Columns\TextColumn::make('cedula')
                    ->label('Cédula')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('profesion')
                    ->label('Profesión')
                    ->formatStateUsing(fn (string $state): string => match($state) {
                        'estudiante_pregrado' => 'Estudiante',
                        'especialista' => 'Especialista',
                        'medico_cirujano' => 'Médico Cirujano',
                        default => $state,
                    })
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'estudiante_pregrado' => 'info',
                        'especialista' => 'success',
                        'medico_cirujano' => 'primary',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('fecha_registro')
                    ->label('Fecha Registro')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('profesion')
                    ->options([
                        'estudiante_pregrado' => 'Estudiante de Pregrado',
                        'especialista' => 'Especialista',
                        'medico_cirujano' => 'Médico Cirujano',
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInscripcions::route('/'),
            'create' => Pages\CreateInscripcion::route('/create'),
            'view' => Pages\ViewInscripcion::route('/{record}'),
            'edit' => Pages\EditInscripcion::route('/{record}/edit'),
        ];
    }
}
