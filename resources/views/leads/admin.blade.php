
@extends('layouts.app')
@section('content')
<div class="max-w-6xl mx-auto p-6">
  <h1 class="text-2xl font-semibold mb-4">Leads (fast viewer)</h1>

  <form method="get" action="{{ route('leads.admin') }}" class="mb-4 flex gap-2">
    <input name="s" value="{{ $s }}" class="border px-3 py-2 w-80" placeholder="Search email or name">
    <button class="bg-blue-600 text-white px-4 py-2 rounded">Search</button>
  </form>

  <div class="overflow-x-auto">
    <table class="w-full text-left border">
      <thead>
        <tr class="bg-gray-50">
          <th class="p-2 border">ID</th>
          <th class="p-2 border">First</th>
          <th class="p-2 border">Last</th>
          <th class="p-2 border">Email 1</th>
          <th class="p-2 border">Business Email</th>
        </tr>
      </thead>
      <tbody>
        @foreach($leads as $l)
        <tr>
          <td class="p-2 border">{{ $l->id }}</td>
          <td class="p-2 border">{{ $l->first_name }}</td>
          <td class="p-2 border">{{ $l->last_name }}</td>
          <td class="p-2 border">{{ $l->email1 }}</td>
          <td class="p-2 border">{{ $l->business_email }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <div class="mt-4">{{ $leads->withQueryString()->links() }}</div>
</div>
@endsection
