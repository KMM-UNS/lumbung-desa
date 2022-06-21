<?php

namespace App\DataTables\Admin\Pembelian;

use App\Models\PembelianModal;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class PembelianModalDataTable extends DataTable
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
        ->addColumn('action', function ($row) {
            $btn = '<div class="btn-group">';
            $btn = $btn . '<a href="' . route('admin.pembelian.pembelian-modal.edit', $row->id) . '" class="btn btn-dark buttons-edit"><i class="fas fa-edit"></i></a>';
            $btn = $btn . '<a href="' . route('admin.pembelian.pembelian-modal.destroy', $row->id) . '" class="btn btn-danger buttons-delete"><i class="fas fa-trash fa-fw"></i></a>';
            return $btn;
        });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\App\Models\Admin/Pembelian/PembelianModalDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(PembelianModal $model)
    {
        return $model->select('pembelian_modal.*')->with(['tanaman','petani','lahan','kondisi']);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
        ->setTableId('pembelianmodal-table')
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
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
            Column::make('musim_panen_id'),
            Column::make('petani_id')->data('petani.nama')->title('Petani'),
            Column::make('tanaman_id')->data('tanaman.nama')->title('Tanaman'),
            Column::make('lahan_id')->data('lahan.nama'),
            Column::make('luas_lahan'),
            Column::make('jumlah'),
            Column::make('kondisi_id')->data('kondisi.nama')->title('Kondisi'),
            Column::make('harga'),
            Column::make('total')
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Admin/Pembelian/PembelianModal_' . date('YmdHis');
    }
}