<?php

namespace App\Listeners;

use App\Events\FooterMenu;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Footer;

class MenuTreeUpdate
{
    /**
     * If the menu is updated, write the submenus to the database in json format.
     *
     * @param  FooterMenu  $event
     * @return void
     */
    public function handle(FooterMenu $event)
    {
        $footer = $event->footer;

        if ($footer->parent_id == 0) {
            $subLink = Footer::where('parent_id', '=', $footer->id_menu)
                               ->orderBy('sort', 'ASC')
                               ->select('id_menu', 'name', 'url')
                               ->get();
            $footer->tree = json_encode(array('menu'=>$subLink));
            $footer->save();
        } else {
            $subLink = Footer::where('parent_id', '=', $footer->parent_id)
                               ->orderBy('sort', 'ASC')
                               ->select('id_menu', 'name', 'url')
                               ->get();
            $main = Footer::findOrFail($footer->parent_id);
            $main->tree = json_encode(array('menu'=>$subLink));
            $main->save();
        }
    }
}
