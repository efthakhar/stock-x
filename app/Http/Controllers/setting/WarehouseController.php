<?php

namespace App\Http\Controllers\setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class WarehouseController extends Controller
{
    function index(){
        $warehouses = DB::table('warehouses')
        ->get()->toArray(); 

        $arranged_warehouses = [];

        foreach($warehouses as $warehouse) {
            $arranged_warehouses[$warehouse->id] = $warehouse;
        }  

        return response()->json($arranged_warehouses);
    }

    public function show($id)
    {
          $warehouse = DB::table('warehouses')
                     ->find($id); 
        
          return response()->json($warehouse);       
     }
 
 
     public function store(Request $request){
 
         $warehouse = DB::table('warehouses')->insert([
             'name' => $request->name,
             'phone' => $request->phone,
             'email' => $request->email,
             'address' => $request->address
         ]);
 
         return response()->json([
             "success" => true,
             "message" => "warehouse Created Successfully.",
             "data" => $warehouse
             ]);  
                     
     }
     public function update(Request $request,$id)
     {
               $updated = DB::table('warehouses')
                ->where('id', $id)
                ->update([
                    'name' => $request->name,
                    'phone' => $request->phone,
                    'email' => $request->email,
                    'address' => $request->address         
              ]);
  
              return response()->json([
                  'success'=>true,
                  'message'=>'warehouse updated succeesfully',
                  'data' => $updated
              ]);
     }
  
 
     public function delete($id)
     {           
                 $deleted = DB::table('warehouses')
                 ->where('id', '=', $id)->delete();
 
                 return response()->json([
                     'success'=>true,
                     'message'=>'product warehouse deleted succeesfully',
                     'data' => $deleted
                 ]);           
     }

}
