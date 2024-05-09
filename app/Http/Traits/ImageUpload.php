<?php

namespace App\Http\Traits;


trait ImageUpload
{

    public function uploadImage($request, $path, $old_image = null)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path($path);
            if ($old_image != null && file_exists(public_path($old_image))) {
                unlink($old_image);
            }

            $image->move($destinationPath, $image_name);
            //get image with full path
            return $path . $image_name;
        }
        return null;
    }

    public function deleteImage($image)
    {
        if ($image != null && file_exists(public_path($image))) {
            unlink(public_path($image));
        }
    }
    
}
