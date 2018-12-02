<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Modules extends Model
{
    use SoftDeletes;

    protected $table = "modules";
    protected $fillable = [
        'type', 'data', 'sort', 'status'
    ];
    protected $guarded = ['id', 'create_at', 'delete_at'];
    public $timestamps = false;

    const DELETED_AT = 'delete_at';
    protected $dates = ['delete_at'];

    const MODULE_PAGE = 0;
    const MODULE_TAB = 10;
    const MODULE_BASIC = 20;

    public static $moduleTypes = [
        self::MODULE_PAGE => ["name" => "index", "title" => "剧集"],
        self::MODULE_TAB => ["name" => "tab", "title" => "Tab模块"],
        self::MODULE_BASIC => [
            "name" => "v-module-basic",
            "title" => "基本信息模块",
            "format" => [Modules::class, "formatBasicModule"]
        ],
    ];

    public static $statusType = [
        0 => "无效",
        1 => "有效"
    ];

    public static function formatResult($result = [])
    {
        $result["type_name"] = self::$moduleTypes[$result["type"]]['title'];
        $result["status_name"] = self::$statusType[$result["type"]];
        $result["data_expand"] = json_decode($result["data"], true)?:[];

        return $result;
    }

    public static function formatTab($tab = [])
    {
        $format = [];
        $format["id"] = intval($tab["id"]);
        $format["parent_id"] = intval($tab["parent_id"]);
        $format["title"] = $tab["title"];
        $format["enabled"] = (bool)intval($tab["status"]);
        $format["modules"] = [];

        return $format;
    }

    public static function formatTabModule($m)
    {
        if (!isset(self::$moduleTypes[$m["type"]])) {
            return false;
        }

        $method = self::$moduleTypes[$m["type"]]["format"];
        if (method_exists(...$method)) {
            return call_user_func_array($method, [$m]);
        }

        return false;
    }

    public static function formatBasicModule($module)
    {
        $format = [];
        $format["id"] = intval($module["id"]);
        $format["parent_id"] = intval($module["parent_id"]);
        $format["module_type"] = self::$moduleTypes[$module["type"]]["name"];
        $format["type"] = $module["type"];
        $format["enabled"] = (bool)intval($module["status"]);
        $format["title"] = $module["title"];
        $format["data"] = json_decode($module["data"])?:new \stdClass();
        $format["state"] = ["collapse" => false];

        return $format;
    }
}
