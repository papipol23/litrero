<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    // public function __construct()
    // {
    //    $this->middleware('permission:user-manage|user-create|user-edit|user-delete', ['only' => ['index','show']]);
    //     $this->middleware('permission:user-create', ['only' => ['create','store']]);
    //     $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
    //     $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    // }

    public function index(Request $request)
    {
        $query = User::query();

        // Check if there's a search term
        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', "%$searchTerm%")
                    ->orWhere('email', 'like', "%$searchTerm%");
            });
        }

        // Get paginated results
        $items = $query->paginate(10);

        // Pass the search term to the view
        $searchTerm = $request->search;

        return view('accesscontrol.user.index', compact('items', 'searchTerm'));
    }

    public function create()
    {
        return view('accesscontrol.user.create');
    }
    public function store(Request $request)
    {
        User::create($request->only(['title', 'desc']));

        return redirect()->route('course.index')->with(['function' => 'store']);
    }
    public function edit($id)
    {
        $roles = Role::all();
        $item = User::find($id);
        return view('accesscontrol.user.edit', compact('item','roles'));
    }
    public function update(Request $request, $id)
    {
        $item = User::find($id);
        $item->update($request->only(['name']));
        $item->roles()->sync($request->role_id);
        return redirect()->route('user.index')->with(['function' => 'update']);
    }
    public function destroy($id)
    {
        $item = User::find($id);
        $item->delete();
        return 'success';
    }
}
