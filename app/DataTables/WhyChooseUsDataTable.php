<?php

namespace App\DataTables;

use App\Models\WhyChooseUs;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class WhyChooseUsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return(new EloquentDataTable($query))
            ->addColumn('action', function ($query) {
                $edit = "<a href='" . route('admin.why-choose-us.edit', $query->id) . "' class='btn'><i class='fas fa-edit'></i></a>";
                $delete = "<a href='" . route('admin.why-choose-us.destroy', $query->id) . "' class='btn delete-item'><i class='far fa-trash-alt'></i></a>";
                return $edit . $delete;
            })
            ->addColumn('icon', function ($query) {
                return "<i style='font-size:25px;' class='" . $query->icon . "'></i>";
            })
            ->addColumn('status', function ($query) {
                return $query->status == 1
                    ? '<span class="badge badge-primary">Active</span>'
                    : '<span class="badge badge-light">Inactive</span>';
            })
            ->rawColumns(['icon', 'status', 'action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(WhyChooseUs $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('whychooseus-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(0, 'desc') // 0 == 'id'
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('icon'),
            Column::make('title'),
            Column::make('status'),
            // Column::make('created_at'),
            // Column::make('updated_at'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(120)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'WhyChooseUs_' . date('YmdHis');
    }
}
