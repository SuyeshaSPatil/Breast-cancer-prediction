<?php

namespace App\Http\Controllers;

use App\Models\User; // Import the User model
use App\Models\Diagnosis; // Assuming Diagnosis is the model for the diagnoses table
use Illuminate\Http\Request;

class DiagnosisController extends Controller
{
    
    public function index()
{
    $diagnoses = Diagnosis::with('patient')->get(); // eager load patient relationship
    return view('diagnosis.index', compact('diagnoses'));
}
    // Method to show the form for creating a diagnosis
    public function create()
    {
        // Get all users (patients) from the 'users' table
        $patients = User::all();  // Fetch patients from the users table
        return view('diagnosis.create', compact('patients'));
    }

    // Method to store the diagnosis in the database
    public function store(Request $request)
    {
        // Validate incoming request data
        $request->validate([
            'patient_id' => 'required|exists:users,id', // Updated to use users table
            'diagnosis_result' => 'required|string',
            'stage' => 'required|string',
        ]);

        // Create a new diagnosis entry
        Diagnosis::create([
            'patient_id' => $request->patient_id,
            'diagnosis_result' => $request->diagnosis_result,
            'stage' => $request->stage,
            'notes' => $request->notes,
        ]);

        // Redirect to the diagnosis index page with a success message
        return redirect()->route('diagnosis.index')->with('success', 'Diagnosis added successfully!');
    }

    public function edit($id)
{
    $diagnosis = Diagnosis::findOrFail($id); // assumes you are using a Diagnosis model

    return view('diagnosis.edit', compact('diagnosis'));
}

public function update(Request $request, $id)
{
    // Validate input
    $request->validate([
        'diagnosis_result' => 'required|string|max:255',
        'stage' => 'required|string|max:100',
    ]);

    // Find the diagnosis entry
    $diagnosis = Diagnosis::findOrFail($id);

    // Update fields
    $diagnosis->diagnosis_result = $request->diagnosis_result;
    $diagnosis->stage = $request->stage;
    $diagnosis->save();

    // Redirect or return with success message
    return redirect()->route('diagnosis.index')->with('success', 'Diagnosis updated successfully!');
}
public function destroy($id)
{
    $diagnosis = Diagnosis::findOrFail($id);
    $diagnosis->delete(); // Soft delete

    return redirect()->route('diagnosis.index')->with('success', 'Diagnosis deleted successfully!');
}
}
