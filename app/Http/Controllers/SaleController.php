<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Sale;
use App\Models\SaleDetail;
use App\Models\Product;

class SaleController extends Controller
{
    /**
     * Register the sales information into the database.
     * @param  Request $request Payload with data sent by the user
     * @return Object Details of the sale created
     */
    public function register(Request $request) {
        // Validate that the fields submitted are correct.
        $validator = Validator::make($request->all(), [
            'total' => 'required',
            'detail' => 'required'
        ]);

        // If there is an error in a sent value, an error response is generated
        if ($validator->fails()) {
            return response()->json($validator->messages(), 401);
        }

        $errores = [];

        foreach ($request->detail as $key => $value) {
            $product = Product::where('id', $value["product_id"])->first();
            if(isset($product)) {
                if($value["count"] > $product->stock) {
                    return response()->json("Product " . $product->description . " is out of stock.", 401);
                }
            } else {
                return response()->json("The product does not exist.", 401);
            }
        }

        $sale = new Sale;
        // Assign values to properties
        $sale->date = date('Y-m-d');
        $sale->total = $request->total;
        // Generate the new record in the database.
        $sale->save();

        $sale->detail = [];
        $array_details = [];

        // Save sales details data
        foreach ($request->detail as $key => $value) {
            $product = Product::where('id', $value["product_id"])->first();
            
            $sale_detail = new SaleDetail;
            // Assign values to properties
            $sale_detail->sale_id = $sale->id;
            $sale_detail->product_id = $value["product_id"];
            $sale_detail->price = $value["price"];
            $sale_detail->count = $value["count"];
            $sale_detail->total = $value["total"];
            // Generate the new record in the database.
            $sale_detail->save();

            $product->stock = $product->stock - $value["count"];
            // Execute the update action
            Product::where('id', '=', $product->id)->update(
                $product->toArray()
            );
            $array_details[] = array_merge($sale->detail, $sale_detail->toArray());
            
                
        }
        $sale->detail = array_merge($sale->detail, $array_details);
      
        return response()->json($sale, 200);
    }
}
