<?php

namespace App\Http\Controllers\product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class ProductStockController extends Controller
{
    function index(){
        $stocks = DB::table('product_stocks')->get()->toArray(); 
        $arranged_stocks = [];
        foreach($stocks as $stock) {
            $arranged_stocks[$stock->product_id] = $stock;
        }          
        return response()->json($arranged_stocks);
    }

    public function show($id,$wid)
   {
         $stock = DB::table('product_stocks')
                    ->where('product_id',$id)
                    ->where('warehouse_id',$wid)
                    ->first(); 
       
         return response()->json($stock);       
    }


    public function store(Request $request){

        $stock = DB::table('product_stocks')->insert([
            'product_id' => $request->product_id,
            'product_stock' => $request->product_stock,
            'warehouse_id' => $request->warehouse_id
        ]);

        return response()->json([
            "success" => true,
            "message" => "stock Created Successfully.",
            "data" => $stock
            ]);  
                    
    }
    public function update(Request $request)
    {
              $updated = DB::table('product_stocks')
               ->where('product_id',   $request->product_id)
               ->where('warehouse_id', $request->warehouse_id)
               ->update([

                'product_id' => $request->product_id,
                'product_stock' => $request->product_stock,
                'warehouse_id' => $request->warehouse_id
                
             ]);
 
             return response()->json([
                 'success'=>true,
                 'message'=>'stock updated succeesfully',
                 'data' => $updated
             ]);
    }
 

    public function delete($id)
    {
           
                $deleted = DB::table('product_stocks')
                ->where('product_id', '=', $id)
                ->delete();

                return response()->json([
                    'success'=>true,
                    'message'=>'product stock deleted succeesfully',
                    'data' => $deleted
                ]);
    }
}
