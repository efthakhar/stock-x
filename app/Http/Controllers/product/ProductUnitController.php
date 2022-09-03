<?php

namespace App\Http\Controllers\product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductUnitController extends Controller
{
    function index(){
        $units = DB::table('product_units')
        ->get()->toArray(); 
        $arranged_units = [];
        foreach($units as $unit) {
            $arranged_units[$unit->id] = $unit;
        }          
        return response()->json($arranged_units);
    }

    public function show($id)
   {
         $unit = DB::table('product_units')
                    ->find($id); 
       
         return response()->json($unit);       
    }


    public function store(Request $request){

        $unit = DB::table('product_units')->insert([
            'unit_name' => $request->unit_name,
            'unit_code' => $request->unit_code,
            'locked' => $request->locked
        ]);

        return response()->json([
            "success" => true,
            "message" => "Unit Created Successfully.",
            "data" => $unit
            ]);  
                    
    }
    public function update(Request $request,$id)
    {
              $updated = DB::table('product_units')
               ->where('id', $id)
               ->update([

                'unit_name' => $request->unit_name,
                'unit_code' => $request->unit_code,
                'locked' => $request->locked
                
             ]);
 
             return response()->json([
                 'success'=>true,
                 'message'=>'unit updated succeesfully',
                 'data' => $updated
             ]);
    }
 

    public function delete($id)
    {
            $unit = DB::table('product_units')
            ->find($id); 
            if($unit->locked==true){
                return response()->json([
                    'success'=>false,
                    'message'=>'product unit can not delete',
                    'data' => 0
                ]);

            }else{
                $deleted = DB::table('product_units')
                ->where('id', '=', $id)
                ->delete();

                return response()->json([
                    'success'=>true,
                    'message'=>'product unit deleted succeesfully',
                    'data' => $deleted
                ]);
            }
            
 
             
    }
}
