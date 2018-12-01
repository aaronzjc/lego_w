<?php

namespace Lego\Services;

use App\Models\Modules;

class ModuleService
{
    public function fetchRootModules($where, $page = 0, $count = 10)
    {
        $m = Modules::query();

        $where += ["type" => 0];
        if (!empty($where)) {
            $m->where($where);
        }

        if ($page) {
            $m->offset($page * $count);
        }

        $result = $m->limit($count)->get()->toArray();
        foreach ($result as $k => $v) {
            $result[$k] = app(Modules::class)->formatResult($v);
        }

        return $result;
    }

    public function upsertModule($data)
    {
        if (isset($data["id"])) {
            $m = Modules::find($data["id"]);
        } else {
            $m = new Modules();
            $m->type = 0;
        }

        isset($data["title"]) && $m->title = $data["title"];
        isset($data["type"]) && $m->type = $data["type"];

        $m->save();

        return true;
    }

    public function changeModuleStatus($id, $status)
    {
        $m = Modules::find($id);
        $m->status = $status;
        $m->save();

        return true;
    }

    public function deleteModule($id)
    {
        $m = Modules::where(['id' => $id])->delete();

        return true;
    }
}