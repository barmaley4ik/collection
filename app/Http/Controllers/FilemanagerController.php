<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Traits\FmTrait;


class FilemanagerController extends Controller
{
  use FmTrait;

    public function upload(Request $request)
    {
      $directory = ''; 
      $uploadedFile = $request->file('sFilename');
      if ($request->has('directory')) {
        $directory = $request->directory;
      }
      $filename = $uploadedFile->getClientOriginalName();

      if (Storage::disk('public')->putFileAs(
        $directory,
        $uploadedFile,
        $filename
      )) {
        return response()->json([
            'success' => true,
        ], 200);
      }
      
    }

    public function index(Request $request)
    {

        $directory = 'public'; 
        $url = 'fm/index'; 
        if ($request->has('directory')) {
          $directory = $directory . '/'.$request->directory;
        }
        
        $folderItems = $this->getFolders($directory);
        $fileItems = $this->getFiles($directory);

        $collection = collect($folderItems);
        $collection = $collection->concat($fileItems);

        $page = (int) $request->input('page') ?: 1;
        $onPage = 11;
        
        $slice = $collection->slice(($page-1)* $onPage, $onPage);
        
        $paginator = new \Illuminate\Pagination\LengthAwarePaginator($slice, $collection->count(), $onPage); 
        $paginator->withPath(url($url));
        $paginator->appends(request()->query());

        return response()->json([
            'success' => true,
            'items' => $paginator,
        ], 200);
      
    }
 
}
