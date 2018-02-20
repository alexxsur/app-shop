<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Product;
use App\ProductImage;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
     $products = Product::paginate(10);
     return view('admin.products.index')->with(compact('products')); //listado
    }

    public function create()
    {
     return view('admin.products.create'); //formulario de registro
    }

    public function store(Request $request)
    {
        //Validar
        $messages = [
        	'name.required' => 'Es necesario ingresar un nombre para el producto.',
        	'name.min' => 'El nombre del producto debe tener al menos 3 caracteres.',
        	'description.required' => 'La descripción corta es un campo obligatorio.',        	
        	'description.max' => 'La descripción corta solo admite hasta 200 caracteres.',
        	'price.required' => 'Es obligatorio definir el precio para el producto.',
        	'price.numeric' => 'Ingrese un precio válido.',
        	'price.min' => 'No se admiten valores negativos.'
        ];    	
        //Validar
        $rules = [
        	'name' => 'required|min:3',
        	'description' => 'required|max:200',
        	'price' => 'required|numeric|min:0'
        ];
       $this->validate($request, $rules, $messages);

      //registrar el nuevo producto en la BD
      //dd($request->all());
    	$product = new Product();
    	$product->name = $request->input('name');
    	$product->description = $request->input('description');
    	$product->price = $request->input('price');
    	$product->long_description = $request->input('long_description');
    	$product->save(); //INSERT

    	return redirect('/admin/products');
    }

    public function edit($id)
    {
     //return 'Mostrar el producto $id '.$id;
     $product = Product::find($id);
     return view('admin.products.edit')->with(compact('product')); //formulario de edición
    }

    public function update(Request $request, $id)
    {
        //Validar
        $messages = [
        	'name.required' => 'Es necesario ingresar un nombre para el producto.',
        	'name.min' => 'El nombre del producto debe tener al menos 3 caracteres.',
        	'description.required' => 'La descripción corta es un campo obligatorio.',        	
        	'description.max' => 'La descripción corta solo admite hasta 200 caracteres.',
        	'price.required' => 'Es obligatorio definir el precio para el producto.',
        	'price.numeric' => 'Ingrese un precio válido.',
        	'price.min' => 'No se admiten valores negativos.'
        ];    	
        //Validar
        $rules = [
        	'name' => 'required|min:3',
        	'description' => 'required|max:200',
        	'price' => 'required|numeric|min:0'
        ];
       $this->validate($request, $rules, $messages);    	
      //Actualizar producto en la BD      
    	$product = Product::find($id);
    	$product->name = $request->input('name');
    	$product->description = $request->input('description');
    	$product->price = $request->input('price');
    	$product->long_description = $request->input('long_description');
    	$product->save(); //UPDATE

    	return redirect('/admin/products');
    }

    public function destroy($id)
    {
       
	    //CartDetail::where('product_id', $id)->delete();/*TEMPORAL PARA PREVENIR ERROR DE DEPENDENCIAS AL BORRAR PRODUCTOS*/
	    ProductImage::where('product_id', $id)->delete();/*TEMPORAL PARA PREVENIR ERROR DE DEPENDENCIAS AL BORRAR PRODUCTOS*/

      //Borrar producto en la BD      
    	$product = Product::find($id);
    	$product->delete(); //DELETE
    	return back();
    }       
}
