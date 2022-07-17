<?php

namespace App\DataTables\User;

use App\Models\GudangPupuk;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class KetersediaanPupukDataTable extends DataTable
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
        ->addColumn('No', function ($row) {
            return $row->id;
        });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\User/KetersediaanPupukDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(GudangPupuk $model)
    {
        return $model->select('gudang_pupuk.*')->with(['pupuk']);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('ketersediaanpupuk-table')
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
            Column::make('DT_RowIndex')->title('No')->orderable(false)->searchable(false),
            Column::make('nama_pupuk')->data('pupuk.nama')->title('Pupuk'),
            Column::make('stok')
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'User/KetersediaanPupuk_' . date('YmdHis');
    }
}
