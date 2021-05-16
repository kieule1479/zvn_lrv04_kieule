<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\UserModel as MainModel;
use App\Http\Requests\UserRequest as MainRequest;

class UserController extends AdminController
{

    //======== __CONSTRUCT =========
    public function __construct()
    {
        $this->pathViewController = 'admin.pages.user.';
        $this->controllerName     = 'user';
        $this->model              = new MainModel();

        $this->params["pagination"]["totalItemsPerPage"] = 5;
        view()->share('controllerName', $this->controllerName);
    }

    //======== FORM =========
    public function form(Request $request)
    {
        $item = null;
        if ($request->id !== null) {
            $params["id"] = $request->id;
            $item = $this->model->getItem($params, ['task' => 'get-item']);
        }

        return view($this->pathViewController .  'form', [
            'item'        => $item
        ]);
    }

    //======== SAVE =========
    public function save(MainRequest $request)
    {
        // $userRequest = app()->make('\App\Http\Requests\'.ucfirst($request->type));
        if ($request->method() == 'POST') {
            $params = $request->all();

            $task   = "add-item";
            $notify = "Thêm phần tử thành công!";

            if ($params['id'] !== null) {
                $task   = "edit-item";
                $notify = "Cập nhật phần tử thành công!";
            }
            $this->model->saveItem($params, ['task' => $task]);
            return redirect()->route($this->controllerName)->with("zvn_notify", $notify);
        }
    }


    //======== LEVEL =========
    public function level(Request $request)
    {
        $params["currentLevel"] = $request->level;
        $params["id"]           = $request->id;
        $this->model->saveItem($params, ['task' => 'change-level']);
        return redirect()->route($this->controllerName)->with("zvn_notify", "Cập nhật kiểu hiện thị thành công!");
    }
}
