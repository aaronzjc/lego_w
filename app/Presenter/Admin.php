<?php

namespace App\Presenter;

class Admin
{
    public function renderMenu()
    {
        $menu = <<<str
<aside class="menu">
    <p class="menu-label">
        BASIC
    </p>
    <ul class="menu-list">
        <li><a class="is-active">模块管理</a></li>
        <li><a>模块管理</a></li>
        <li><a>模块管理</a></li>
    </ul>
</aside>
str;

        return $menu;

    }
}