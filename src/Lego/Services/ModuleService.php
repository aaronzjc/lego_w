<?php

namespace Lego\Services;

use App\Models\Modules;

class ModuleService
{
    public function fetchRootModules($where, $page = 0, $count = 10)
    {
        $m = Modules::query();

        $where[] = ["type", "=" , 0];
        if (!empty($where)) {
            $m->where($where);
        }

        if ($page) {
            $m->offset($page * $count);
        }

        $result = $m->limit($count)->get()->toArray();
        foreach ($result as $k => $v) {
            $result[$k] = Modules::formatResult($v);
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
            $m->parent_id = 0;
        }

        isset($data["parent_id"]) && $m->type = $data["parent_id"];
        isset($data["sort"]) && $m->type = $data["sort"];
        isset($data["title"]) && $m->title = $data["title"];
        isset($data["type"]) && $m->type = $data["type"];
        isset($data["data"]) && $m->type = $data["data"];
        isset($data["status"]) && $m->type = $data["status"];

        $m->save();

        return true;
    }

    public function deleteModule($id)
    {
        $m = Modules::where(['id' => $id])->delete();

        return true;
    }

    public function pageInfo($pageId)
    {
        $page = $this->fetchRootModules([["id", "=", $pageId]]);
        $page = empty($page)?[]:$page[0];

        return ["id" => $page["id"], "title" => $page["title"]];
    }

    public function pageTree($pageId)
    {
        $result = [];
        $tabs = Modules::query()->where([
            ["parent_id", "=", $pageId],
            ["type", "=", Modules::MODULE_TAB]
        ])->whereNull("delete_at")->orderBy("sort", "asc")->get()->toArray();

        foreach ($tabs as $tab) {
            $result[$tab["id"]] = Modules::formatTab($tab);
        }
        $tabModules = Modules::query()
            ->whereIn("parent_id", array_keys($result))
            ->whereNull("delete_at")
            ->get()
            ->toArray();
        foreach ($tabModules as $mm) {
            if (empty($mm)) {
                continue;
            }
            $mm = Modules::formatTabModule($mm);
            $tabId = $mm["parent_id"];
            $mm["key"] = intval(count($result[$tabId]["modules"]));
            $result[$tabId]["modules"][] = $mm;
        }

        return array_values($result);
    }

    public function saveTabConfig($pageId, $cnf)
    {
        if (empty($pageId)) {
            return ["status" => false, "msg" => "page参数为空"];
        }

        if (empty($cnf)) {
            return ["status" => false, "msg" => "配置为空"];
        }

        // 保存Tab
        if ($cnf["id"]) {
            $tab = Modules::find($cnf["id"]);
        } else {
            $tab = new Modules();
        }
        $tab->parent_id = $pageId;
        $tab->type = Modules::MODULE_TAB;
        $tab->title = $cnf["title"];
        $tab->status = intval($cnf["enabled"]);
        $tab->sort = intval($cnf["sort"]);
        $tab->save();

        if (empty($cnf["modules"])) {
            return ["status" => true, "msg" => "【{$tab->title}】保存成功"];
        }

        foreach ($cnf["modules"] as $k => $module) {
            if ($module["id"]) {
                $m = Modules::find($module["id"]);
            } else {
                $m = new Modules();
            }

            $m->parent_id = $tab->id;
            $m->type = intval($module["type"]);
            $m->title = $module["title"];
            $m->data = json_encode($module["data"]);
            $m->status = intval($module["enabled"]);
            $m->sort = $k;
            $m->save();
        }

        return ["status" => true, "msg" => "【{$tab->title}】保存成功"];
    }

    public function previewPage($pageId)
    {
        $root = Modules::query()->where([
            ["id" , "=", $pageId],
            ["type", "=", Modules::MODULE_PAGE]
        ])->first()->toArray();

        $tabs = Modules::query()
            ->where("parent_id", $root["id"])
            ->where("type", Modules::MODULE_TAB)
            ->orderBy("sort", "asc")
            ->get()->toArray();

        $modules = Modules::query()
            ->whereIn("parent_id", array_column($tabs, "id"))
            ->orderBy("sort", "asc")
            ->get()->toArray();
        $tabMs = [];
        foreach ($modules as $m) {
            $tabMs[$m["parent_id"]][] = [
                "id" => $m["id"],
                "card_type" => $m["type"],
                "title" => $m["title"],
                "data" => json_decode($m["data"])?:new \stdClass
            ];
        }

        $page = [
            "id" => $root["id"],
            "title" => $root["title"],
            "tab_list" => []
        ];

        foreach ($tabs as $tab) {
            $page["tab_list"][] = [
                "id" => $tab["id"],
                "title" => $tab["title"],
                "data" => json_decode($tab["data"])?:new \stdClass,
                "card_list" => $tabMs[$tab["id"]]??[]
            ];
        }

        return $page;
    }
}