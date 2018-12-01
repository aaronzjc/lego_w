<?php

return [
    [
        "title" => "BASIC",
        "groups" => [
            [
                "title" => "专题管理",
                "pattern" => "/",
                "route" => "/",
                "groups" => []
            ],
            [
                "title" => "模块管理",
                "pattern" => "modules",
                "route" => "modules",
                "groups" => []
            ]
        ]
    ],
    [
        "title" => "DEMO",
        "groups" => [
            [
                "title" => "测试模块",
                "pattern" => "#",
                "route" => "#",
                "groups" => [
                    [
                        "title" => "模块管理1",
                        "pattern" => "#",
                        "route" => "#"
                    ],
                    [
                        "title" => "模块管理2",
                        "pattern" => "#",
                        "route" => "#"
                    ]
                ]
            ]
        ]
    ]
];