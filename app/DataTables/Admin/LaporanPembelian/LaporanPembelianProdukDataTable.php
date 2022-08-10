<?php

namespace App\DataTables\Admin\LaporanPembelian;

use App\Models\DetailPembelianProduk;
use App\Models\Pembelian;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Illuminate\Http\Request;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class LaporanPembelianProdukDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query, Request $request)
    {
        return datatables()
        ->eloquent($query)
        ->addIndexColumn()
        ->setRowId(function ($row) {
            return $row->id;
        })
        ->filter(function($query) use($request) {
            // dd($request->all());
            if($request->has('startDate') && $request->has('endDate')){
                $startDate = $request->get("startDate");
                $endDate = $request->get("endDate");
                if($startDate != null && $endDate != null) {
                    return $query->whereHas('pembelian', function ($query) use ($startDate, $endDate) {
                        return $query->where('tanggal_pembelian', '>=' ,$startDate)->where('tanggal_pembelian', '<=' ,$endDate);
                       });
                } else {
                    return $query;
                }
            }
        }, true);
        // ->editColumn('tanggal_pembelian', function($row){
        //     return $row->tanggal_pembelian->isoFormat('DD MMMM YYYY');
        // });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Admin/LaporanPembelian/LaporanPembelianProdukDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(DetailPembelianProduk $model)
    {
        // return $model->select('pembelian.*')
        // ->with([
        //     'musim',
        //     'tanaman',
        //     'kondisi',
        //     'petani'
        // ]);
        return $model->with('pembelian','detailproduk','detailkondisi','pembelian.musim','pembelian.petani')->select('detail_pembelian_produk.*')->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('laporanpembelianproduk-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('<"dataTables_wrapper dt-bootstrap"B<"row"<"col-xl-7 d-block d-sm-flex d-xl-block justify-content-center"<"d-block d-lg-inline-flex"l>><"col-xl-5 d-flex d-xl-block justify-content-center"fr>>t<"row"<"col-sm-5"i><"col-sm-7"p>>>')
                    ->orderBy(1)
                    ->buttons(
                    //     Button::make('export'),
                        Button::make('print'),
                        Button::make('reset'),
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
            Column::make('pembelian.tanggal_pembelian', 'pembelian.tanggal_pembelian')->title('Tanggal Pembelian'),
            Column::make('pembelian.no_pembelian', 'pembelian.no_pembelian')->title('Nomor Pembelian'),
            Column::make('pembelian.musim.musim_panen', 'pembelian.musim.musim_panen')->title('Musim Panen'),
            Column::make('pembelian.petani.nama', 'pembelian.petani.nama')->title('Nama Petani Penjual'),
            Column::make('detailproduk.nama', 'detailproduk.nama')->title('Produk'),
            Column::make('detailkondisi.nama', 'detailkondisi.nama')->title('Kondisi'),
            Column::make('jumlah', 'detail_pembelian_produk.jumlah')->title('Jumlah'),
            Column::make('harga', 'detail_pembelian_produk.harga')->title('Harga'),
            Column::make('total', 'detail_pembelian_produk.total')->title('Total'),
            // Column::make('subtotal', 'pembelian.subtotal')->title('Subtotal'),
            // // Column::computed('action')
            //       ->exportable(false)
            //       ->printable(false)
            //       ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Admin/LaporanPembelian/LaporanPembelianProduk_' . date('YmdHis');
    }
}
