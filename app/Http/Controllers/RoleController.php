<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    // public function __construct()
    // {
        // $this->middleware('permission:role-manage|role-create|role-edit|role-delete', ['only' => ['index','show']]);
        //  $this->middleware('permission:role-create', ['only' => ['create','store']]);
        //  $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
        //  $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    // }
    public function index(Request $request)
    {
        $query = Role::query();

        // Check if there's a search term
        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', "%$searchTerm%");

            });
        }

        // Get paginated results
        $items = $query->paginate(10);

        // Pass the search term to the view
        $searchTerm = $request->search;

        return view('accesscontrol.role.index', compact('items', 'searchTerm'));
    }

    public function create()
    {
        return view('accesscontrol.role.create');
    }
    public function store(Request $request)
    {
        Role::create($request->only(['name']));

        return redirect()->route('role.index')->with(['function' => 'store']);
    }
    public function edit($id)
    {
        $permissions = Permission::all();
        $item = Role::find($id);
        return view('accesscontrol.role.edit', compact('item','permissions'));
    }
    public function update(Request $request, $id)
    {
        $item = Role::find($id);
        $item->update($request->only(['name']));
        $item->permissions()->detach();
        if($request->permissions){
            $item->permissions()->sync($request->permissions);
        }
        return redirect()->route('role.index')->with(['function' => 'update']);
    }
    public function destroy($id)
    {
        $item = Role::find($id);
        $item->delete();
        return 'success';
    }
}
