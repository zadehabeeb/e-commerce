<?php

namespace App\DataTables;

use App\Models\Category;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CategoryDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
         return (new EloquentDataTable($query))
            ->setRowId('id')
            ->addColumn('action', function($row){
                return '
                    <button type="button" class="btn btn-primary btn_edit" 
                        id="btn_edit_category"
                        data-category-id="' . $row->id . '" 
                        data-bs-toggle="modal" 
                        data-bs-target="#editModalCategory">
                        Edit
                    </button>'.
                    ' <button type="button" class="btn btn-danger btn_delete_category"
                     data-category-id="' . $row->id . '"
                      id="btn_delete_category">
                        Delete
                    </button>';
            })

            ->rawColumns(['action']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Category $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('category-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel')->className('btn btn-success me-1'),
                        Button::make('csv')->className('btn btn-info me-1'),
                        Button::make('pdf')->className('btn btn-danger me-1'),
                        Button::make('print')->className('btn btn-warning me-1'),
                    ]);

    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('name'),
            Column::make('slug'),
            Column::make('description'),
            Column::make('image'),
            Column::make('is_active'),
            Column::make('meta_title'),
            Column::make('meta_description'),
            Column::computed('action')
                  ->exportable(true)
                  ->printable(true)
                  ->width(60)
                  ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Category_' . date('YmdHis');
    }
}