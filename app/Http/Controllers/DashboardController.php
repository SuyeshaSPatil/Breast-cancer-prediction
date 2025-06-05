<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Report;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;


class DashboardController extends Controller
{public function index()
    {
        return view('dashboard.index');
    }
    public function show($userId)
    {
        $user = User::findOrFail($userId);
    
        // Get latest report with attachment
        $report = Report::where('student_id', $userId)
                        ->whereNotNull('attachment')
                        ->latest()
                        ->first();
    
        if (!$report) {
            return view('dashboard.empty', compact('user'));
        }
    
        $filePath = storage_path('app/public/reports/' . $report->attachment);
    
        if (!file_exists($filePath)) {
            abort(404, "Attachment file not found");
        }
    
        $extension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
        $allowedExtensions = ['xls', 'xlsx', 'csv', 'ods'];
    
        if (!in_array($extension, $allowedExtensions)) {
            return view('dashboard.show', compact('user'))
                   ->with('error', 'Uploaded attachment cannot be converted to dashboard');
        }
    
        try {
            $data = $this->readAttachment($filePath);
        } catch (\Exception $e) {
            return view('dashboard.show', compact('user'))
                   ->with('error', 'Failed to read attachment: ' . $e->getMessage());
        }
    
        $mlResult = null;
    
        // ⚙️ If CSV, try running ML analysis
        if ($extension === 'csv') {
            $python = 'C:\Users\91976\AppData\Local\Programs\Python\Python312\python.exe';
$script = base_path('public/python/cancer_predictor.py');
$csv = storage_path('app/uploads/cancer_data.csv');
$process = new Process([$python, $script, $filePath]);

            $process->run();
    
            if ($process->isSuccessful()) {
                $mlResult = json_decode($process->getOutput(), true);
            } else {
                // Optional: you can return error message to view
                $mlResult = ['error' => 'ML script failed to run.'];
            }
        }
    
        return view('dashboard.show', compact('user', 'data', 'mlResult'));
    }
    
private function readAttachment($filePath)
{
    $extension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));

    if ($extension === 'csv') {
        return $this->readCSV($filePath);
    }

    $spreadsheet = IOFactory::load($filePath);
    $sheet = $spreadsheet->getActiveSheet();
    $rows = [];

    foreach ($sheet->getRowIterator() as $row) {
        $cellIterator = $row->getCellIterator();
        $cellIterator->setIterateOnlyExistingCells(false);
        $rowData = [];

        foreach ($cellIterator as $cell) {
            $rowData[] = $cell->getValue();
        }

        $rows[] = $rowData;
    }

    return $rows;
}

private function readCSV($filePath)
{
    $rows = [];
    if (($handle = fopen($filePath, 'r')) !== false) {
        while (($data = fgetcsv($handle, 1000, ',')) !== false) {
            $rows[] = $data;
        }
        fclose($handle);
    }
    return $rows;
}

public function upload(Request $request)
{
    $request->validate([
        'file' => 'required|mimes:csv,txt'
    ]);

    $path = $request->file('file')->storeAs('uploads', 'cancer_data.csv');

    // Run Python ML script
    $process = new Process(['python3', base_path('ml/cancer_analysis.py'), storage_path("app/$path")]);
    $process->run();

    if (!$process->isSuccessful()) {
        return back()->with('error', 'Python script failed.');
    }

    $output = json_decode($process->getOutput(), true);

    return view('dashboard', [
        'user' => auth()->user(),
        'ml_result' => $output,
        'data' => $output['raw_data'] // Optional to pass data to frontend charts
    ]);
}

}
