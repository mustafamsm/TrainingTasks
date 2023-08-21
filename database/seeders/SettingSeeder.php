<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $seetings=[
            ['key'=>'site_name_ar','value'=>'المكتبة','group'=>'general'],
            ['key'=>'site_name_en','value'=>'book store','group'=>'general'],
            ['key'=>'site_description_ar','value'=>'Laravel Blog','group'=>'general'],
            ['key'=>'site_description_en','value'=>'Laravel Blog','group'=>'general'],
            ['key'=>'site_status','value'=>'1','group'=>'general'],
            ['key'=>'site_message_ar','value'=>'Welcome to my blog','group'=>'general'],
            ['key'=>'site_message_en','value'=>'Welcome to my blog','group'=>'general'],
            ['key'=>'site_footer_ar','value'=>'Laravel Blog','group'=>'general'],
            ['key'=>'site_footer_en','value'=>'Laravel Blog','group'=>'general'],
            ['key'=>'site_logo','value'=>'logo.png','group'=>'general'],
            ['key'=>'site_favicon','value'=>'favicon.png','group'=>'general'],
            ['key'=>'site_address_ar','value'=>'Dhaka,Bangladesh','group'=>'general'],
            ['key'=>'site_address_en','value'=>'Dhaka,Bangladesh','group'=>'general'],
            ['key'=>'site_email','value'=>'contaict@gmail.com','group'=>'contact'],
            ['key'=>'site_facebook','value'=>'https://www.facebook.com','group'=>'social'],
            ['key'=>'site_twitter','value'=>'https://www.twitter.com','group'=>'social'],
            ['key'=>'site_linkedin','value'=>'https://www.linkedin.com','group'=>'social'],
            ['key'=>'site_youtube','value'=>'https://www.youtube.com','group'=>'social'],
            ['key'=>'site_instagram','value'=>'https://www.instagram.com','group'=>'social'],
            ['key'=>'site_phone','value'=>'0599895582','group'=>'contact'],
            ['key'=>'site_whatsapp','value'=>'0599895582','group'=>'contact'],
            ['key'=>'site_skype','value'=>'0599895582','group'=>'contact'],
            ['key'=>'site_telegram','value'=>'0599895582','group'=>'contact'],

        ];
        foreach($seetings as $seeting){
            Setting::create($seeting);
        }
        // Setting::create($seetings);
    }
}
