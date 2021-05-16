<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\SliderModel as MainModel;
use App\Http\Requests\SliderRequest as MainRequest;

class SliderController extends AdminController
{

    //======== __CONSTRUCT =========
    public function __construct()
    {
        $this->pathViewController = 'admin.pages.slider.';
        $this->controllerName     = 'slider';
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
}
