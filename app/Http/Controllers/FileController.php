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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Inertia\Inertia;

class FileController extends Controller
{
    //

    public function myFiles()
    {
        return Inertia::render(component:"MyFiles");
    }

    public function createFolder(StoreFolderRequest $request)
    {
              $data = $request->validated();
              $parent = $request->parent;
              
            if(!$parent){
                $parent = $this->getRoot();
            }


            $file = new File();
            $file->is_folder = 1;
            $file->name = $data['name'];

            $parent->appendNode($file);
    }

    private function getRoot()
    {
        return File::query()->where('created_by' , Auth::id())->whereIsRoot()->firstOrFail();
    }
}
