<?php

namespace App\Controllers;

class Profileimage extends BaseController
{
    public function edit()
    {
        return view('Profileimage/edit');
    }

    public function update()
    {
        $file = $this->request->getFile('image');

        if ( ! $file->isValid()) {

            $error_code = $file->getError();

            if ($error_code == UPLOAD_ERR_NO_FILE) {

                return redirect()->back()
                    ->with('warning', 'No file selected');
            }

            throw new \RuntimeException($file->getErrorString() . " " . $error_code);
        }

        $size = $file->getSizeByUnit('mb');

//        if ($size > 2) {
//
//            return redirect()->back()
//                ->with('warning', 'File too large (max 2MB)');
//        }

        $type = $file->getMimeType();

        if ( ! in_array($type, ['image/png', 'image/jpeg'])) {

            return redirect()->back()
                ->with('warning', 'Invalid file format (PNG or JPEG only)');
        }

        // echo $file->getClientName();
        $path = $file->store('profile_images');

        $path = WRITEPATH. 'uploads/' . $path;

        // CI 提供的內建功能(調整和剪裁上傳的圖片)
        service('image')
            ->withFile($path)
            ->fit(200,200, 'center')
            ->save($path);

        dd($path);
    }
}


