<?php

namespace App\Http\Controllers\product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductBrandController extends Controller
{
    public function index()
    {
        $brands = DB::table('product_brands')->get()->toArray(); 
        $arranged_brands = [];
        foreach($brands as $brand) {
            $arranged_brands[$brand->id] = $brand;
        }          
        return response()->json($arranged_brands);

    }

    public function show($id)
    {
        $brand = DB::table('product_brands')->find($id); 

        return response()->json($brand);  
    }

    public function store(Request $request)
    {
       $brand = DB::table('product_brands')->insert([

            'brand_name' => $request->brand_name,
            'brand_slug' => $request->brand_slug,
            'brand_img_url' => $request->brand_img_url
        
        ]);

        return response()->json([
            "success" => true,
            "message" => "Product Brand Created Successfully.",
            "data" => $brand
            ]);  

    } 

    public function update(Request $request,$id)
    {
        $brand = DB::table('product_brands')
        ->where('id',$id)
        ->update([

            'brand_name' => $request->brand_name,
            'brand_slug' => $request->brand_slug,
            'brand_img_url' => $request->brand_img_url
        
        ]);

        return response()->json([
            "success" => true,
            "message" => "Product Brand Updated Successfully.",
            "data" => $brand
            ]);  

    }

    public function delete($id)
    {

        $deleted = DB::table('product_brands')
                         ->where('id', '=', $id)
                         ->delete();
 
             return response()->json([
                 'success'=>true,
                 'message'=>'product Brand deleted succeesfully',
                 'data' => $deleted
             ]);

    }


}
