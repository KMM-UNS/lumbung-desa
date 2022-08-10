<?php

namespace App\DataTables\Admin\Pembelian;

use App\Models\DetailPembelianPupuk;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class DetailPembelianPupukDataTable extends DataTable
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
     * @param \App\Models\Admin/Pembelian/DetailPembelianPupukDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(DetailPembelianPupuk $model)
    {
        $pembelian_id = request()->segment(5);
        return $model->select('detail_pembelian_pupuk.*')->with(['detailpupuk'])->where('pembelian_id', $pembelian_id);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('detailpembelianpupuk-table')
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
            Column::make('detailpupuk.nama','detailpupuk.nama')->title('Pupuk'),
            Column::make('jumlah'),
            Column::make('harga'),
            Column::make('total'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Admin/Pembelian/DetailPembelianPupuk_' . date('YmdHis');
    }
}
