<?php

namespace App\Filament\Resources\CustomerResource\Pages;

use App\Filament\Resources\CustomerResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateCustomer extends CreateRecord
{
    protected static string $resource = CustomerResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $data['password'] = bcrypt($data['password']);

        return static::getModel()::create($data);
    }

    protected function getRedirectUrl(): string
    {
        return $this->previousUrl ?? $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Client registered';
    }

    /** overrides getCreatedNotificationTitle() */
    protected function getCreatedNotification(): ?Notification
    {
        // To disable the notification altogether, return null
        // return null;
        return Notification::make()
            ->success()
            ->title('User registered')
            ->body('The user has been created successfully.');
    }

    /* https://beta.filamentphp.com/docs/3.x/panels/resources/creating-records#lifecycle-hooks */
}
