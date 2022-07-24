<?php

namespace App\DataTables\Admin\RiwayatPembelian;

use App\Models\Pembelian;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class DetailRiwayatPembelianDataTable extends DataTable
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
    public function query(Pembelian $model)
    {
        $id = request()->segment(4);
        return $model->select('pembelian.*')->with(['musim','tanaman','kondisi','petani'])->where('petani_id', $id);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('detailriwayatpembelian-table')
                    ->parameters([
                        'responsive' => true,
                        'autoWidth' => false
                    ])
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
            Column::make('DT_RowIndex')->title('No')->orderable(false)->searchable(false)->addClass('text-center'),
            // Column::make('petani.nama', 'petani.nama'),
            Column::make('no_pembelian', 'pembelian.no_pembelian'),
            Column::make('tanggal_pembelian', 'pembelian.tanggal_pembelian'),
            Column::make('musim.musim_panen', 'musim.musim_panen')->title('Musim'),
            Column::make('tanaman.nama', 'tanaman.nama')->title('Produk'),
            Column::make('kondisi.nama', 'kondisi.nama')->title('Kondisi'),
            Column::make('jumlah', 'pembelian.jumlah')->title('Jumlah (kg)'),
            Column::make('harga', 'pembelian.harga'),
            Column::make('total', 'pembelian.total'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Admin/RiwayatPembelian/DetailRiwayatPembelian_' . date('YmdHis');
    }
}
