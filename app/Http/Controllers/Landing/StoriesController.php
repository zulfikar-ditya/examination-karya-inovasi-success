<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Stories as model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoriesController extends Controller
{
    /**
     * fild view location and route
     * @var string $folder 
     */
    protected $folder = 'my-stories';

    /**
     * listing data table
     * 
     * @var array $data_table
     */
    protected $data_table = ['title', 'short_content'];

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
        $model = $new_model->latest()->where('user_id', Auth::user()->id)->paginate(10);
        return view('client.'.$this->folder.'.index', compact('model'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model = [];
        $categories = Category::all();
        return view('client.'.$this->folder.'.create', compact('model', 'categories'));
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
        $request['user_id'] = Auth::user()->id;
        $model->loadModel($request->all());

        if ($request->hasFile('image')) {
            $model->image = $this->upload_file($request->file('image'), 'stories');
        }

        try {
            $model->save();
        } catch (\Throwable $th) {
            return redirect()->back()->with($this->get_set_message_crud(false, 'create', null, $th->getMessage()));
        }
        return redirect()->route('client.'.$this->folder.'.index')->with($this->get_set_message_crud());
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
        if ($model->user_id != Auth::user()->id) return abort(404);
        return view('client.'.$this->folder.'.show', compact('model'));
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
        $categories = Category::all();
        if ($model->user_id != Auth::user()->id) return abort(404);
        return view('client.'.$this->folder.'.edit', compact('model', 'categories'));
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
        if ($model->user_id != Auth::user()->id) return abort(404);
        $old_file = $model->image;
        $new_model = new model();
        $this->validate($request, $new_model->rules());
        $model->loadModel($request->all());

        if ($request->hasFile('image')) {
            $this->delete_file($old_file ?? "");
            $model->image = $this->upload_file($request->file('image'), 'stories');
        }
        try {
            $model->save();
        } catch (\Throwable $th) {
            return redirect()->back()->with($this->get_set_message_crud(false, 'edit', null, $th->getMessage()));
        }
        return redirect()->route('client.'.$this->folder.'.index')->with($this->get_set_message_crud(true, 'edit'));
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
        if ($model->user_id != Auth::user()->id) return abort(404);
        $old_file = $model->old_file;
        try {
            $model->delete();
            $this->delete_file($old_file ?? "");
        } catch (\Throwable $th) {
            return redirect()->back()->with($this->get_set_message_crud(false, 'delete', null, $th->getMessage()));
        }
        return redirect()->route('client.'.$this->folder.'.index')->with($this->get_set_message_crud(true, 'delete'));
    }
}
