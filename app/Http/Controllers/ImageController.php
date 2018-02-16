<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\ProductImage;

class ImageController extends Controller
{
   public function index($id)
   {
   	  $product = product::find($id);
   	  $images = $product->images;
   	  return view('admin.products.images.index')->with(compact('product','images'));

   }

   public function store(Request $request, $id)
   {
   	// guardar la img en nuestro proyecto
    	$file = $request->file('photo');
    	$path = public_path() . '/images/products';
	    $fileName = uniqid() . $file->getClientOriginalName();
    	$moved = $file->move($path, $fileName);

    // crear 1 registro en la tabla product_images
    	//if ($moved) {
	    	$productImage = new ProductImage();
	    	$productImage->image = $fileName;
	    	// $productImage->featured = false;
	    	$productImage->product_id = $id;
	    	$productImage->save(); // INSERT
    	//}

    	return back();    	   	
   }

   public function destroy($id)
   {
   	
   }      
}
