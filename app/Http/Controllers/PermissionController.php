<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
//  public function __construct()
    // {
        // $this->middleware('permission:permission-manage|permission-create|permission-edit|permission-delete', ['only' => ['index','show']]);
        //  $this->middleware('permission:permission-create', ['only' => ['create','store']]);
        //  $this->middleware('permission:permission-edit', ['only' => ['edit','update']]);
        //  $this->middleware('permission:permission-delete', ['only' => ['destroy']]);
    // }
    public function index(Request $request)
    {
        $query = Permission::query();

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

        return view('accesscontrol.permission.index', compact('items', 'searchTerm'));
    }

    public function create()
    {
        return view('accesscontrol.permission.create');
    }
    public function store(Request $request)
    {
        Permission::create($request->only(['name']));

        return redirect()->route('permission.index')->with(['function' => 'store']);
    }
    public function edit($id)
    {
        $item = Permission::find($id);
        return view('accesscontrol.permission.edit', compact('item'));
    }
    public function update(Request $request, $id)
    {
        $item = Permission::find($id);
        $item->update($request->only(['title',  'desc']));

        return redirect()->route('permission.index')->with(['function' => 'update']);
    }
    public function destroy($id)
    {
        $item = Permission::find($id);
        $item->delete();
        return 'success';
    }
}
