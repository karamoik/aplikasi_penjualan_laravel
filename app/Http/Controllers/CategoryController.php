<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Session;
use Redirect;



class CategoryController extends Controller
{
    public function index()
    {
        $category = \App\Models\Category::get();
        return view('/admin/category/index', compact('category'));
    }
    public function create()
    {
        return view('/admin/category/create');
    }
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'status' => 'required'
        ];
        $message = [
            'name.required' => 'Nama Tidak Boleh Kosong',
        ];
        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            return redirect('admin/category/create')->withErrors($validator);
        } else {
            //save to database
            $category = new \App\Models\Category;
            $category->name = $request->input('name');
            $category->status = $request->input('status');
            $category->save();

            Session::flash('message', 'Kategori Berhasil Ditambah');
            return redirect('admin/category');
        }
    }
    public function edit($id)
    {
        $category = \App\Models\Category::find($id);
        return view('admin.category.edit', compact('category'));
    }
    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required',
            'status' => 'required'
        ];
        $message = [
            'name.required' => 'Nama Tidak Boleh Kosong',
        ];
        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            return redirect('admin/category/create')->withErrors($validator);
        } else {
            //save to database
            $category = \App\Models\Category::find($id);
            $category->name = $request->input('name');
            $category->status = $request->input('status');
            $category->save();

            Session::flash('message', 'Kategori Berhasil Diubah');
            return redirect('admin/category');
        }
    }

    public function show($id)
    {
        $category = \App\Models\Category::find($id);
        return view('admin/category/show', compact('category'));
    }

    public function destroy($id)
    {
        $category = \App\Models\Category::find($id);
        $category->delete();
        Session::flash('message', 'Data Berhasil Dihapus');
        return redirect('admin/category');
    }
}
