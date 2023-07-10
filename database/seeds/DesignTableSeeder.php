<?php

use Illuminate\Database\Seeder;
use App\Models\Footer;
use App\Models\Design;

class DesignTableSeeder extends Seeder
{
    /**
     * Run e-commerce design database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menu = [
            ['name' => 'MENÜ - 1', 'sort' => '1', 'status' => '1', 'tree' => '{"menu":[]}'],
            ['name' => 'MENÜ - 2', 'sort' => '2', 'status' => '1', 'tree' => '{"menu":[]}'],
            ['name' => 'MENÜ - 3', 'sort' => '3', 'status' => '1', 'tree' => '{"menu":[]}'],
        ];

        Footer::insert($menu);

        Design::create(['logo'         => 'logo.png',
                        'theme_colors' => '{"main":"#000","menu":"#000","newsletter":"#000","footer":"#000",
                                            "socialfooter":"#000","subfooter":"#000","menufont":"#000",
                                            "footerfont":"#000","productborder":"#000"}']);
    }
}
