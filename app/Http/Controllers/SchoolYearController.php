<?php

namespace App\Http\Controllers;

use App\Models\SchoolYear;
use Illuminate\Http\Request;

class SchoolYearController extends Controller
{

    public function index(Request $request)
{
    $query = SchoolYear::query();

    // Check if there's a search term
    if ($request->has('search')) {
        $searchTerm = $request->search;
        $query->where(function($q) use ($searchTerm) {
            $q->where('startyear', 'like', "%$searchTerm%")
              ->orWhere('endyear', 'like', "%$searchTerm%")
              ->orWhere('desc', 'like', "%$searchTerm%");
        });
    }

    // Get paginated results
    $items = $query->paginate(10);

    // Pass the search term to the view
    $searchTerm = $request->search;

    return view('schoolsettings.schoolyear.index', compact('items', 'searchTerm'));
}

    public function create()
    {
        return view('schoolsettings.schoolyear.create');
    }
    public function store(Request $request)
    {
        $item = SchoolYear::create($request->only(['startyear', 'endyear', 'desc']));
        return redirect()->route('schoolyear.index')->with(['function'=>'store']);
    }
    public function edit($id)
    {
        $item = SchoolYear::find($id);
        return view('schoolsettings.schoolyear.edit', compact('item'));
    }
    public function update(Request $request, $id)
    {
        $item = SchoolYear::find($id);
        $item->update($request->only(['startyear', 'endyear', 'desc']));

        return redirect()->route('schoolyear.index')->with(['function'=>'update']);
    }
    public function destroy($id)
    {
        $item = SchoolYear::find($id);
        $item->delete();
        return 'success';
    }
    public function verify(){

    }
}
