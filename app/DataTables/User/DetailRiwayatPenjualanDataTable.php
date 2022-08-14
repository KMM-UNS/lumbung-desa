<?php

namespace App\DataTables\User;

use App\Models\DetailPembelianProduk;
use App\Models\Pembelian;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class DetailRiwayatPenjualanDataTable extends DataTable
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
            ->editColumn('pembelian.tanggal_pembelian', function($row){
                return $row->tanggal_pembelian->isoFormat('DD MMMM YYYY');
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\User/DetailRiwayatPenjualanDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(DetailPembelianProduk $model)
    {
        $id = request()->segment(3);
        return $model->with('pembelian')->whereHas('pembelian', function($query)use($id){
            return $query->where('petani_id', $id);
        })->with(['detailproduk','detailkondisi','pembelian.musim']);
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
                    ->parameters([
                        'responsive' => true,
                        'autoWidth' => false
                    ])
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->orderBy(1);
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
            Column::make('pembelian.no_pembelian', 'pembelian.no_pembelian')->title('Nomor Pembelian'),
            Column::make('pembelian.tanggal_pembelian', 'pembelian.tanggal_pembelian')->title('Tanggal Pembelian'),
            Column::make('pembelian.musim.musim_panen', 'pembelian.musim.musim_panen')->title('Musim'),
            Column::make('detailproduk.nama', 'detailproduk.nama')->title('Produk'),
            Column::make('detailkondisi.nama', 'detailkondisi.nama')->title('Kondisi'),
            Column::make('jumlah', 'detail_pembelian_produk.jumlah')->title('Jumlah (kg)'),
            Column::make('harga', 'detail_pembelian_produk.harga'),
            Column::make('total', 'detail_pembelian_produk.total'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'User/DetailRiwayatPenjualan_' . date('YmdHis');
    }
}
