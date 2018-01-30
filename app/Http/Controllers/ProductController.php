<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Session;
use App\Product;
use App\ProductOption;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();

        return View('products.list')
            ->with('products', $products);
    }

    public function create()
    {
        return View('products.create');
    }

    public function store(Request $request)
    {
        $rules = array(
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('products.create')
                ->withErrors($validator);
        } else {
            $product = new Product;
            $product->name = Input::get('name');
            $product->description = Input::get('description');
            $product->save();

            $productOption = new productOption;
            $productOption->product_id = $product->id;
            $productOption->option_name = 'Price';
            $productOption->value = Input::get('price');

            $product->productOption()->save($productOption);

            Session::flash('message', 'Utworzono produkt!');
            return redirect()->route('products.index');
        }
    }

    public function show($id)
    {

    }

    public function edit($id)
    {
        $product = Product::find($id);
        $price = Product::getPrice($id);

        return View('products.edit', compact('product', 'price'));
    }

    public function update(Request $request, $id)
    {
        $rules = array(
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('products.create')
                ->withErrors($validator);
        } else {
            $product = Product::find($id);
            $product->name = Input::get('name');
            $product->description = Input::get('description');
            $product->save();

            $productOption = productOption::where('product_id', '=', $id)
                ->where('option_name', '=', 'price')
                ->first();
            $productOption->value = Input::get('price');
            $productOption->save();

            Session::flash('message', 'Edycja przebiegła pomyślnie!');
            return redirect()->route('products.index');
        }
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();

        Session::flash('message', 'Produkt został usunięty');
        return redirect()->route('products.index');
    }
}
