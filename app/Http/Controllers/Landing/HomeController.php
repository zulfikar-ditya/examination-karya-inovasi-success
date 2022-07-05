<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Stories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::check()) {
            $model = new Stories();

            if ($request->search) {
                $new_stories = $model->orderByDesc('created_at')->where('title', 'like', "%$request->search%");
            } else {
                $new_stories = $model->orderByDesc('created_at');
            }

            if ($request->category_id) {
                $stories = $new_stories->where('category_id', $request->category_id)->paginate(12);
            } else {
                $stories = $new_stories->paginate(12);
            }
            
            $categories = Category::orderBy('name', 'asc')->get();
            $my_stories = Stories::orderByDesc('created_at')->where('user_id', Auth::user()->id)->paginate(3);
            return view('client.index', compact('stories', 'categories', 'my_stories'));
        } else {
            return redirect()->route('login');
        }
    }

    public function home()
    {
        return redirect()->route('index');
    }
}
