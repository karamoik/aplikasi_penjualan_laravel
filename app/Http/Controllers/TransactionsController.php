<?php

namespace App\Http\Controllers;
use Validator;
use Excel;
use Session;

use App\Models\Transactions;
use App\Imports\TransactionImport; //import

use App\DataTables\TransactionDataTable;//import datatable


use Illuminate\Http\Request;

class TransactionsController extends Controller
{
    public function create(){
        return view('admin.transactions.create');
    }
    public function import(Request $request){
        $rules = [
            'file'=>'required'
        ];

        $message = [
            'file.required'=>'File Tidak Boleh Kosong'
        ];

        $validator = Validator::make($request->all(),$rules,$message);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $excel = $request->file('file');

        Excel::import(new TransactionImport, $request->file('file'));
        Session::flash('Success', 'Transaction Imported');
        return redirect ('admin/transactions');
    }

    public function index(TransactionDataTable $dataTable){
        // $transactions = Transactions::all();
        // return view ('admin/transactions/index',compact('transactions'));

        return $dataTable->render('admin.transactions.index');
    }
}
