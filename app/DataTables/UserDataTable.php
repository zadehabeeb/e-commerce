<?php

namespace App\DataTables;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class UserDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', 'backend.user.partials.actions')
            ->editColumn('name', function ($row) {
                return view('backend.user.partials.name', compact('row'));
            })
            ->editColumn('is_active', fn ($row) => $row->is_active ? 'Yes' : 'No')
            ->rawColumns(['action', 'name'])
            ->setRowId('id');
    }

    public function query(User $model): QueryBuilder
    {
        return $model->newQuery();
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('user-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom("<'row align-items-center mb-3'
                      <'col-md-7'l>
                      <'col-md-5 d-flex justify-content-end align-items-center'
                          <'me-2'f>
                          B
                      >
                  >
                  <'row'
                      <'col-12'tr>
                  >
                  <'row mt-2'
                      <'col-md-5'i>
                      <'col-md-7 text-end'p>
                  >
              ")
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel')->className('btn btn-success me-1 custom-btn'),
                Button::make('csv')->className('btn btn-info me-1 custom-btn'),
                Button::make('pdf')->className('btn btn-danger me-1 custom-btn'),
                Button::make('print')->className('btn btn-warning me-1 custom-btn'),
            ]);
    }

    public function getColumns(): array
    {
        return [
            Column::computed('action')
                ->title('')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center bg-action-column'),
            Column::make('id')->addClass('text-center align-middle'),
            Column::make('name')->addClass('align-middle'),
            Column::make('email')->addClass('align-middle'),
            Column::make('phone')->addClass('align-middle'),
            Column::make('city')->addClass('align-middle'),
            Column::make('is_active')->addClass('text-center align-middle'),
            Column::make('created_at')->addClass('align-middle'),
            Column::make('updated_at')->addClass('align-middle'),
        ];
    }

    protected function filename(): string
    {
        return 'User_' . date('YmdHis');
    }
}
