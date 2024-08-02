<?php

namespace App\Http\Livewire\Backend;

use App\Domains\Structure\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\TableComponent;
use Rappasoft\LaravelLivewireTables\Traits\HtmlComponents;
use Rappasoft\LaravelLivewireTables\Views\Column;

/**
 * Class CategoriesTable.
 */
class CategoriesTable extends TableComponent
{
    use HtmlComponents;

    /**
     * @var string
     */
    public $sortField = 'name';

    /**
     * @var string
     */
    public $status;

    /**
     * @var array
     */
    protected $options = [
        'bootstrap.container' => false,
        'bootstrap.classes.table' => 'table table-striped',
    ];

    /**
     * @param  string  $status
     */
    public function mount($status = 'all'): void
    {
        $this->status = $status;
    }

    /**
     * @return Builder
     */
    public function query(): Builder
    {
        $query = Category::withCount('activities');

        if ($this->status === 'published') {
            return $query->onlyPublished();
        }

        return $query;
    }

    /**
     * @return array
     */
    public function columns(): array
    {
        return [
            Column::make(__('Name'), 'name')
                ->searchable()
                ->sortable()->format(function (Category $model) {
                    return view('backend.structure.category.includes.name', ['category' => $model]);
                }),
            Column::make(__('Publicada'), 'published')
                ->sortable()
                ->format(function (Category $model) {
                    return view('backend.structure.category.includes.published', ['category' => $model]);
                }),
            Column::make(__('Activa'), 'active')
                ->sortable()
                ->format(function (Category $model) {
                    return view('backend.structure.category.includes.active', ['category' => $model]);
                }),
            Column::make(__('Orden'), 'order')
                ->sortable(),
            Column::make(__('Acciones'))
                ->format(function (Category $model) {
                    return view('backend.structure.category.includes.actions', ['category' => $model]);
                }),
        ];
    }
}
