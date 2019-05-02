<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class ImageService
{
  /**
   * Upload user profile image
   * 
   * @param String $imageFile name of the profile image
   * 
   * @return Array
   */
  public function getUploadedUserImg($imageFile)
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

  public function getUploadedProductImg($imageFile)
  {
      $fileName = '';
      if ($imageFile) {
        $img = $imageFile;
        $fileName = time().'.'.$img->getClientOriginalExtension();
        Storage::disk('public')->put('product-images/'.$fileName, file_get_contents($img->getRealPath()));
      }

      return $fileName;
    
  }
}
