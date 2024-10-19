<?php

namespace App\Http\Controllers;

use App\Models\Career;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CareerController extends Controller
{
    public function index()
    {
        $careers = Career::all(); // Mengambil semua data pekerjaan dari database
        return view('admin.career.index', compact('careers'));
    }
    public function create()
    {

        return view('admin.career.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'job_name' => 'required|string|max:255',
            'maximum_age' => 'required|integer',
            'minimum_education' => 'required|in:High School,Associate\'s Degree,Bachelor\'s Degree,Master\'s Degree,Doctorate',
            'major' => 'required|string|max:255',
            'salary' => 'required|string|max:255',
            'open_date' => 'required|date',
            'close_date' => 'required|date|after_or_equal:open_date',
            'job_desc' => 'required|string',
            'job_criteria' => 'required|string',
        ]);

        Career::create($request->all());

        return redirect()->route('career.index')->with('success', 'Career created successfully.');
    }
    public function edit($id)
    {
        $careers = Career::findOrFail($id);
        return view('admin.career.edit', compact('careers'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'job_name' => 'required',
            'maximum_age' => 'required|integer',
            'minimum_education' => 'required',
            'major' => 'required',
            'salary' => 'required',
            'open_date' => 'required|date',
            'close_date' => 'required|date|after_or_equal:open_date',
            'job_desc' => 'required',
            'job_criteria' => 'required',
        ]);

        $careers = Career::findOrFail($id);
        $careers->update($request->all());

        return redirect()->route('career.index')->with('success', 'Career updated successfully');
    }
    public function destroy($id)
    {
        $careers = Career::findOrFail($id);
        $careers->delete();

        return redirect()->route('career.index')->with('success', 'Career deleted successfully');
    }

}
