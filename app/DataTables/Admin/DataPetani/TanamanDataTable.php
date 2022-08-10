<?php

namespace App\DataTables\Admin\DataPetani;

use App\Models\Tanaman;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class TanamanDataTable extends DataTable
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
                $btn = $btn . '<a href="' . route('admin.data-petani.tanaman.edit', $row->id) . '" class="btn btn-dark buttons-edit"><i class="fas fa-edit"></i></a>';
                $btn = $btn . '<a href="' . route('admin.data-petani.tanaman.destroy', $row->id) . '" class="btn btn-danger buttons-delete"><i class="fas fa-trash fa-fw"></i></a>';
                $btn = $btn . '</div>';

                return $btn;
            });
        }

    /**
     * Get query source of dataTable.
     *
     * @param \App\App\Models\Admin\DataPetani\Tanaman $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Tanaman $model)
    {
        return $model->select('tanamen.*')->with(['jenistanaman','pupuk','musimtanam']);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('tanamen-table')
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
            Column::make('DT_RowIndex')->title('No')->orderable(false)->searchable(false)->addClass('text-center'),
            Column::make('jenistanaman.nama', 'jenistanaman.nama')->title('Jenis Tanaman'), //jenistanaman nama fungsi relasi
            Column::make('nama', 'tanamen.nama'),
            Column::make('musimtanam.nama', 'musimtanam.nama')->title('Musim Tanam'),
            Column::make('waktu_tanam', 'tanamen.waktu_tanam')->title('Waktu Tanam (bulan)'),
            Column::make('pupuk.nama', 'pupuk.nama')->title('Jenis Pupuk'),
            Column::make('keterangan', 'tanamen.keterangan'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                //   ->width(60)
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
        return 'Admin\DataPetani\Tanaman_' . date('YmdHis');
    }
}
