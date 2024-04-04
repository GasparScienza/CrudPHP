<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('products',function(){
    $products = Product::orderBy('description', 'asc')->get();
    return view('products.index', compact('products'));//Retornamos una vista 
}) -> name('products.index');

Route::get('products/create', function(){
    return view('products.create');
})-> name('products.create');

Route::Post('/products', function(Request $request){
    $product = new Product();
    $product->description = $request->input('description');
    $product->price = $request->input('price');
    $product->save();
    return redirect()->route('products.index')->with('info', 'Producto creado');
})->name('products.add');

Route::delete('products/{id}', function($id){
    $product = Product::findOrFail($id);
    $product->delete();
    return redirect()->route('products.index')->with('info','Producto eliminado');
}) ->name('products.destroy');

Route::get('products/{id}/edit', function($id){
    $product = Product::findOrFail($id);
    return view('products.edit', compact('product'));
})->name('products.edit');

Route::put('products/{id}', function(Request $request, $id){
    $product = Product::findOrFail($id);
    $product->description = $request->input('description');
    $product->price = $request->input('price');
    $product->save();
    return redirect()->route('products.index')->with('info', 'Producto editado');
})->name('products.update');

