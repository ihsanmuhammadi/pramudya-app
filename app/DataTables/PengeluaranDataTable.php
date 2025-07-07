<?php

namespace App\DataTables;

use App\Models\Pengeluaran;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PengeluaranDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder<Pengeluaran> $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('action', function ($order) {
                return '
                    <div class="d-flex justify-content-center">
                        <button class="btn btn-sm btn-info me-1 btn-show" data-id="'.$order->id.'">
                            <i class="bi bi-eye"></i>
                        </button>
                        <button class="btn btn-sm btn-warning me-1 btn-edit" data-id="'.$order->id.'">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <button class="btn btn-sm btn-danger btn-delete" data-id="'.$order->id.'">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                ';
            })
            ->editColumn('total', function ($row) {
                return 'Rp. ' . number_format($row->total, 0, ',', '.');
            })
            ->rawColumns(['action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     *
     * @return QueryBuilder<Pengeluaran>
     */
    public function query(Pengeluaran $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('pengeluaran-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1)
            ->selectStyleSingle()
            ->parameters([
                'responsive' => true,
                'autoWidth' => false,
                'stateSave' => true,
                'ordering' => true,
                'language' => [
                    'search' => '_INPUT_',
                    'searchPlaceholder' => 'Cari order...',
                    'lengthMenu' => 'Show _MENU_ entries',
                    'infoEmpty' => 'No orders available',
                    'zeroRecords' => 'No matching orders found',
                    'emptyTable' => 'No orders data available'
                ]
            ]);
    }
    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
            return [
                Column::computed('DT_RowIndex')
                    ->title('No')
                    ->exportable(false)
                    ->printable(true)
                    ->orderable(false)
                    ->searchable(false)
                    ->width(30),

                Column::make('no_po')->title('No PO'),
                Column::make('nama_po')->title('Nama PO'),
                Column::make('tanggal')->title('Tanggal'),
                Column::make('total')->title('Total'),

                Column::computed('action')
                    ->exportable(false)
                    ->printable(false)
                    ->width(60)
                    ->addClass('text-center'),
            ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Pengeluaran_' . date('YmdHis');
    }
}
