<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddToFavouritesRequest;
use App\Http\Requests\FilesActionRequest;
use App\Http\Requests\ShareFilesRequest;
use App\Http\Requests\StoreFileRequest;
use App\Http\Requests\StoreFolderRequest;
use App\Http\Requests\TrashFilesRequest;
use App\Http\Resources\FileResource;
use App\Jobs\UploadFileToCloudJob;
use App\Mail\ShareFilesMail;
use App\Models\File;
use App\Models\FileShare;
use App\Models\StarredFile;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Kalnoy\Nestedset\NodeTrait;
use Inertia\Inertia;
class FileController extends Controller
{
    //

    public function myFiles(Request $request, string $folder = null)
    {

    
        if($folder){
          $folder = File::query()->where('created_by' , Auth::id())
          ->where('path' , $folder)
          ->firstOrFail();

     
        }
       // dd($folder);
        if(!$folder){
        $folder = $this->getRoot();
        
        }
       
    $files = File::query()
      ->where('parent_id' , $folder->id)
      ->where('created_by' , Auth::id())
      ->orderBy('is_folder' , 'desc')
      ->orderBy('created_at' , 'desc')
      ->paginate(10);
  
  

      $files = FileResource::collection($files);


       return Inertia::render('MyFiles' , compact('files' , 'folder'));
    }





   public function createFolder(StoreFolderRequest $request)
    {
        $data = $request->validated();
        $parent = $request->parent;

        if (!$parent) {
        $this->getRoot();
        }

        $file = new File();
        $file->is_folder = 1;
        $file->name = $data['name'];

        $parent->appendNode($file);
      
    }
    

    private function getRoot()
    {
        return File::query()->whereIsRoot()->where('created_by', Auth::id())->firstOrFail();
    }
}
