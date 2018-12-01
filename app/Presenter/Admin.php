<?php

namespace App\Presenter;

use Illuminate\Support\Facades\App;
use Log;

class Admin
{
    public static $menus = [];

    public function __construct()
    {
        App::configure("menus");
        self::$menus = config("menus");
    }

    public function renderMenu()
    {
        $menu = "";
        foreach (self::$menus as $group) {
            if (empty($group["groups"])) {
                continue;
            }

            $menu .= "<p class='menu-label'>{$group["title"]}</p>";
            $subLen = count($group["groups"]);
            for ($i=0;$i<$subLen;$i++) {
                $subMenu = "";
                $ssLen = count($group["groups"][$i]["groups"]);
                for ($j=0;$j<$ssLen;$j++) {
                    if ($j == 0) {
                        $subMenu .= "<ul>";
                    }
                    $subMenu .= $this->makeMenuItem($group["groups"][$i]["groups"][$j]);
                    if ($j == $ssLen - 1) {
                        $subMenu .= "</ul>";
                    }
                }
                if ($i == 0) {
                    $menu .= "<ul class='menu-list'>";
                }

                $menu .= $this->makeMenuItem($group["groups"][$i], $subMenu);
                if ($i == $subLen - 1) {
                    $menu .= "</ul>";
                }
            }
        }

        return $menu;

    }

    private function makeMenuItem($menu, $subMenu = "")
    {
        $request = app("request");
        $class = "";
        if ($request->is($menu["pattern"])) {
            $class = "class = 'is-active'";
        }

        return sprintf(
            "<li><a %s href='%s'>%s</a>%s</li>",
            $class,
            $menu["route"],
            $menu["title"],
            $subMenu
        );
    }
}