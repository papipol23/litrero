<?php

namespace App\Http\Controllers;

use App\Models\Level;
use Illuminate\Http\Request;

class LevelController extends Controller
{
    public function index(Request $request)
    {
        $query = Level::query();

        // Check if there's a search term
        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', "%$searchTerm%")
                    ->orWhere('desc', 'like', "%$searchTerm%");
            });
        }

        // Get paginated results
        $items = $query->paginate(10);

        // Pass the search term to the view
        $searchTerm = $request->search;

        return view('schoolsettings.level.index', compact('items', 'searchTerm'));
    }

    public function create()
    {
        return view('schoolsettings.level.create');
    }
    public function store(Request $request)
    {
        Level::create($request->only(['title', 'desc']));
        return redirect()->route('level.index')->with(['function' => 'store']);
    }
    public function edit($id)
    {
        $item = Level::find($id);
        return view('schoolsettings.level.edit', compact('item'));
    }
    public function update(Request $request, $id)
    {
        $item = Level::find($id);
        $item->update($request->only(['title',  'desc']));

        return redirect()->route('level.index')->with(['function' => 'update']);
    }
    public function destroy($id)
    {
        $item = Level::find($id);
        $item->delete();
        return 'success';
    }
}
