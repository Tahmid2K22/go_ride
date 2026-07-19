<?php

namespace App\Filament\Resources\RiderApplicationResource\Pages;

use App\Filament\Resources\RiderApplicationResource;
use Filament\Resources\Pages\ViewRecord;

class ViewRiderApplication extends ViewRecord
{
    protected static string $resource = RiderApplicationResource::class;

    protected function getHeaderActions(): array
    {
        $record = $this->record;

        if ($record->status !== 'pending') {
            return [];
        }

        return [
            \Filament\Actions\Action::make('approve')
                ->label('Approve & Register')
                ->icon('heroicon-o-check-circle')
                ->color('success')
                ->requiresConfirmation()
                ->modalHeading('Approve & Register Driver')
                ->modalDescription('This will approve the application and create a driver account. The applicant will receive login credentials via email. Are you sure you want to proceed?')
                ->modalSubmitActionLabel('Yes, Approve & Register')
                ->action(fn () => RiderApplicationResource::approveAndRegister($record)),
        ];
    }

    public function getTitle(): string
    {
        return "Application #{$this->record->id} - {$this->record->name}";
    }
}