<?php
namespace App\Helpers;


use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class Image
{


    public static function Image($request, $tmpFile, $folder, $model)
    {
        info('iam in image helper');
    $image=Str::substr($request->image, 0, 24);
        File::copy(storage_path('app/public/images/tmp/' . $image . '/' . $tmpFile->filename), storage_path('app/public/'.$folder.'/'  . $tmpFile->filename));
        $model->image = $tmpFile->filename;
        $model->save();
        Storage::deleteDirectory('public/images/tmp/' . $tmpFile->folder, true);
        // sleep 1 second because of race condition with HD
        sleep(1);
        // actually delete the folder itself
        Storage::deleteDirectory('public/images/tmp' . $tmpFile->folder);

        $tmpFile->delete();
    }
}
