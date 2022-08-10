<?php

namespace App\DataTables\Admin\Pembelian;

use App\Models\PembelianPupuk;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PembelianPupukDataTable extends DataTable
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
            ->addColumn('detail', function ($row) {
                $btn = '<div class="btn-group">';
                $btn = $btn . '<a href="' . route('admin.pembelian.pembelian-pupuk.detail', $row->id) . '" class="btn btn-info buttons-show">Detail Pembelian</a>';
                $btn = $btn . '</div>';
                return $btn;
            })
            ->addColumn('action', function ($row) {
                $btn = '<div class="btn-group">';
                // $btn = $btn . '<a href="' . route('admin.pembelian.pembelian-pupuk.edit', $row->id) . '" class="btn btn-dark buttons-edit"><i class="fas fa-edit"></i></a>';
                $btn = $btn . '<a href="' . route('admin.pembelian.pembelian-pupuk.destroy', $row->id) . '" class="btn btn-danger buttons-delete"><i class="fas fa-trash fa-fw"></i></a>';
                $btn = $btn . '<a href="' . route('admin.pembelian.pembelian-pupuk.invoice', $row->id) . '" class="btn btn-warning buttons-invoice"><i class="fas fa-download fa-fw"></i></a>';
                $btn = $btn . '</div>';

                return $btn;
            })
            ->rawColumns(['detail', 'action'])
            ->editColumn('tanggal_pembelian', function($row){
                return $row->tanggal_pembelian->isoFormat('DD MMMM YYYY');
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\App\Models\Admin/Pembelian/PembelianPupukDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(PembelianPupuk $model)
    {
        return $model->select('pembelian_pupuk.*')->with([
            'pupuk',
            'penjual'
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
                    ->setTableId('pembelianpupuk-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->parameters([
                        'responsive' => true,
                        'autoWidth' => false
                    ])
                    ->dom('<"dataTables_wrapper dt-bootstrap"B<"row"<"col-xl-7 d-block d-sm-flex d-xl-block justify-content-center"<"d-block d-lg-inline-flex"l>><"col-xl-5 d-flex d-xl-block justify-content-center"fr>>t<"row"<"col-sm-5"i><"col-sm-7"p>>>')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('create'),
                        // Button::make('export'),
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
            Column::make('DT_RowIndex')->title('No')->orderable(false)->searchable(false)->addClass('text-center')->width(40),
            // Column::make('no_pembelian', 'pembelian_pupuk.no_pembelian'),
            Column::make('no_pembelian', 'pembelian_pupuk.no_pembelian'),
            Column::make('tanggal_pembelian', 'pembelian_pupuk.tanggal_pembelian'),
            Column::make('penjual.instansi', 'penjual.instansi')->title('Supplier'),
            // Column::make('pupuk.nama', 'pupuk.nama')->title('Pupuk'),
            // Column::make('jumlah', 'pembelian_pupuk.jumlah'),
            // Column::make('harga', 'pembelian_pupuk.harga'),
            // Column::make('total', 'pembelian_pupuk.total'),
            Column::computed('detail')
                  ->exportable(false)
                  ->printable(false)
                  ->width(240)
                  ->addClass('text-center'),
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
        return 'Admin/Pembelian/PembelianPupuk_' . date('YmdHis');
    }
}
