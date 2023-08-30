<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use App\Modules\Enums\UserEnum;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

class AdminTable extends DataTableComponent
{
    protected $model = User::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setSearchDisabled();
    }

    public function builder(): Builder
    {
        return User::query()
            ->where('type', UserEnum::Admin);
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id')
                ->sortable(),

            Column::make('Name', 'name')
                ->sortable(),

            Column::make('Email', 'email')
                ->sortable(),

            Column::make('Role', 'modelHasRole.role.name')
                ->sortable()
                ->format(function ($value, $row, Column $column) {
                    return ucwords(str_replace('-', ' ', $value));
                }),

            ButtonGroupColumn::make('Actions')
                ->attributes(fn ($row) => ['class' => 'space-x-2'])
                ->buttons([
                    LinkColumn::make('View')
                        ->title(fn ($row) => 'View')
                        ->location(fn ($row) => route('admin.admin.show', $row))
                        ->attributes(function ($row) {
                            return [
                                'class' => 'text-sky-500 hover:underline hover:pointer',
                            ];
                        }),
                ]),
        ];
    }
}
