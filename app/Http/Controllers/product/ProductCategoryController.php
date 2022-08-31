<?php

namespace App\Http\Controllers\product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductCategoryController extends Controller
{
    function index(){
        $categories = DB::table('product_categories')
        ->get()->toArray(); 
        $arranged_categories = [];
        foreach($categories as $category) {
            $arranged_categories[$category->id] = $category;
        }          
        return response()->json($arranged_categories);
    }

    function store(Request $request){


        $Category = DB::table('product_categories')->insert([
            'category_name' => $request->category_name,
            'category_slug' => $request->category_slug,
            'parent_category_id' => $request->parent_category_id,
            'category_img_url' => $request->category_img_url
        ]);

        return response()->json([
            "success" => true,
            "message" => "Product Category Created Successfully.",
            "data" => $Category
            ]);  
                    
    }
}
