<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use App\Modules\Enums\UserEnum;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class UserTable extends DataTableComponent
{
    protected $model = User::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setSearchDebounce(500);
    }

    public function builder(): Builder
    {
        return User::query()
            ->whereNot('type', UserEnum::Admin);
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id')
                ->searchable()
                ->sortable(),
            //            Column::make('Fullname', 'name')
            //                ->searchable()
            //                ->sortable(),
            Column::make('Email', 'email')
                ->searchable()
                ->sortable(),
            BooleanColumn::make('Email Status', 'email_verified_at')
                ->sortable(),
            Column::make('Type', 'type')
                ->format(fn ($value) => ucfirst($value->value))
                ->sortable(),
            Column::make('Created at', 'created_at')
                ->format(fn ($value) => $value->format('F j, Y g:i A'))
                ->sortable(),
            Column::make('Updated at', 'updated_at')
                ->format(fn ($value) => $value->format('F j, Y g:i A'))
                ->sortable(),

            ButtonGroupColumn::make('Actions')
                ->attributes(fn ($row) => ['class' => 'space-x-2'])
                ->buttons([
                    LinkColumn::make('View')
                        ->title(fn ($row) => 'View')
                        ->location(fn ($row) => route('admin.users.show', $row))
                        ->attributes(function ($row) {
                            return [
                                'class' => 'text-sky-500 hover:underline hover:pointer',
                            ];
                        }),
                ]),
        ];
    }

    public function filters(): array
    {
        return [
            SelectFilter::make('E-mail Verified', 'email_verified_at')
                ->setFilterPillTitle('Verified')
                ->options([
                    '' => 'Any',
                    'yes' => 'Yes',
                    'no' => 'No',
                ])
                ->filter(function (Builder $builder, string $value) {
                    if ($value === 'yes') {
                        $builder->whereNotNull('email_verified_at');
                    } elseif ($value === 'no') {
                        $builder->whereNull('email_verified_at');
                    }
                }),

            SelectFilter::make('User Type', 'type')
                ->setFilterPillTitle('Type')
                ->options([
                    '' => 'Any',
                    'requester' => 'Requester',
                    'champion' => 'Champion',
                    'provider' => 'Provider',
                ])
                ->filter(function (Builder $builder, string $value) {
                    $builder->where('type', $value);
                }),
        ];
    }

    public function bulkActions(): array
    {
        return [
            'activate' => 'Activate',
            'deactivate' => 'Deactivate',
        ];
    }

    public function activate(): void
    {
        User::whereIn('id', $this->getSelected())->update(['email_verified_at' => now()]);

        $this->clearSelected();
    }

    public function deactivate(): void
    {
        User::whereIn('id', $this->getSelected())->update(['email_verified_at' => null]);

        $this->clearSelected();
    }
}
