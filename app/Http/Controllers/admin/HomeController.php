<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Response;
use Illuminate\Http\Request;
use Lego\Services\ModuleService;

class HomeController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        return view("admin.index");
    }

    public function page(ModuleService $service, Request $request)
    {
        $page = $request->get("page", 0);
        $modules = $service->fetchRootModules([], $page);

        return view("admin.page.index", ["modules" => $modules]);
    }

    public function editPage(ModuleService $service, Request $request)
    {
        $req = $request->all();

        if (isset($req["submit"])) {
            $status = $service->upsertModule($req);
            if (!$status) {
                return json_encode(["success" => false]);
            }

            return json_encode(["success" => true]);
        }

        $module = [
            "title" => ""
        ];
        if (isset($req["id"])) {
            $module = $service->fetchRootModules(["id" => $req["id"]]);
            if (!empty($module)) {
                $module = $module[0];
            }
        }

        return view('admin.page.edit', ["data" => $module]);
    }

    public function configPage(Request $request, ModuleService $service)
    {
        $pageId = $request->get("id");
        if (!$pageId) {
            return Response::to404();
        }

        $pageTree = $service->pageTree($pageId);

        $pageInfo = $service->pageInfo($pageId);

        return view("admin.page.config", ["page_modules" => $pageTree, "page_info" => $pageInfo]);
    }

    public function savePageConfig(Request $request, ModuleService $service)
    {
        $cnf = $request->post("cnf", []);
        $pageId = $request->post("page_id");
        if (empty($cnf)) {
            return Response::jsonFail("配置不存在");
        }

        $re = $service->saveTabConfig($pageId, $cnf);
        if ($re["status"]) {
            return Response::jsonSuccess($re["msg"]);
        } else {
            return Response::jsonFail($re["msg"]);
        }
    }

    public function modules()
    {
        return view("admin.home");
    }

}
