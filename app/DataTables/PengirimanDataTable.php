<?php

namespace App\DataTables;

use App\Models\Pengiriman;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PengirimanDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder<Pengiriman> $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('no_surat', fn ($row) => $row->no_surat ?? '-')
            ->addColumn('no_po', fn ($row) => $row->order->no_po ?? '-')
            ->addColumn('tanggal', fn ($row) => $row->tanggal ?? '-')
            ->addColumn('penerima', fn ($row) => $row->penerima ?? '-')
            ->editColumn('status', fn ($row) => ucfirst($row->status))
            ->addColumn('action', function ($order) {
                return '
                    <div class="d-flex justify-content-center">
                        <button class="btn btn-sm btn-warning me-1 btn-edit" data-id="'.$order->id.'">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <button class="btn btn-sm btn-danger btn-delete" data-id="'.$order->id.'">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                ';
            })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     *
     * @return QueryBuilder<Pengiriman>
     */
    public function query(Pengiriman $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('pengiriman-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->orderBy(1)
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
            Column::make('no_surat')->title('No Surat Jalan'),
            Column::make('no_po')->title('No PO'),
            Column::make('tanggal')->title('Tanggal'),
            Column::make('penerima')->title('Penerima'),
            Column::make('status')->title('Status'),
            Column::make('created_at')->title('Dicatat Pada'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->title('Aksi')
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Pengiriman_' . date('YmdHis');
    }
}
