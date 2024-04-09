<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\Level;
use Illuminate\Http\Request;

class SectionController extends Controller
{

    public function index(Request $request)
    {
        $query = Section::query();
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

        return view('schoolsettings.section.index', compact('items', 'searchTerm'));
    }

    public function create()
    {
        $levels = Level::query()->orderBy('title','ASC')->get();

        return view('schoolsettings.section.create', compact('levels'));
    }
    public function store(Request $request)
    {
        Section::create($request->only(['title','level_id', 'desc']));
        return redirect()->route('section.index')->with(['function' => 'store']);
    }
    public function edit($id)
    {
        $levels = Level::query()->orderBy('title','ASC')->get();
        $item = Section::find($id);
        return view('schoolsettings.section.edit', compact('item','levels'));
    }
    public function update(Request $request, $id)
    {
        $item = Section::find($id);
        $item->update($request->only(['title','level_id', 'desc']));

        return redirect()->route('section.index')->with(['function' => 'update']);
    }
    public function destroy($id)
    {
        $item = Section::find($id);
        $item->delete();
        return 'success';
    }
}
