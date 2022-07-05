<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User as model;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * fild view location and route
     * @var string $folder 
     */
    protected $folder = 'user';

    /**
     * listing data table
     * 
     * @var array $data_table
     */
    protected $data_table = ['username', 'email'];

    /**
     * set get searching query
     * 
     * @param string $value
     */
    protected function search_data_table($value)
    {
        $arr = [];
        foreach($this->data_table as $item) {
            array_push($arr, [$item, 'like', '%'.$value.'%']);
        }
        return $arr;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $model = new model();
        if ($request->search) {
            $new_model = $model->where($this->search_data_table($request->search));
        } else {
            $new_model = $model;
        }
        $model = $new_model->latest()->paginate(10);
        return view('admin.'.$this->folder.'.index', compact('model'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model = [];
        $roles = Role::all();
        return view('admin.'.$this->folder.'.create', compact('model', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $model = new model();
        $this->validate($request, $model->rules());
        $model->loadModel($request->all());
        try {
            $model->save();
        } catch (\Throwable $th) {
            return redirect()->back()->with($this->get_set_message_crud(false, 'create', null, $th->getMessage()));
        }
        return redirect()->route('admin.'.$this->folder.'.index')->with($this->get_set_message_crud());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model = model::findOrFail($id);
        return view('admin.'.$this->folder.'.show', compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = model::findOrFail($id);
        $roles = Role::all();
        return view('admin.'.$this->folder.'.edit', compact('model', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $model = model::findOrFail($id);
        $new_model = new model();
        $this->validate($request, $new_model->rules());
        $model->loadModel($request->all());
        try {
            $model->save();
        } catch (\Throwable $th) {
            return redirect()->back()->with($this->get_set_message_crud(false, 'edit', null, $th->getMessage()));
        }
        return redirect()->route('admin.'.$this->folder.'.index')->with($this->get_set_message_crud(true, 'edit'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = model::findOrFail($id);
        try {
            $model->delete();
        } catch (\Throwable $th) {
            return redirect()->back()->with($this->get_set_message_crud(false, 'delete', null, $th->getMessage()));
        }
        return redirect()->route('admin.'.$this->folder.'.index')->with($this->get_set_message_crud(true, 'delete'));
    }
}
