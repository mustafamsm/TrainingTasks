<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
            ['key'=>'site_name','value'=>'Laravel Blog','group'=>'general'],
            ['key'=>'site_description','value'=>'Laravel Blog','group'=>'general'],
            ['key'=>'site_status','value'=>'active','group'=>'general'],
            ['key'=>'site_message','value'=>'Welcome to my blog','group'=>'general'],
            ['key'=>'site_footer','value'=>'Laravel Blog','group'=>'general'],
            ['key'=>'site_logo','value'=>'logo.png','group'=>'general'],
            ['key'=>'site_icon','value'=>'favicon.png','group'=>'general'],
            ['key'=>'site_address','value'=>'Dhaka,Bangladesh','group'=>'general'],
            ['key'=>'site_email','value'=>'contaict@gmail.com','group'=>'contact'],
            ['key'=>'phone','value'=>'0599895582','group'=>'contact'],

            
        ];
        foreach($seetings as $seeting){
            Setting::create($seeting);
        }
        // Setting::create($seetings);
    }
}
