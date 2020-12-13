<?php

namespace App\Http\Controllers;

use Validator;
use Session;
use App\Models\Product;
use App\Models\Category;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::pluck('name', 'id');
        $category = request('category');
        $search = request('search');

        $products = new Product;
        $paginate = 3;



        //fillter category
        if (!empty($category)) {
            $products = $products->where('category_id', $category);
        }
        //fillter name
        if (!empty($search)) {
            $products = $products->orWhere('name', 'LIKE', "%{$search}%");
        }
        $products = $products->paginate($paginate);

        return view('admin.products.index', compact(
            'categories',
            'category',
            'search',
            'products'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::pluck('name', 'id')->toArray();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'category_id' => 'required',
            'name' => 'required',
            'price' => 'required',
            'sku' => 'required',
            'description' => 'required',
            'status' => 'required',
            'image' => 'required',

        ];

        $message = [
            'category_id.required' => 'Category Field Required',
            'name.required' => 'name Field Required',
            'price.required' => 'price Field Required',
            'sku.required' => 'SKU Field Required',
            'description.required' => 'description Field Required',
            'status.required' => 'status Field Required',
            'image.required' => 'image Field Required',
        ];
        $validator = Validator::make($request->all(), $rules, $message);
        if ($validator->fails()) {
            # code...
            return redirect()->back()->withErrors($validator);
        }

        $product = new Product;
        $product->category_id = $request->category_id;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->sku = $request->sku;
        $product->description = $request->description;
        $product->status = $request->status;
        $product->image = $request->file('image')->store('products', 'public');
        $product->save();

        Session::flash('message', 'Product Save Successfuly');
        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::pluck('name', 'id')->toArray();

        return view('admin.products.show', compact('product', 'categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::pluck('name', 'id')->toArray();

        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'category_id' => 'required',
            'name' => 'required',
            'price' => 'required',
            'sku' => 'required',
            'description' => 'required',
            'status' => 'required',


        ];

        $message = [
            'category_id.required' => 'Category Field Required',
            'name.required' => 'name Field Required',
            'price.required' => 'price Field Required',
            'sku.required' => 'SKU Field Required',
            'description.required' => 'description Field Required',
            'status.required' => 'status Field Required',

        ];
        $validator = Validator::make($request->all(), $rules, $message);
        if ($validator->fails()) {
            # code...
            return redirect()->back()->withErrors($validator);
        }

        $product =  Product::find($id);
        $product->category_id = $request->category_id;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->sku = $request->sku;
        $product->description = $request->description;
        $product->status = $request->status;
        if ($request->file('image')) {
            $product->image = $request->file('image')->store('products', 'public');
        }
        $product->save();

        Session::flash('message', 'Product Updated Successfuly');
        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        Session::flash('message', 'Product Deleted Succsesfuly');

        return redirect()->route('products.index');
    }
}
