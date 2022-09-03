<?php

namespace App\Http\Controllers\setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class CurrencyController extends Controller
{
    function index(){
        $currencies = DB::table('currencies')
        ->get()->toArray(); 

        $arranged_currencies = [];

        foreach($currencies as $currency) {
            $arranged_currencies[$currency->id] = $currency;
        }  

        return response()->json($arranged_currencies);
    }

    public function show($id)
    {
          $currency = DB::table('currencies')
                     ->find($id); 
        
          return response()->json($currency);       
     }
 
 
     public function store(Request $request){
 
         $currency = DB::table('currencies')->insert([
             'currency_name' => $request->currency_name,
             'currency_code' => $request->currency_code,
             'currency_symbol' => $request->currency_symbol,
         ]);
 
         return response()->json([
             "success" => true,
             "message" => "currency Created Successfully.",
             "data" => $currency
             ]);  
                     
     }
     public function update(Request $request,$id)
     {
               $updated = DB::table('currencies')
                ->where('id', $id)
                ->update([
                    'currency_name' => $request->currency_name,
                    'currency_code' => $request->currency_code,
                    'currency_symbol' => $request->currency_symbol,       
              ]);
  
              return response()->json([
                  'success'=>true,
                  'message'=>'currency updated succeesfully',
                  'data' => $updated
              ]);
     }
  
 
     public function delete($id)
     {           
                 $deleted = DB::table('currencies')
                 ->where('id', '=', $id)->delete();
 
                 return response()->json([
                     'success'=>true,
                     'message'=>'product currency deleted succeesfully',
                     'data' => $deleted
                 ]);           
     }

}
