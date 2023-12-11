<?php

namespace App\Services\Uploader;

use Illuminate\Support\Facades\Storage;

class UploaderService {
    

    public function store(string $path_to, $file): string | null
    {
        if(is_null($file)) return null;

        $filenameWithExt = $file->getClientOriginalName();
        $filename = str()->slug(pathinfo($filenameWithExt, PATHINFO_FILENAME));
        $extention = $file->getClientOriginalExtension();
        $fileNameToStore = trim($path_to, '/')."/".$filename."_".time().".".$extention;
        $file->storeAs('/', $fileNameToStore);

        return $fileNameToStore;
    }

    public function delete(string $path): bool
    {
        if(Storage::disk('public')->exists($path)){
            Storage::delete('/'. $path);
            return true;
        }

        return false;
    }
}