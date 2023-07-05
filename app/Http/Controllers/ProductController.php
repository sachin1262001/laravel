<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::latest()->paginate(5);
        return view('products.index',compact('products'))->with('i', (request()->input('page', 1) - 1) * 5);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
            'password' => 'required|min:6',
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg'

        ]);
        
        $fileName = time() . '.' . $request->image->extension();
        
        //$request->image->storeAs('/public/images', $fileName);
        $request->image->move(public_path('images'), $fileName);

        
        $product = new Product;
        $product->name = $request->name;
        $product->detail = $request->detail;
        $product->password = $request->password;
        $product->image = $fileName;
        $product->save();
   
        return redirect()->route('products.index')->with('success','Product created successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('products.show',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('products.edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        // dd($product->id);
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
            'password' => 'required|min:6'
        ]);
        $filename = '';
        if ($request->image) {
            $fileName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $fileName);
            $path = 'images/'.$product->image;
            if(File::exists($path))
            { 
                // dd("Hello");
                File::delete($path);
            }
        }else{
            $fileName = $product->image;
        }
        $product->name = $request->name;
        $product->detail = $request->detail;
        $product->password = bcrypt($request->input('password'));
        $product->image = $fileName;
        $product->update();
  
        return redirect()->route('products.index')->with('success','Product updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
  
        return redirect()->route('products.index')->with('success','Product deleted successfully');

    }
}
