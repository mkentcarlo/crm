<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class CustomService
{
	public function createImageFromBase64($imgFile, $key)
	{
	    $file_data = explode(',', $imgFile)[1];
  	    $file_data = str_replace(' ', '+', $file_data);
	    $file_extension = $this->getB64Type($imgFile);
	    $file_name = $key . time() . '.'. $file_extension; //generating unique file name;

	    if ($file_data != "") { // storing image in storage/app/public Folder
	       Storage::disk('public')->put($file_name, base64_decode($file_data));
	    }		   

	    return $file_name;
	}

	public function createImageFromBase64Files($imgFiles)
	{
	    $file_names = [];
	    foreach($imgFiles as $key => $value) {
	  	    $file_names[] = $this->createImageFromBase64($value, $key);
	    }

	    return $file_names;
	}

	public function getB64Type($imgFile) 
    {
        return substr($imgFile, 11, strpos($imgFile, ';')-11);
    } 

    public function getUploadedImg($imageFile)
	{
	    $fileName = '';
	    if ($imageFile) {
		    $userImage = $imageFile;
		    $fileName = time().'.'.$userImage->getClientOriginalExtension();
		    $destinationPath = public_path('/uploads');
		    if (is_writable($destinationPath)) {
		        $userImage->move($destinationPath, $fileName);
	      	}
	    }

	    return $fileName;
	  }  
	}
