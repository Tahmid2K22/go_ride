<?php

namespace App\Filament\Resources\RiderApplicationResource\Pages;

use App\Filament\Resources\RiderApplicationResource;
use Filament\Resources\Pages\ListRecords;

class ListRiderApplications extends ListRecords
{
    protected static string $resource = RiderApplicationResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }

    public function getTitle(): string
    {
        return 'Driver Applications';
    }
}