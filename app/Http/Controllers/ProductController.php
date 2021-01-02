<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Subcategory;

class ProductController extends Controller
{
    public function index(){
        $products = Product::get();
        return view('admin.product.index',compact('products'));
    }
    public function welcome(){
        $products = Product::get();
        return view('admin.product.welcome',compact('products'));
    }
    public function create(){
        return view('admin.product.create');
    }
    public function store(Request $request){
        $this->validate($request,[
            'name'=>'required',
            'description'=>'required|min:3',
            'image'=>'required|mimes:jpeg,png|max:5000',
            'price'=>'required|numeric',
            'category'=>'required'
        ]);
        $image = $request->file('image')->store('public/product');
        Product::create([
            'name'=>$request->name,
            'description'=>$request->description,
            'image'=>$image,
            'price'=>$request->price,
            'category_id'=>$request->category,
            'subcategory_id'=>$request->subcategory
        ]);
        return redirect()->route('product.index');
        // return redirect()->back();
    }
    public function loadSubcategories(Request $request,$id){
        $subcategory = Subcategory::where('category_id',$id)->pluck('name','id');
        return response()->json($subcategory);
    }
    public function edit($id)
    {

    }
    public function destroy($id)
    {
        $product = Product::find($id);
        $fileName = $product->image;
        $product->delete();
        \Storage::delete($fileName);
        return redirect()->route('product.index');
    }
}
