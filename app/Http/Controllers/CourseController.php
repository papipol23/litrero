<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{

    public function index(Request $request)
    {
        $query = Course::query();

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

        return view('schoolsettings.course.index', compact('items', 'searchTerm'));
    }

    public function create()
    {
        return view('schoolsettings.course.create');
    }
    public function store(Request $request)
    {
        Course::create($request->only(['title', 'desc']));

        return redirect()->route('course.index')->with(['function' => 'store']);
    }
    public function edit($id)
    {
        $item = Course::find($id);
        return view('schoolsettings.course.edit', compact('item'));
    }
    public function update(Request $request, $id)
    {
        $item = Course::find($id);
        $item->update($request->only(['title',  'desc']));

        return redirect()->route('course.index')->with(['function' => 'update']);
    }
    public function destroy($id)
    {
        $item = Course::find($id);
        $item->delete();
        return 'success';
    }
}
