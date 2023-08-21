<?php

namespace App\Http\Controllers;

use App\Models\Setting;

use Illuminate\Http\Request;
use App\Models\TemporaryFile;
use Illuminate\Support\Facades\File;
 use Illuminate\Support\Facades\Storage;
 use Illuminate\Support\Str;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('dashboard.settings.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'site_name_ar' => 'required|string|max:191',
            'site_name_en' => 'required|string|max:191',
            'site_description_ar' => 'required|string|max:191',
            'site_description_en' => 'required|string|max:191',
            'site_status' => 'required|in:0,1',
            'site_message_ar' => 'required|string|max:191',
            'site_message_en' => 'required|string|max:191',
            'site_footer_ar' => 'required|string|max:191',
            'site_footer_en' => 'required|string|max:191',

            'site_address_ar' => 'required|string|max:191',
            'site_address_en' => 'required|string|max:191',
            'site_email' => 'required|email|max:191',
            'site_phone' => 'required|string|max:191',
            'site_whatsapp' => 'required|string|max:191',
            'site_skype' => 'required|string|max:191',
            'site_telegram' => 'required|string|max:191',
            'site_facebook' => 'required|string|max:191',
            'site_twitter' => 'required|string|max:191',
            'site_linkedin' => 'required|string|max:191',
            'site_youtube' => 'required|string|max:191',
            'site_instagram' => 'required|string|max:191',
        ]);
        foreach ($request->except(['_token', 'site_logo','site_favicon']) as $key => $value) {



            Setting::where(['key' => $key])->update(['value' => $value]);
        }





        $tempFile = TemporaryFile::where('folder',  Str::substr($request->site_logo, 0, 24))->first();
        if ($request->has('site_logo')){
            if ($tempFile) {
                File::copy(storage_path('app/public/images/tmp/' .  Str::substr($request->site_logo, 0, 24) . '/' . $tempFile->filename), storage_path('app/public/site/' . $tempFile->filename));

                Setting::where(['key' => 'site_logo'])->update(['value' => $tempFile->filename]);


                Storage::deleteDirectory('public/images/tmp/' . $tempFile->folder, true);
                // sleep 1 second because of race condition with HD
                sleep(1);
                // actually delete the folder itself
                Storage::deleteDirectory('public/images/tmp' . $tempFile->folder);

                $tempFile->delete();
            }
        }
        $tempFile = TemporaryFile::where('folder',  Str::substr($request->site_favicon, 0, 24))->first();

        if ($request->has('site_favicon')){
            if ($tempFile) {
                File::copy(storage_path('app/public/images/tmp/' .  Str::substr($request->site_favicon, 0, 24) . '/' . $tempFile->filename), storage_path('app/public/site/' . $tempFile->filename));

                Setting::where(['key' => 'site_favicon'])->update(['value' => $tempFile->filename]);


                Storage::deleteDirectory('public/images/tmp/' . $tempFile->folder, true);
                // sleep 1 second because of race condition with HD
                sleep(1);
                // actually delete the folder itself
                Storage::deleteDirectory('public/images/tmp' . $tempFile->folder);

                $tempFile->delete();
            }
        }

        return redirect()->route('dashboard.settings.index')->with('success', __('site.updated_successfully'));
        // $setting=Setting::where('key',$key)-firstOrFail();


    }
}
