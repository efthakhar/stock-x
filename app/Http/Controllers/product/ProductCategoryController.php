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

    public function show($id)
   {
         $category = DB::table('product_categories')
                    ->find($id); 
       
         return response()->json($category);       
    }

    // get all child category of a specific category id
    public function getchilds($id){

        $final = [];

        $categories =
         DB::table('product_categories')
        ->where('parent_category_id',$id)
        ->get()
        ->toArray();

        foreach($categories as $child){
              
           array_push($final,$child->id);

           $childcats = $this->getchilds($child->id);

           foreach($childcats as $child)
           { 
              array_push($final,$child);
           }
          
        }
        
        return $final;
        

    }

    function getAllChildCats($id){
       $all_child_cat = $this->getchilds($id);
       return json_encode($all_child_cat);
    }



    function store(Request $request){

        $Category = DB::table('product_categories')->insert([
            'category_name' => $request->category_name,
            'category_slug' =>  str_replace(" ","-",$request->category_slug),
            'parent_category_id' => $request->parent_category_id,
            'category_img_url' => $request->category_img_url
        ]);

        return response()->json([
            "success" => true,
            "message" => "Product Category Created Successfully.",
            "data" => $Category
            ]);  
                    
    }
    public function update(Request $request,$id)
    {
              $updated = DB::table('product_categories')
               ->where('id', $id)
               ->update([
                'category_name' => $request->category_name,
                'category_slug' =>  str_replace(" ","-",$request->category_slug),
                'parent_category_id' => $request->parent_category_id,
                'category_img_url' => $request->category_img_url
             ]);
 
             return response()->json([
                 'success'=>true,
                 'message'=>'category updated succeesfully',
                 'data' => $updated
             ]);
    }
 
    public function delete($id)
    {
             $deleted = DB::table('product_categories')
                         ->where('id', '=', $id)
                         ->delete();
 
             return response()->json([
                 'success'=>true,
                 'message'=>'product category deleted succeesfully',
                 'data' => $deleted
             ]);
    }
}
