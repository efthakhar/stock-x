<?php

namespace App\Http\Controllers\setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class TaxController extends Controller
{
    function index(){

        $taxes = DB::table('taxes')->get()->toArray(); 

        $arranged_taxes = [];

        foreach($taxes as $tax) {
            $arranged_taxes[$tax->id] = $tax;
        }  

        return response()->json($arranged_taxes);
    }

    public function show($id)
    {
          $tax = DB::table('taxes')
                     ->find($id); 
        
          return response()->json($tax);       
     }
 
 
     public function store(Request $request){
 
         $tax = DB::table('taxes')->insert([
             'tax_name' => $request->tax_name,
             'tax_code' => $request->tax_code,
             'tax_rate' => $request->tax_rate,
         ]);
 
         return response()->json([
             "success" => true,
             "message" => "tax Created Successfully.",
             "data" => $tax
             ]);  
                     
     }
     public function update(Request $request,$id)
     {
               $updated = DB::table('taxes')
                ->where('id', $id)
                ->update([
                    'tax_name' => $request->tax_name,
                    'tax_code' => $request->tax_code,
                    'tax_rate' => $request->tax_rate,       
              ]);
  
              return response()->json([
                  'success'=>true,
                  'message'=>'tax updated succeesfully',
                  'data' => $updated
              ]);
     }
  
 
     public function delete($id)
     {           
                 $deleted = DB::table('taxes')
                 ->where('id', '=', $id)->delete();
 
                 return response()->json([
                     'success'=>true,
                     'message'=>'product tax deleted succeesfully',
                     'data' => $deleted
                 ]);           
     }

}
