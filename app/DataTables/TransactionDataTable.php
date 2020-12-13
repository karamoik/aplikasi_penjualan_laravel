<?php

namespace App\DataTables;

use App\Models\Transactions;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class TransactionDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $datatable = new EloquentDataTable($query);

        return $datatable->addIndexColumn()
            // ->addColumn('action', 'admin.transactions.action')
            //menambah column
            ->addColumn('product',function($data){
                if (!empty($data->product_id)) {
                    return $data->products['name'];
                }else{
                    return '';
                }
            })
            ->filterColumn('product',function($query,$keyword){
                $query->whereHas('products',function($query)use ($keyword){
                    $query->where('products.name','LIKE',"%{$keyword}%");
                });
            })
            ->editColumn('trx_date',function($trx){
                if (!empty($trx->trx_date)) {
                    return date('d-F-y',strtotime($trx->trx_date));
                }else{
                    return '';
                }
            })
            ->editColumn('price', function ($trx) {
                if (!empty($trx->price)) {
                    return "Rp. " . number_format($trx->price,2,',','.');
                } else {
                    return '';
                }
            });


    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Transaction $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Transactions $model)
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
            ->columns($this->getColumns())
            ->addColumnBefore([
                'defaultContent' => '',
                'data'           => 'DT_RowIndex',
                'name'           => 'DT_RowIndex',
                'title'          => 'No',
                'render'         => null,
                'orderable'      => false,
                'searchable'     => false,
                'exportable'     => false,
                'printable'      => true,
                'footer'         => '',
            ])
            ->minifiedAjax()
            ->parameters([
                'dom'       => 'Bfrtip',
                'stateSave' => true,
                'order'     => [[0, 'desc']],
                'buttons'   => [
                    ['extend' => 'export', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'print', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'reset', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'reload', 'className' => 'btn btn-default btn-sm no-corner',],
                ],
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'product'=>['searchable' =>true, 'title'=>'Product Name'],
            'trx_date'=>['searchable' =>true, 'title'=>'Date'],
            'price'=>['searchable' =>true, 'title'=>'price'],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Transaction_' . date('YmdHis');
    }
}
