<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Response;
use Illuminate\Http\Request;
use Lego\Services\ModuleService;
use Log;

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

    public function configPage(Request $request)
    {
        $pageId = $request->get("id");
        if (!$pageId) {
            return Response::to404();
        }
        return view("admin.page.config");
    }

    public function modules()
    {
        return view("admin.home");
    }

}
