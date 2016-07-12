<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;

use Mmoreram\Extractor\Filesystem\SpecificDirectory;
use Mmoreram\Extractor\Resolver\ExtensionResolver;
use Mmoreram\Extractor\Extractor;

use App\Http\Requests;

class Import extends Controller
{
    public function view() 
    {
      return view("import.view");
    }

    public function upload() 
    {
        $filename = "sibal-julio-2016.zip";
        //$filesystem->get('tmp/'.$filename);
        //Storage::disk('local')->get('tmp/'.$filename);
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
    }

    public function list_files(Request $req)
    {
      $fileType = [
        ["id" => 1, "name" => "911"],
        ["id" => 2, "name" => "Calificaciones"]
      ];

      $files = Storage::disk('local')->files("tmp/".$req->input("dir"));
      return view('import.listFiles', ['files' => $files, "fileTypes" => $fileType]);
    }

    public function process(Request $req)
    {
      
      $data_911   = $this->process_911($req->input("f911"));
      // $data_calif = $this->process_calif($req->input('fcalif'));
      // $this->save_on_database($data_911, $data_calif);
      
      // $this->process_photos('/Fotos');
    }


    //no routing
    protected function process_911($file) {
      echo $file;
      return;
    }
    
    protected function process_calif($file) {
      return;
    }

    protected function save_on_database($data_911, $data_calif) {
      return;
    }

    protected function process_photos($dir) {

    }
}
