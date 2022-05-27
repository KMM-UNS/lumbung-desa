<?php

namespace App\DataTables\User;

use App\Models\GudangLumbung;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class KetersediaanProdukDataTable extends DataTable
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
            ->setRowId(function ($row) {
                return $row->id;
            })
            ->addColumn('No', function ($row) {
                return $row->id;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\App\Models\User\KetersediaanProdukDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(GudangLumbung $model)
    {
        return $model->select('gudang_lumbung.*')->with(['tanaman','satuan','kondisi','keterangangudang']);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('ketersediaanprodukdatatable-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('<"dataTables_wrapper dt-bootstrap"B<"row"<"col-xl-7 d-block d-sm-flex d-xl-block justify-content-center"<"d-block d-lg-inline-flex"l>><"col-xl-5 d-flex d-xl-block justify-content-center"fr>>t<"row"<"col-sm-5"i><"col-sm-7"p>>>')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('reset'),
                        Button::make('reload')
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
            Column::computed('No')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
                  Column::make('nama_tanaman_id')->data('tanaman.nama')->title('Nama'),
                  Column::make('stok'),
                  Column::make('satuan_id')->data('satuan.satuan')->title('Satuan'),
                  Column::make('kondisi_id')->data('kondisi.nama')->title('Kondisi'),
                  Column::make('keterangan_id')->data('keterangangudang.nama')->title('Keterangan'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'User\KetersediaanProduk_' . date('YmdHis');
    }
}
