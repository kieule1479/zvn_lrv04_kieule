<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;



class AdminController extends Controller
{
    protected $pathViewController = '';
    protected $controllerName     = '';
    protected $params             = [];
    protected $model;


    //======== INDEX =========
    public function index(Request $request)
    {
        $this->params['filter']['status'] = $request->input('filter_status', 'all');
        $this->params['search']['field']  = $request->input('search_field', '');
        $this->params['search']['value']  = $request->input('search_value', '');

        $items              = $this->model->listItems($this->params, ['task'  => 'admin-list-items']);
        $itemsStatusCount   = $this->model->countItems($this->params, ['task' => 'admin-count-items-group-by-status']);

        return view($this->pathViewController .  'index', [
            'params'           => $this->params,
            'items'            => $items,
            'itemsStatusCount' => $itemsStatusCount
        ]);
    }

    //======== STATUS =========
    public function status(Request $request)
    {
        $params["currentStatus"]  = $request->status;
        $params["id"]             = $request->id;
        $this->model->saveItem($params, ['task' => 'change-status']);
        return redirect()->route($this->controllerName)->with('zvn_notify', 'Cập nhật trạng thái thành công!');
    }

    //======== DELETE =========
    public function delete(Request $request)
    {
        $params["id"]             = $request->id;
        $this->model->deleteItem($params, ['task' => 'delete-item']);
        return redirect()->route($this->controllerName)->with('zvn_notify', 'Xóa phần tử thành công!');
    }


}

