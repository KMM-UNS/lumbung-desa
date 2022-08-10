<?php

namespace App\DataTables\Admin\Pembelian;

use App\Models\DetailPembelianProduk;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class DetailPembelianProdukDataTable extends DataTable
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
     * @param \App\Models\Admin/Pembelian/DetailPembelianProdukDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(DetailPembelianProduk $model)
    {
        $pembelian_id = request()->segment(5);
        return $model->select('detail_pembelian_produk.*')->with(['detailproduk','detailkondisi'])->where('pembelian_id', $pembelian_id);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('detailpembelianproduk-table')
                    ->parameters([
                        'responsive' => true,
                        'autoWidth' => false
                    ])
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
            Column::make('detailproduk.nama', 'detailproduk.nama')->title('Produk'),
            Column::make('detailkondisi.nama', 'detailkondisi.nama')->title('Kondisi'),
            Column::make('jumlah')->title('Jumlah'),
            Column::make('harga')->title('Harga'),
            Column::make('total')->title('Total'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Admin/Pembelian/DetailPembelianProduk_' . date('YmdHis');
    }
}
