<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Models\CategoryModel as MainModel;
use App\Http\Requests\CategoryRequest as MainRequest ;

class CategoryController extends AdminController
{

    //======== __CONSTRUCT =========
    public function __construct()
    {
        $this->pathViewController = 'admin.pages.category.';
        $this->controllerName     = 'category';
        $this->model              = new MainModel();

        $this->params["pagination"]["totalItemsPerPage"] = 10;
        view()->share('controllerName', $this->controllerName);
    }

    //======== FORM =========
    public function form(Request $request)
    {
        $item = null;
        if($request->id !== null ) {
            $params["id"] = $request->id;
            $item = $this->model->getItem( $params, ['task' => 'get-item']);
        }

        return view($this->pathViewController .  'form', [
            'item'        => $item
        ]);
    }

    //======== IS HOME =========
    public function isHome(Request $request)
    {
        $params["currentIsHome"]  = $request->isHome;
        $params["id"]             = $request->id;
        $this->model->saveItem($params, ['task' => 'change-is-home']);
        return redirect()->route($this->controllerName)->with('zvn_notify', 'Cập nhật trạng thái hiển thị trang chủ thành công!');
    }

    //======== DISPLAY =========
    public function display(Request $request) {
        $params["currentDisplay"]   = $request->display;
        $params["id"]               = $request->id;
        $this->model->saveItem($params, ['task' => 'change-display']);
        return redirect()->route($this->controllerName)->with("zvn_notify", "Cập nhật kiểu hiện thị thành công!");
    }


}
