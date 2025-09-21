<?php

namespace App\Http\Controllers;


use App\Jobs\ImportLeadsJob;
use App\Models\LeadImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class LeadImportController extends Controller
{
    public function index()
    {
        $imports = LeadImport::latest()->paginate(10);
        return view('imports.index', compact('imports'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'file' => ['required', 'file', 'mimetypes:text/plain,text/csv,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'],
            'has_header' => ['nullable', 'boolean'],
            'delimiter' => ['nullable', 'string'],
        ]);

        $file = $validated['file'];
        $hasHeader = (bool)($validated['has_header'] ?? true);
        $delimiter = $validated['delimiter'] ?? ',';
        $ext = strtolower($file->getClientOriginalExtension()); // 'csv' or 'xlsx'

        $path = $file->store('imports');

        $import = LeadImport::create([
            'original_name' => $file->getClientOriginalName(),
            'stored_path'   => $path,
            'status'        => 'pending',
        ]);

        ImportLeadsJob::dispatch($import->id, $hasHeader, $delimiter, $ext)->onQueue('default');

        return redirect()->route('imports.show', $import)->with('status', 'File uploaded. Import started.');
    }


    public function show(LeadImport $import)
    {
        return view('imports.show', compact('import'));
    }


    public function progress(LeadImport $import)
    {
        return response()->json([
            'status' => $import->status,
            'processed_rows' => $import->processed_rows,
            'total_rows' => $import->total_rows,
            'error' => $import->error,
            'percent' => $import->total_rows ? round(($import->processed_rows / max(1, $import->total_rows)) * 100, 2) : null,
        ]);
    }
}
