<?php

namespace App\DataTables\Admin\GudangLumbung;

use App\Models\GudangLumbung;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class GudangLumbungDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addIndexColumn()
            ->setRowId(function ($row) {
                return $row->id;
            })
            ->addColumn('action', function ($row) {
                $btn = '<div class="btn-group">';
                $btn = $btn . '<a href="' . route('admin.gudang-lumbung.gudang-produk.edit', $row->id) . '" class="btn btn-dark buttons-edit"><i class="fas fa-edit"></i></a>';
                $btn = $btn . '<a href="' . route('admin.gudang-lumbung.gudang-produk.destroy', $row->id) . '" class="btn btn-danger buttons-delete"><i class="fas fa-trash fa-fw"></i></a>';
                $btn = $btn . '</div>';

                return $btn;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\App\Models\Admin\GudangLumbung\GudangLumbungDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(GudangLumbung $model)
    {
        return $model->select('gudang_lumbung.*')->with(['tanaman','kondisi','keterangangudang']);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('gudanglumbung-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('<"dataTables_wrapper dt-bootstrap"B<"row"<"col-xl-7 d-block d-sm-flex d-xl-block justify-content-center"<"d-block d-lg-inline-flex"l>><"col-xl-5 d-flex d-xl-block justify-content-center"fr>>t<"row"<"col-sm-5"i><"col-sm-7"p>>>')
                    ->orderBy(1)
                    ->parameters([
                        'responsive' => true,
                        'autowidth' => false
                    ])
                    ->buttons(
                        Button::make('create'),
                        // Button::make('export'),
                        Button::make('print'),
                        // Button::make('reset'),
                        // Button::make('reload')
                    );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('DT_RowIndex')->title('No')->orderable(false)->searchable(false)->addClass('text-center'),
            Column::make('tanaman.nama', 'tanaman.nama')->title('Produk'),
            Column::make('kondisi.nama', 'kondisi.nama')->title('Kondisi'),
            Column::make('stok', 'gudang_lumbung.stok')->title('Stok (/kg)'),
            // Column::make('satuan_id')->data('satuan.satuan')->title('Satuan'),
            Column::make('keterangangudang.nama', 'keterangangudang.nama')->data('keterangangudang.nama')->title('Keterangan'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                //   ->width(60)
                  ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Admin\GudangLumbung\GudangLumbung_' . date('YmdHis');
    }
}
