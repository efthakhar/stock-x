<?php

namespace App\Http\Controllers\file;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class FileController extends Controller
{

    function getFiles()
    {
            $allfiles = [];

            $files = File::files(public_path('upload'));
            
            $dir_path = url('/upload');

            foreach($files as $file){
                $allfiles[] = [
                    'name'=>$file->getFilename(),
                    'size'=>$file->getSize(),
                ];
            }

            return response()->json([$allfiles, $dir_path]);
    }

    function upload(Request $request)
    {
       
        $upload_path = public_path('upload');
        $file_name = $request->file->getClientOriginalName();
        $file_extention = $request->file->guessClientExtension();

        if(in_array($file_extention,['jpeg','jpg','png','webp'])){

            $generated_new_name = time() . '-' . $file_name;
            $request->file->move($upload_path, $generated_new_name);
            
            return response()->json(['file_name' => url('/')."/"."upload"."/".$generated_new_name ]);

        }else{
            return response()->json(['file_name' => url('/')."/"."upload"."/".'dummy.png' ]);
        }
       
    }

    function delete(Request $request)
    {
        
        $path = $request->filename;
        if($path=='dummy.png'){
            return response()->json('dymmu file can not be deleted');
        }
        $fullpath = public_path('upload/').$path;

        // return json_encode($fullpath);
 
        if(file_exists($fullpath)){
            unlink($fullpath);
            return response()->json('deletd');
        }else{
            return response()->json('not found to delete');
         }
   
       

    }


    
}
