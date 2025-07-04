<?php

namespace App\DataTables;

use App\Models\Goods;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class GoodsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder<Goods> $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            // ->addColumn('action', 'goods.action')
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return '
                <div class="d-flex justify-content-center">
                    <button class="btn btn-sm btn-info me-1 btn-show" data-id="'.$row->id.'">
                        <i class="bi bi-eye"></i>
                    </button>
                    <button class="btn btn-sm btn-warning me-1 btn-edit" data-id="'.$row->id.'">
                        <i class="bi bi-pencil"></i>
                    </button>
                    <form action="'.route('goods.destroy', $row->id).'" method="POST" onsubmit="return confirm(\'Are you sure?\')">
                        '.csrf_field().method_field('DELETE').'
                        <button type="submit" class="btn btn-sm btn-danger">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>
                </div>';
            })
            ->editColumn('harga_barang', function ($row) {
                return 'Rp. ' . number_format($row->harga_barang, 0, ',', '.');
            })
            ->rawColumns(['action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     *
     * @return QueryBuilder<Goods>
     */
    public function query(Goods $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('goods-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            // ->dom('lBfrtip')
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                Button::make('create'),
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            ])
            ->parameters([
                'responsive' => true,
                'autoWidth' => false,
                'stateSave' => true,
                'ordering' => true,
                'language' => [
                    'search' => '_INPUT_',
                    'searchPlaceholder' => 'Cari barang...',
                    'lengthMenu' => 'Show _MENU_ entries',
                    // 'info' => 'Showing _START_ to _END_ of _TOTAL_ goods',
                    'infoEmpty' => 'No goods available',
                    // 'infoFiltered' => '(filtered from _MAX_ total goods)',
                    'zeroRecords' => 'No matching goods found',
                    'emptyTable' => 'No goods data available'
                ]
            ])
            ;
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
            Column::make('nama_barang'),
            Column::make('jumlah_barang'),
            Column::make('satuan_barang'),
            Column::make('harga_barang'),
            Column::make('kode_barang'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center')
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Goods_' . date('YmdHis');
    }
}
