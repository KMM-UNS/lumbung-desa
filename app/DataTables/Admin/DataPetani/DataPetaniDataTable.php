<?php

namespace App\DataTables\Admin\DataPetani;

use App\Models\DataPetani;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class DataPetaniDataTable extends DataTable
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
        ->addColumn('action', function ($row) {
            $btn = '<div class="btn-group">';
            $btn = $btn . '<a href="' . route('admin.data-petani.petani.edit', $row->id) . '" class="btn btn-dark buttons-edit"><i class="fas fa-edit"></i></a>';
            $btn = $btn . '<a href="' . route('admin.data-petani.petani.destroy', $row->id) . '" class="btn btn-danger buttons-delete"><i class="fas fa-trash fa-fw"></i></a>';
            $btn = $btn . '<a href="' . route('admin.data-petani.petani.show', $row->id) . '" class="btn btn-info buttons-show"><i class="fas fa-info fa-fw"></i></a>';

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
    public function query(DataPetani $model)
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
            ->setTableId('data_petanis-table')
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
            Column::make('id'),
            Column::make('no_kk'),
            Column::make('nik'),
            Column::make('nama'),
            Column::make('tempat_lahir'),
            Column::make('tanggal_lahir'),
            Column::make('jenis_kelamin'),
            Column::make('alamat'),
            Column::make('foto'),

        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Admin\DataPetani_' . date('YmdHis');
    }
}
