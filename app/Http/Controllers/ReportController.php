<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;


class ReportController extends Controller
{
    //
    
public function index()
{
    $reports = Report::whereNull('deleted_at')->get();
    return view('reports.index', compact('reports'));
}


public function create()
{$students = User::all(); // Or paginate/filter if needed
    return view('reports.create', compact('students'));
}

public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'student_id' => 'required|exists:users,id',
        'attachment' => 'nullable|file|mimes:csv,pdf,docx,xlsx,jpg,png|max:4096',
    ]);

    $report = new Report();
    $report->title = $request->title;
    $report->description = $request->description;
    $report->student_id = $request->student_id;
   
    if ($request->hasFile('attachment')) {
        $filename = $request->file('attachment')->hashName(); // unique name
        $request->file('attachment')->storeAs('reports', $filename, 'public');
        $report->attachment = $filename; // Save just filename in DB
    }
    

    $report->save();

    return redirect()->route('reports.index')->with('success', 'Report created successfully.');
}


public function getFile($filename)
{
    $path = 'reports/' . $filename;

    if (!Storage::disk('public')->exists($path)) {
        abort(404, 'File not found');
    }

    return response()->file(storage_path('app/public/' . $path));
}



public function show(Report $report)
{
    return view('reports.show', compact('report'));
}

public function edit(Report $report)
{
    
    $students = User::all();
    return view('reports.edit', compact('report', 'students'));
}

public function update(Request $request, Report $report)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'student_id' => 'required|exists:users,id',
        'attachment' => 'nullable|file|mimes:csv,pdf,docx,xlsx,jpg,png|max:4096',
    ]);
    
    $report->title = $request->title;
    $report->description = $request->description;
    $report->student_id = $request->student_id;
 
    if ($request->hasFile('attachment')) {
        $file = $request->file('attachment');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('public/reports', $filename);
        $report->attachment = $filename;
    }
    

    $report->save();

    return redirect()->route('reports.index')->with('success', 'Report updated successfully.');
}


public function destroy(Report $report)
{
    $report->delete();
    return redirect()->route('reports.index')->with('success', 'Report deleted successfully');
}
}
