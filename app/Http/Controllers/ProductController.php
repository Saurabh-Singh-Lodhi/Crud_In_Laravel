<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy("created_at", "desc")->get();
        return view("products.list", [
            "products" => $products
        ]);
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $data)
    {
        $rules = [
            'name' => 'required|min:5',
            'SKU' => 'required|min:3',
            'price' => 'required|numeric',
        ];

        if ($data->image != "") {
            $rules['image'] = 'image';
        }

        $validator = Validator::make($data->all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('products.create')->withInput()->withErrors($validator);
        }

        $product = new Product();
        $product->name = $data->name;
        $product->price = $data->price;
        $product->SKU = $data->SKU;
        $product->description = $data->description;
        $product->save();

        if ($data->image != "") {
            //Here we will store image
            $image = $data->image;
            $ext = $image->getClientOriginalExtension();
            $imageName = time() . '.' . $ext;  //Unique image name

            //Save image to products directory
            $image->move(public_path('uploads/products'), $imageName);

            //Save image name in database
            $product->image = $imageName;
            $product->save();
        }

        return redirect()->route('products.index')->with('success', 'Product Created Successfully');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', [
            'product' => $product
        ]);
    }

    public function update($id, Request $data)
    {
        $product = Product::findOrFail($id);

        $rules = [
            'name' => 'required|min:5',
            'SKU' => 'required|min:3',
            'price' => 'required|numeric',
        ];

        if ($data->image != "") {
            $rules['image'] = 'image';
        }

        $validator = Validator::make($data->all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('products.edit', $product->id)->withInput()->withErrors($validator);
        }

        $product->name = $data->name;
        $product->price = $data->price;
        $product->SKU = $data->SKU;
        $product->description = $data->description;
        $product->save();

        if ($data->image != "") {

            //delete the old image
            File::delete(public_path('uploads/products/' . $product->image));

            //Here we will store image
            $image = $data->image;
            $ext = $image->getClientOriginalExtension();
            $imageName = time() . '.' . $ext;  //Unique image name

            //Save image to products directory
            $image->move(public_path('uploads/products'), $imageName);

            //Save image name in database
            $product->image = $imageName;
            $product->save();
        }

        return redirect()->route('products.index')->with('success', 'Product Updated Successfully');
    }

    public function delete($id)
    {
        $product = Product::findOrFail($id);

        // if ($product->image != "") {
            //delete the image
            File::delete(public_path('uploads/products/' . $product->image));   
        // }

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully !!!');


    }
}
