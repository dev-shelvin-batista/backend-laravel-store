<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Product;

class ProductController extends Controller
{  
    /**
     * Get all product data
     * @return Object List of all registered products
     */
    public function index(){
      $products = Product::orderBy('id')->get();
      return response()->json($products, 200);
    }

    /**
     * Register the product information into the database.
     * @param  Request $request Payload with data sent by the user
     * @return Object Created product data
     */
    public function register(Request $request) {
      // Validate that the fields submitted are correct.
      $validator = Validator::make($request->all(), [
        'description' => 'required|max:128',
        'reference' => 'required|max:128',
        'price' => 'required',
        'weight' => 'required',
        'category_id' => 'required',
        'stock' => 'required'
      ]);
  
      // If there is an error in a sent value, an error response is generated
      if ($validator->fails()) {
        return response()->json($validator->messages(), 401);
      }
      $product = new Product;
      // Assign values to properties
      $product->description = $request->description;
      $product->reference = $request->reference;
      $product->price = $request->price;
      $product->weight = $request->weight;
      $product->category_id = $request->category_id;
      $product->stock = $request->stock;
      // Generate the new record in the database.
      $product->save();    
      return response()->json($product, 200);
    }
  
    /**
     * Edit all or part of the data in a database record.
     * @param  Request $request Payload with data sent by the user
     * @param  [type]  $id      ID of the product to be modified
     * @return Object Updated product data
     */
    public function update(Request $request) {
      // If there is an error in a sent value, an error response is generated
      if ($request->id == '' || !isset($request->id)) {
          return response()->json(["error" => "The product ID is required."], 403);
      }
      // Validate that the fields submitted are correct.
      $validator = Validator::make($request->all(), [
        'description' => 'required|max:128',
        'reference' => 'required|max:128',
        'price' => 'required',
        'weight' => 'required',
        'category_id' => 'required',
        'stock' => 'required'
      ]);
  
      // If there is an error in a sent value, an error response is generated
      if ($validator->fails()) {
        return response()->json($validator->messages(), 401);
      }   
      $requestData = $request->all();
      // Execute the update action
      Product::where('id', '=', $request->id)->update(
        $requestData
      );
      $product = Product::where('id', $request->id)->first();
      return response()->json($product, 200);
    }
  
    /**
     * Delete a record from the database
     * @param  Request $request Payload with data sent by the user
     * @return Object Product data deleted
     */
    public function delete(Request $request) {
      // If there is an error in a sent value, an error response is generated
      if ($request->id == '' || !isset($request->id)) {
        return response()->json(["error" => "The product ID is required."], 403);
      }
  
      $product = Product::where('id', $request->id)->first();
  
      Product::where('id', '=', $request->id)->delete();
      return response()->json($product, 200);
    }
  
    /**
     * Get data for a single product
     * @param  Request $request Payload with data sent by the user
     * @return Object Product details
     */
    public function getData(Request $request){
      // If there is an error in a sent value, an error response is generated
      if ($request->id == '' || !isset($request->id)) {
        return response()->json(["error" => "The product ID is required."], 403);
      }
  
      $product = Product::where([
        ['id', '=', $request->id]
        ])->first();
      return response()->json($product, 200);
    }
  
    /**
     * Generate error 404
     * @return Object Error message when trying to consume a REST API that does not exist
     */
    public function error404(){
      return response()->json(["error" => "The REST API cannot be found."], 200);
    }
}
