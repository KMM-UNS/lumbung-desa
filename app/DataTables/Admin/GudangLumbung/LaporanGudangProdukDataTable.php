<?php

namespace App\DataTables\Admin\GudangLumbung;

use App\Models\GudangLumbung;
use App\Models\GudangPupuk;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class LaporanGudangProdukDataTable extends DataTable
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
                $btn = $btn . '<a href="' . route('admin.riwayat.pembelian.show', $row->id) . '" class="btn btn-info buttons-show">Detail</a>';
                return $btn;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Admin/GudangLumbung/LaporanGudangProdukDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(GudangLumbung $model)
    {
        return $model->select('gudang_lumbung.*')->with(['tanaman']);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('laporangudangproduk-table')
            ->parameters([
                'responsive' => true,
                'autoWidth' => false
            ])
            ->columns($this->getColumns())
            ->minifiedAjax()
            // ->dom('Bfrtip')
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
            Column::make('DT_RowIndex')->title('No')->orderable(false)->searchable(false)->addClass('text-center')->width(60),
            Column::make('tanaman.nama', 'tanaman.nama')->title('Produk'),
            Column::make('stok', 'gudang_pupuk.stok')->title('Stok (kg)'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(250)
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
        return 'Admin/GudangLumbung/LaporanGudangProduk_' . date('YmdHis');
    }
}
