<?php

namespace App\Http\Controllers\file;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FileController extends Controller
{
    function upload(Request $request)
    {
       
        $upload_path = public_path('upload');
        $file_name = $request->file->getClientOriginalName();
        $generated_new_name = time() . '-' . $file_name;
        $request->file->move($upload_path, $generated_new_name);
        
        return response()->json(['file_name' => url('/')."/"."upload"."/".$generated_new_name ]);
    }


    
}
