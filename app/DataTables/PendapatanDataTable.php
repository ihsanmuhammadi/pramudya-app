<?php

namespace App\DataTables;

use App\Models\Pendapatan;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PendapatanDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder<Pendapatan> $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return '
                    <div class="text-center">
                        <button class="btn btn-sm btn-danger btn-delete" data-id="' . $row->id . '" title="Hapus">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                ';
            })
            ->addColumn('no_po', fn ($row) => $row->order->no_po ?? '-')
            ->addColumn('nama_po', fn ($row) => $row->order->nama_po ?? '-')
            ->addColumn('tanggal', fn ($row) => $row->order->tanggal ?? '-')
            ->addColumn('total', fn ($row) => 'Rp' . number_format($row->order->total_semua_barang ?? 0, 0, ',', '.'))
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     *
     * @return QueryBuilder<Pendapatan>
     */
    public function query(Pendapatan $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('pendapatan-table')
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
            Column::make('no_po')->title('No PO'),
            Column::make('nama_po')->title('Nama PO'),
            Column::make('tanggal')->title('Tanggal'),
            Column::make('total')->title('Total Pendapatan'),
            Column::make('created_at')->title('Dicatat Pada'),
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
        return 'Pendapatan_' . date('YmdHis');
    }
}
