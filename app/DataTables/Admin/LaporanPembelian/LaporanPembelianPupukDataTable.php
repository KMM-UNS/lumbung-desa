<?php

namespace App\DataTables\Admin\LaporanPembelian;

use Illuminate\Http\Request;
use App\Models\PembelianPupuk;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use App\Models\DetailPembelianPupuk;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class LaporanPembelianPupukDataTable extends DataTable
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
        ->addColumn('action', function ($row) {
            $btn = '<div class="btn-group">';
            $btn = $btn . '<a href="' . route('admin.pembelian.pembelian-pupuk.detail', $row->id) . '" class="btn btn-info buttons-show">Detail Pembelian</a>';
            $btn = $btn . '</div>';
            return $btn;
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
     * @param \App\Models\Admin/LaporanPembelian/LaporanPembelianPupukDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(DetailPembelianPupuk $model)
    // public function query(PembelianPupuk $model)
    {
        // return $model->select('pembelian_pupuk.*')
        // ->with([
        //     'penjual'
        // ]);
        return $model->with('pembelian.penjual','detailpupuk','pembelian')->select('detail_pembelian_pupuk.*')->newQuery();
        // return $model->with('pembelianpupuk','detailpupuk','pembelianpupuk.penjual')->select('detail_pembelian_pupuk.*')->newQuery();

    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('laporanpembelianpupuk-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    // ->dom('Bfrtip')
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
            Column::make('DT_RowIndex')->title('No')->orderable(false)->searchable(false)->addClass('text-center'),
            Column::make('pembelian.tanggal_pembelian', 'pembelian.tanggal_pembelian')->title('Tanggal Pembelian'),
            // Column::make('tanggal_pembelian', 'pembelian_pupuk.tanggal_pembelian')->title('Tanggal Pembelian'),
            Column::make('pembelian.no_pembelian', 'pembelian.no_pembelian')->title('Nomor Pembelian'),
            // Column::make('no_pembelian', 'pembelian_pupuk.no_pembelian')->title('Nomor Pembelian'),
            Column::make('pembelian.penjual.instansi', 'pembelian.penjual.instansi')->title('Suplier'),
            // Column::make('penjual.instansi', 'penjual.instansi')->title('Suplier'),
            Column::make('detailpupuk.nama', 'detailpupuk.nama')->title('Produk'),
            Column::make('jumlah', 'detail_pembelian_pupuk.jumlah')->title('Jumlah'),
            Column::make('harga', 'detail_pembelian_pupuk.harga')->title('Harga'),
            Column::make('total', 'detail_pembelian_pupuk.total')->title('Total'),
            // Column::make('subtotal', 'pembelian_pupuk.subtotal')->title('Total'),
            // Column::computed('action')
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
        return 'Admin/LaporanPembelian/LaporanPembelianPupuk_' . date('YmdHis');
    }
}
