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
    protected $mainRequest;


    //======== INDEX =========
    public function index(Request $request)
    {
        $this->params['filter']['status'] = $request->input('filter_status', 'all');
        $this->params['search']['field']  = $request->input('search_field', ''); // all id description
        $this->params['search']['value']  = $request->input('search_value', '');

        $items              = $this->model->listItems($this->params, ['task'  => 'admin-list-items']);
        $itemsStatusCount   = $this->model->countItems($this->params, ['task' => 'admin-count-items-group-by-status']); // [ ['status', 'count']]

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



    // public function save(MainRequest $request)
    // {
    //     // $request = $this->mainRequest;
    //     // dd($request);
    //     if ($request->method() == 'POST') {

    //         $params = $request->all();


    //         $task   = "add-item";
    //         $notify = "Thêm phần tử thành công!";

    //         if ($params['id'] !== null) {
    //             $task   = "edit-item";
    //             $notify = "Cập nhật phần tử thành công!";
    //         }

    //         $this->model->saveItem($params, ['task' => $task]);
    //         return redirect()->route($this->controllerName)->with("zvn_notify", $notify);
    //     }
    // }





}

