<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PhotoController extends Controller {

    public function store()
    {
        // validate the user and get user_id
        $file = Input::file('fileName');
        $fileName = str_random() . '.' . $file->getClientOriginalExtension();
        $image = ImageManagerStatic::make($file->getRealPath());

        $year = date('Y');
        $month = date('m');
        $day = date('d');

        $filePath =  "/images/$year/$month/$day";
        $storagePath = public_path()  . $filePath;

        File::exists($storagePath) or File::makeDirectory($storagePath, 0755, true);
        $image->save($storagePath . '/' . $fileName);

        $url = "http://" . Request::getHost();
        $url .= intval(Request::getPort()) == 80 ? '' : ':' . Request::getPort();

        Photo::create([
            'file_name' => $filePath . '/' . $fileName,
            'user_id' => '1',
            'size' => $file->getSize()
        ]);

        return Response::json([
            'url' => $url . $filePath . '/' . $fileName
        ]);
    }

}
