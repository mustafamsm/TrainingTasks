<?php

namespace App\Http\Controllers;

use App\Models\TemporaryFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UploadController extends Controller
{
    public function upload(Request $request)
    {
        if ($request->hasFile('image')) {

            $file = $request->file('image');
            $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
            $folder = uniqid() . '-' . now()->timestamp;
            $file->storeAs('images/tmp/' . $folder, $filename, 'public');
            TemporaryFile::create([
                'folder' => $folder,
                'filename' => $filename,
            ]);
            return $folder;
        }
        if ($request->hasFile('site_logo')) {
            $file = $request->file('site_logo');
            $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
            $folder = uniqid() . '-' . now()->timestamp;
            $file->storeAs('images/tmp/' . $folder, $filename, 'public');
            TemporaryFile::create([
                'folder' => $folder,
                'filename' => $filename,
            ]);
            return $folder;
        }
        if ($request->hasFile('site_favicon')) {
            $file = $request->file('site_favicon');
            $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
            $folder = uniqid() . '-' . now()->timestamp;
            $file->storeAs('images/tmp/' . $folder, $filename, 'public');
            TemporaryFile::create([
                'folder' => $folder,
                'filename' => $filename,
            ]);
            return $folder;
        }
        return '';
    }
    public function delete(Request $request)
    {

        $id=Str::substr(request()->getContent(), 0, 24);
        $temp_file = TemporaryFile::where('folder',$id )->first();

        if ($temp_file) {
            Storage::deleteDirectory('public/images/tmp/' . $id, true);
            // sleep 1 second because of race condition with HD
            sleep(1);
            // actually delete the folder itself
            Storage::deleteDirectory('public/images/tmp' . $id);
            $temp_file->delete();
        }
        $path = request()->getContent();





        return "";
    }
}
