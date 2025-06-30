<?php

namespace App\Filament\Resources\InscripcionResource\Pages;

use App\Filament\Resources\InscripcionResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewInscripcion extends ViewRecord
{
    protected static string $resource = InscripcionResource::class;
    
    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
