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

        if (!$file->isValid()) {
            $error_code = $file->getError();

            if ($error_code == UPLOAD_ERR_NO_FILE) {
                return redirect()->back()
                                 ->with('warning', '沒有上傳選擇任何檔案');
            }
            throw new \RuntimeException($file->getErrorString(). ' ' . $error_cod);
        }
    }
}