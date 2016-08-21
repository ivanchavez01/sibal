<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
use Excel;
use Mmoreram\Extractor\Filesystem\SpecificDirectory;
use Mmoreram\Extractor\Resolver\ExtensionResolver;
use Mmoreram\Extractor\Extractor;

use App\Http\Requests;
use Validator;

class Import extends Controller
{

    public $lot = 0;

    public function view() 
    {
      return view("import.view");
    }


    public function upload(Request $req) 
    {
      $validation = Validator::make($req->all(), [
        'file' => 'required|mimes:zip,rar'
      ]);
     
      if($validation->fails()) {
        return response()->json(["status" => "error"]);
      }

      $file = $req->file('file');
      $filename = $file->getClientOriginalName();

      if($file->move(base_path('tmp'), $filename)) {
        return response()->json(["status" => "success", "filename" => $filename]);
      }

      return response()->json(["status" => "error"]);
    }


    public function unzip(Request $req) 
    {
      try
      {
        $filename = $req->input("filename");
        $folder = md5(microtime());
        if(!is_dir(base_path("tmp/".$folder))) 
          mkdir(base_path("tmp/".$folder));

        $specificDirectory = new SpecificDirectory(base_path("tmp/".$folder));
        $extensionResolver = new ExtensionResolver;
        $extractor = new Extractor(
            $specificDirectory,
            $extensionResolver
        );
       
        $files = $extractor->extractFromFile(base_path('tmp/'.$filename));
        Storage::delete('tmp/'.$filename);

        return response()->json(["status" => "success", "dir" => $folder]);
      }
      catch(Exception $ex)
      {
        return response()->json(["status" => "error"]);
      }
    }

    public function list_files(Request $req)
    {
        $files = Storage::disk('local')->files("tmp/".$req->input("dir"));
        return view('import.listFiles', ['files' => $files, "req" => $req]);
    }

    public function movePhotos(Request $req)
    {
      $files = Storage::allFiles('tmp/'.$req->input("dir")."/".$req->input("fphotos"));
      if(!empty($files))
      {
        foreach($files as $file)
        {
          $real_name = str_replace(["tmp/", $req->input("dir")."/", $req->input("fphotos")."/"],["", "", ""],$file);
          Storage::move("tmp/".$req->input("dir")."/".$req->input("fphotos").'/'.$real_name, 'storage/app/students/'.$real_name);
        }
      }
    }

    public function process(Request $req)
    {
      ini_set('xdebug.max_nesting_level', 1000);

      $lot = new \App\Lots();
      $lot->dir = $req->input('dir');
      $lot->save();
      
      if($lot->lot_id > 0)
      {
        $this->lot = $lot->lot_id;
        $this->process_calif($req->input('fcalif'), $lot->dir);
        $this->process_911($req->input("f911"), $lot->dir);
      
        $this->clean_tmp($lot->dir);
      }
      
    }


    //no routing
    protected function process_911($file, $dir) 
    {
      $filename = "tmp/".$dir."/".$file;
      Excel::selectSheetsByIndex(0)->load(base_path($filename), function($sheet1) {
        $sheet1->each(function($row){
          
          if(isset($row->usuario) && $row->usuario != null)
          {
            $id = $row->usuario;
            $data = json_encode($row);

            $doc_index = new \App\Doc911();
            $doc_index->user_sibal = $id;
            $doc_index->data = $data;
            $doc_index->lot_id = $this->lot;
            $doc_index->save();
          }
        });
      });
    }
    
    protected function process_calif($file, $dir) 
    {
      $filename = "tmp/".$dir."/".$file;
      
      Excel::load(base_path($filename), function($book) {
        $sheet_index_virtual = microtime();

        $book->each(function($sheet2){
  
          $matters_id = $sheet2->getTitle();
         
            $sheet2->each(function($row) use($matters_id){
              if(isset($row->usuario) && $row->usuario != null)
              {
                
                if(strlen($matters_id) > 8){ $matters_id = "0".$matters_id; }

                $doc_calif = new \App\DocCalf();
                $doc_calif->user_sibal = $row->usuario;
                $doc_calif->data = json_encode($row);
                $doc_calif->lot_id = $this->lot;
                $doc_calif->matters_id = ($matters_id == "") ? $sheet_index_virtual : $matters_id;        
                $doc_calif->save();
              }
            });
          
          
        });
      });
    }

    protected function clean_tmp($dir) {
      //Storage::delete('tmp/'.$dir);
    }
}
