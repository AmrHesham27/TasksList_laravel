<?php

namespace App\Http\Traits;
use Illuminate\Http\Request;

Trait ImageUploader
{
    public function checkImage(Request $request){
        $data =  $this->validate($request,[
            "image" => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if (!$data) dd('availabe extensions are jpeg,png,jpg,gif,svg and max file size is 2048 kb');
        return $data;
    }

    public function uploadImage($request)
    {
        $path = public_path('tmp/uploads');
        $file = $request->file('image');

        $fileArray = explode('/', $file->getClientOriginalName());
        $fileArray = explode('.', end($fileArray));
        $fileExtension = strtolower(end( $fileArray ));

        $fileName = uniqid() . '.' . $fileExtension;
        //dd($fileName);
        $file->move($path, $fileName);

        return $fileName;
    }
}
?>
