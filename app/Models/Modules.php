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

    public static $moduleTypes = [
        0 => ["name" => "index", "title" => "剧集"],
        10 => ["name" => "tab", "title" => "Tab模块"],
        21 => ["name" => "basic_info", "title" => "基本信息模块"],
    ];

    public static $statusType = [
        0 => "无效",
        1 => "有效"
    ];

    public function formatResult($result = [])
    {
        $result["type_name"] = self::$moduleTypes[$result["type"]]['title'];
        $result["status_name"] = self::$statusType[$result["type"]];
        $result["data_expand"] = json_decode($result["data"], true)?:[];

        return $result;
    }
}
