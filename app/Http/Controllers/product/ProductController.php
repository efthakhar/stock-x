<?php

namespace App\Http\Controllers\product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class ProductController extends Controller
{

    function index(){

        if(Gate::allows('check_permission',1)){
            $products = DB::table('products')->get()->toArray(); 

            $arranged_products = [];
            foreach($products as $product) {
                $arranged_products[$product->id] = $product;
            }          
            return response()->json($arranged_products);
        }else{
            return response()->json(['not allowed']);
        }
        
        
    }

    function getProductByName($name){

        $products = DB::table('products')
                        ->where('product_name', 'like', '%'.$name.'%')
                        ->get()->toArray(); 

        return response()->json($products);               

        // $arranged_products = [];
        // foreach($products as $product) {
        //     $arranged_products[$product->id] = $product;
        // }          
        // return response()->json($arranged_products);
    }

    public function show($id)
   {
         
         $product = DB::table('products')->find($id); 
       
         return response()->json($product);       
    }


    public function store(Request $request){

        $product = DB::table('products')->insert([

            'product_code' => $request->product_code,
            'product_name' => $request->product_name,
            'product_slug' => $request->product_slug,

            'unit_id' => $request->unit_id,
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,

            'tax_id' => $request->tax_id,
            'tax_inclusive' => $request->tax_inclusive,

            'product_cost' => $request->product_cost,
            'product_price' => $request->product_price,

            'daily_sale_target' => $request->daily_sale_target,
            'alert_quantity' => $request->alert_quantity,

            'product_img_url' => $request->product_img_url,
            'product_description' => $request->product_description,


            
        ]);

        return response()->json([
            "success" => true,
            "message" => "product Created Successfully.",
            "data" => $product
            ]);  
                    
    }

    public function update(Request $request, $id)
    {
              $updated = DB::table('products')
               ->where('id', $id)
               ->update([

                'product_code' => $request->product_code,
                'product_name' => $request->product_name,
                'product_slug' => $request->product_slug,

                'unit_id' => $request->unit_id,
                'category_id' => $request->category_id,
                'brand_id' => $request->brand_id,

                'tax_id' => $request->tax_id,
                'tax_inclusive' => $request->tax_inclusive,

                'product_cost' => $request->product_cost,
                'product_price' => $request->product_price,

                'daily_sale_target' => $request->daily_sale_target,
                'alert_quantity' => $request->alert_quantity,

                'product_img_url' => $request->product_img_url,
                'product_description' => $request->product_description,
                
             ]);
 
             return response()->json([
                 'success'=>true,
                 'message'=>'product updated succeesfully',
                 'data' => $updated
             ]);
    }
 

    public function delete($id)
    {    

                $deleted = DB::table('products')
                ->where('id', '=', $id)
                ->delete();

                return response()->json([
                    'success'=>true,
                    'message'=>'product deleted succeesfully',
                    'data' => $deleted
                ]);                 
    }

}
