<?php

namespace App\Http\Controllers\product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class StockAdjustmentController extends Controller
{
    function index(){

        $adjustments = DB::table('stock_adjustments')->get()->toArray(); 
        $arranged_adjustments = [];

        foreach($adjustments as $adjustment) {
            $arranged_adjustments[$adjustment->product_id] = $adjustment;
        }          
        return response()->json($arranged_adjustments);

    }

    public function show($id)
   {
         $adjustment = DB::table('stock_adjustments')
                    ->where('id',$id)
                    ->first(); 
       
         return response()->json($adjustment);       
    }


    public function store(Request $request){

        //return $request;

        $stock_adjustment = DB::table('stock_adjustments')->insert([

            'warehouse_id' => $request->warehouse_id,
            'product_id' => $request->product_id,
            'product_name' => $request->product_name,
            'quantity' => $request->quantity,
            'is_addition' => $request->is_addition,
            'note' => $request->note,
            //'date' => $request->time(),
            'date' => date("Y-m-d h:i:s", time() ),
        ]);

        $update = DB::table('product_stocks')
        ->where('product_id',   $request->product_id)
        ->where('warehouse_id', $request->warehouse_id)
        ->update([

        'product_id' => $request->product_id,
        'product_stock' => $request->product_stock,
        'warehouse_id' => $request->warehouse_id
        
        ]);

        if($update==0){

            $stock = DB::table('product_stocks')->insert([
                'product_id' => $request->product_id,
                'product_stock' => $request->product_stock,
                'warehouse_id' => $request->warehouse_id
            ]);

        }

        

        return response()->json([
            "success" => true,
            "message" => "stock_adjustment Created Successfully.",
             "data" => ($stock_adjustment)
            // "data" => $stock_adjustment
            ]);  
                    
    }

    public function update(Request $request)
    {

            $updated1 = DB::table('stock_adjustments')
            ->where('product_id',   $request->product_id)
            ->where('warehouse_id', $request->warehouse_id)
            ->update([

                'warehouse_id' => $request->warehouse_id,
                'product_id' => $request->product_id,
                'product_name' => $request->product_name,
                'quantity' => $request->quantity,
                'is_addition' => $request->is_addition,
                'note' => $request->note,
                'date' => $request->time(),
            ]);

            $updated2 = DB::table('product_stocks')
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
                 'data' => ($updated2 && $updated1)
             ]);
    }
 

    public function delete(Request $request)
    {
           
               $current_stock = DB::table('product_stocks')
                                    ->where('product_id',   $request->product_id)
                                    ->where('warehouse_id', $request->warehouse_id)
                                    ->first();

               $updated_stock = $request->is_addition == true? 
                                $current_stock->product_stock - $request->quantity :
                                $current_stock->product_stock + $request->quantity;
                

                $updated = DB::table('product_stocks')
                                ->where('product_id',   $request->product_id)
                                ->where('warehouse_id', $request->warehouse_id)
                                ->update([
                                    'product_id'    => $request->product_id,
                                    'product_stock' => $updated_stock,
                                    'warehouse_id'  => $request->warehouse_id     
                                ]);

                $deleted = DB::table('stock_adjustments')
                                ->where('product_id', '=', $request->product_id)
                                ->where('warehouse_id', '=', $request->warehouse_id)
                                ->delete();
                

                return response()->json([
                    'success'=>true,
                    'message'=>'product stock deleted succeesfully',
                    'data' => ($updated && $deleted)
                ]);
    }
}
