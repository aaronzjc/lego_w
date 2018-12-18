<?php

return [
    [
        "title" => "BASIC",
        "groups" => [
            [
                "title" => "首页",
                "pattern" => "/",
                "route" => "/",
                "groups" => []
            ],
            [
                "title" => "专题管理",
                "pattern" => "page*",
                "route" => "/page",
                "groups" => []
            ]
        ]
    ]
];