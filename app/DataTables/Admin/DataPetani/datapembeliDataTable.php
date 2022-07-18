<?php

namespace App\DataTables\Admin\DataPetani;

use App\Models\DataPembeli;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class DataPembeliDataTable extends DataTable
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
            $btn = $btn . '<a href="' . route('admin.data-petani.datapembeli.edit', $row->id) . '" class="btn btn-dark buttons-edit"><i class="fas fa-edit"></i></a>';
            $btn = $btn . '<a href="' . route('admin.data-petani.datapembeli.show', $row->id) . '" class="btn btn-info buttons-show"><i class="fas fa-info fa-fw"></i></a>';
            $btn = $btn . '<a href="' . route('admin.data-petani.datapembeli.destroy', $row->id) . '" class="btn btn-danger buttons-delete"><i class="fas fa-trash fa-fw"></i></a>';

            $btn = $btn . '</div>';
            return $btn;
        });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \Agama $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(DataPembeli $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('data_pembelis-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('<"dataTables_wrapper dt-bootstrap"B<"row"<"col-xl-7 d-block d-sm-flex d-xl-block justify-content-center"<"d-block d-lg-inline-flex"l>><"col-xl-5 d-flex d-xl-block justify-content-center"fr>>t<"row"<"col-sm-5"i><"col-sm-7"p>>>')
            ->orderBy(1)
            ->buttons(
                Button::make('create'),
                // Button::make('export'),
                // Button::make('print'),
                // Button::make('reset'),
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
            Column::make('DT_RowIndex')->title('No')->orderable(false)->searchable(false)->addClass('text-center')->width(40),
            Column::make('nama')->title('Nama Pembeli'),
            Column::make('instansi'),
            // Column::make('email'),
            // Column::make('no_hp'),
            // Column::make('alamat'),
            Column::computed('action')
            ->exportable(false)
            ->printable(false)
            //->width(60)
            ->addClass('text-center'),
       // Column::make('id'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Admin\DataPembeli_' . date('YmdHis');
    }
}
