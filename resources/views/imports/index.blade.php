@extends('layouts.app')
@section('content')
    <div class="max-w-3xl mx-auto p-6">
        <h1 class="text-2xl font-semibold mb-4">Import Leads (CSV)</h1>


        @if (session('status'))
            <div class="bg-green-100 border border-green-300 text-green-800 p-3 rounded mb-4">{{ session('status') }}</div>
        @endif


        <form action="{{ route('imports.store') }}" method="POST" enctype="multipart/form-data"
            class="space-y-4 border p-4 rounded">
            
            @csrf
            <div>
                <label class="block font-medium">CSV File</label>
                <input type="file" name="file" accept=".csv,.xlsx" required class="mt-1">

                @error('file')
                    <p class="text-red-600 text-sm">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex gap-6">
                <label class="inline-flex items-center gap-2">
                    <input type="checkbox" name="has_header" value="1" checked>
                    <span>First row has headers</span>
                </label>
                <div>
                    <label class="block font-medium">Delimiter</label>
                    <input type="text" name="delimiter" value="," class="border px-2 py-1 w-20">
                </div>
            </div>
            <button class="bg-blue-600 text-white px-4 py-2 rounded">Upload & Start Import</button>
        </form>


        <h2 class="text-xl font-semibold mt-10 mb-3">Recent Imports</h2>
        <div class="overflow-x-auto">
            <table class="w-full text-left border">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="p-2 border">ID</th>
                        <th class="p-2 border">File</th>
                        <th class="p-2 border">Status</th>
                        <th class="p-2 border">Progress</th>
                        <th class="p-2 border">Created</th>
                        <th class="p-2 border">View</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($imports as $imp)
                        <tr>
                            <td class="p-2 border">{{ $imp->id }}</td>
                            <td class="p-2 border">{{ $imp->original_name }}</td>
                            <td class="p-2 border">{{ $imp->status }}</td>
                            <td class="p-2 border">{{ $imp->processed_rows }} @if ($imp->total_rows)
                                    / {{ $imp->total_rows }}
                                @endif
                            </td>
                            <td class="p-2 border">{{ $imp->created_at->format('Y-m-d H:i') }}</td>
                            <td class="p-2 border"><a href="{{ route('imports.show', $imp) }}"
                                    class="text-blue-600 underline">Open</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


        <div class="mt-4">{{ $imports->links() }}</div>
    </div>
@endsection
