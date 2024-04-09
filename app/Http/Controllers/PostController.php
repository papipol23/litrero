<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

    //public function __construct()
    // {
        // $this->middleware('permission:post-manage|post-create|post-edit|post-delete', ['only' => ['index','show']]);
        //  $this->middleware('permission:post-create', ['only' => ['create','store']]);
        //  $this->middleware('permission:post-edit', ['only' => ['edit','update']]);
        //  $this->middleware('permission:post-delete', ['only' => ['destroy']]);
   // }


    public function index(Request $request)
    {
     $query = Post::query();

        // Check if there's a search term
        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', "%$searchTerm%");
                   // ->orWhere('desc', 'like', "%$searchTerm%");
            });
        }

        // Get paginated results
        $items = $query->paginate(10);

        // Pass the search term to the view
        $searchTerm = $request->search;

        return view('post.index', compact('items', 'searchTerm'));
    }

    public function create()
    {
        return view('post.create');
    }
    public function store(Request $request)
    {
        Post::create($request->only(['title', 'content']));

        return redirect()->route('post.index')->with(['function' => 'store']);
    }
    public function edit($id)
    {
        $item = Post::find($id);
        return view('post.edit', compact('item'));
    }
    public function update(Request $request, $id)
    {
        $item = Post::find($id);
        $item->update($request->only(['title',  'desc']));

        return redirect()->route('post.index')->with(['function' => 'update']);
    }
    public function destroy($id)
    {
        $item = Post::find($id);
        $item->delete();
        return 'success';
    }
}
