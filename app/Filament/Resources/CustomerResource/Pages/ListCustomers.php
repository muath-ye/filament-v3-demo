<?php

namespace App\Filament\Resources\CustomerResource\Pages;

use App\Filament\Resources\CustomerResource;
use App\Models\Customer;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Pages\ListRecords\Tab;
use Illuminate\Contracts\Database\Eloquent\Builder;

class ListCustomers extends ListRecords
{
    protected static string $resource = CustomerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('All Customers')
                ->icon('heroicon-m-user-group')
                ->iconPosition('before')
                ->badge(Customer::query()->count()),
            'active' => Tab::make('Active')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('is_active', true))
                ->badge(Customer::query()->where('is_active', true)->count()),
            'inactive' => Tab::make('In Active')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('is_active', false))
                ->badge(Customer::query()->where('is_active', false)->count()),
        ];
    }
}
