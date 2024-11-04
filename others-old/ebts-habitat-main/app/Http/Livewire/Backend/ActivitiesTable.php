<?php

namespace App\Http\Livewire\Backend;

use App\Domains\Structure\Models\Activity;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\TableComponent;
use Rappasoft\LaravelLivewireTables\Traits\HtmlComponents;
use Rappasoft\LaravelLivewireTables\Views\Column;

/**
 * Class ActivitiesTable.
 */
class ActivitiesTable extends TableComponent
{
    use HtmlComponents;

    /**
     * @var string
     */
    public $sortField = 'title';

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
        $query = Activity::query();

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
            Column::make(__('Título'), 'title')
                ->searchable()
                ->sortable()
                ->format(function (Activity $model) {
                    return view('backend.structure.activity.includes.title', ['activity' => $model]);
                }),
            Column::make(__('Categoría'), 'category_id')
                ->sortable()
                ->format(function (Activity $model) {
                    return $model->categoryName;
                }),
            Column::make(__('Publicada'), 'published')
                ->sortable()
                ->format(function (Activity $model) {
                    return view('backend.structure.activity.includes.published', ['activity' => $model]);
                }),
            Column::make(__('Activa'), 'active')
                ->sortable()
                ->format(function (Activity $model) {
                    return view('backend.structure.activity.includes.active', ['activity' => $model]);
                }),
            Column::make(__('Acciones'))
                ->format(function (Activity $model) {
                    return view('backend.structure.activity.includes.actions', ['activity' => $model]);
                }),
        ];
    }
}
