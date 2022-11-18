<?php
namespace App\Traits;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


trait StorageFileTrait{
    
    public function storageFileUpload($request, $fieldName, $folderName)
    {
        if($request->hasFile($fieldName)){
            $file = $request->$fieldName;
            $originalFileName = $file->getClientOriginalName();
            $hashedFileName = Str::random(20) . '.' . $file->getClientOriginalExtension();
            $filePath = $request->file($fieldName)->storeAs('public/'. $folderName, $hashedFileName);
            $dataUploaded= [
                'file_name' => $originalFileName,
                'file_path' => Storage::url($filePath) 
            ];
            return $dataUploaded;
        }
        return null;
    }

    public function storageMultipleFileUpload($file, $folderName)
    {
        $originalFileName = $file->getClientOriginalName();
        $hashedFileName = Str::random(20) . '.' . $file->getClientOriginalExtension();
        $filePath = $file->storeAs('public/'. $folderName, $hashedFileName);
        $dataUploaded= [
            'file_name' => $originalFileName,
            'file_path' => Storage::url($filePath) 
        ];
        return $dataUploaded;
    }
}
