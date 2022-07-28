<?php

namespace App\DataTables\Admin\RiwayatPenjualan;

use App\Models\PenjualanPpk;
use App\Models\DataPembeli;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class DetailRiwayatPenjualanPupukDataTable extends DataTable
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
            ->addIndexColumn();
        }

    /**
     * Get query source of dataTable.
     *
     * @param \App\App\Models\Admin/RiwayatPembelian/DetailRiwayatPembelianDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(PenjualanPpk $model)
    {
        $id = request()->segment(4);
        return $model->select('penjualan_ppks.*')->with([
            'produkppk.ppk',
            'pembelippk'
        ])->where('namapembelippk', $id);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('detailriwayatpenjualan-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    // ->dom('<"dataTables_wrapper dt-bootstrap"B<"row"<"col-xl-7 d-block d-sm-flex d-xl-block justify-content-center"<"d-block d-lg-inline-flex"l>><"col-xl-5 d-flex d-xl-block justify-content-center"fr>>t<"row"<"col-sm-5"i><"col-sm-7"p>>>')
                    ->orderBy(1);
                    // ->buttons(
                    //     Button::make('create'),
                    //     Button::make('export'),
                    //     Button::make('print'),
                    //     Button::make('reset'),
                    //     Button::make('reload')
                    // );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('DT_RowIndex')->title('No')->orderable(false)->searchable(false)->addClass('text-center')->width(40),
            // Column::make('id'),
            Column::make('no_penjualan'),
           Column::make('tgl_penjualan'),
            Column::make('namapembelippk')->data('pembelippk.nama')->title('Nama Pembeli'),
           // Column::make('email'),
            //Column::make('no_hp'),
          //  Column::make('alamat'),
            Column::make('produk_id')->title('Produk')->data('produkppk.ppk.nama'), //produk itu nama fungsi di model, nama_tanaman_id itu data yang diambil
            // Column::make('kondisi')->data('kondisi.kondisi.nama'),
            // Column::make('keterangan')->data('keterangan.keterangangudang.nama'),
           Column::make('harga')->title('Harga (/Kg)'),
            Column::make('jumlah')->title('Jumlah (/Kg)'),
            //Column::make('kondisi')->data('kondisihasilpanen.kondisi'),
           Column::make('total'),
        //    Column::computed('action')
        //           ->exportable(false)
        //           ->printable(false)
        //           ->width(60)
        //           ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Admin/RiwayatPenjualan/DetailRiwayatPenjualanPupuk_' . date('YmdHis');
    }
}
