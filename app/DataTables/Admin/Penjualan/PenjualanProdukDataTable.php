<?php

namespace App\DataTables\Admin\Penjualan;

use App\Models\PenjualanProduk;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PenjualanProdukDataTable extends DataTable
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
        ->addColumn('action', function ($row) {
            $btn = '<div class="btn-group">';
            $btn = $btn . '<a href="' . route('admin.penjualan.penjualanproduk.edit', $row->id) . '" class="btn btn-dark buttons-edit"><i class="fas fa-edit"></i></a>';
            $btn = $btn . '<a href="' . route('admin.penjualan.penjualanproduk.destroy', $row->id) . '" class="btn btn-danger buttons-delete"><i class="fas fa-trash fa-fw"></i></a>';
            $btn = $btn . '<a href="' . route('admin.penjualan.penjualanproduk.show', $row->id) . '" class="btn btn-info buttons-show"><i class="fas fa-info fa-fw"></i></a>';
            $btn = $btn . '<a href="' . route('admin.penjualan.invoice', $row->id) . '" class="btn btn-warning buttons-invoice"><i class="fas fa-download fa-fw"></i></a>';
            $btn = $btn . '</div>';
            return $btn;
        });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\App\Models\Admin\PenjualanDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(PenjualanProduk $model)
    {
        return $model->select('penjualan_produks.*')->with([
            'produk.tanaman',
            'kondisi.kondisi',
            'keterangan.keterangangudang'
        ]);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('penjualan_produks-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('<"dataTables_wrapper dt-bootstrap"B<"row"<"col-xl-7 d-block d-sm-flex d-xl-block justify-content-center"<"d-block d-lg-inline-flex"l>><"col-xl-5 d-flex d-xl-block justify-content-center"fr>>t<"row"<"col-sm-5"i><"col-sm-7"p>>>')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('create'),
                        Button::make('export'),
                        Button::make('print'),
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

            Column::make('id'),
            Column::make('no_penjualan'),
           // Column::make('tgl_penjualan'),
            Column::make('nama'),
           // Column::make('email'),
            //Column::make('no_hp'),
          //  Column::make('alamat'),
            Column::make('produk_id')->data('produk.tanaman.nama'), //produk itu nama fungsi di model, nama_tanaman_id itu data yang diambil
            Column::make('kondisi')->data('kondisi.kondisi.nama'),
            Column::make('keterangan')->data('keterangan.keterangangudang.nama'),
           // Column::make('harga'),
            Column::make('jumlah'),
            //Column::make('kondisi')->data('kondisihasilpanen.kondisi'),
           // Column::make('total'),
           Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
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
        return 'Admin\Penjualan\PenjualanProduk_' . date('YmdHis');
    }

}
