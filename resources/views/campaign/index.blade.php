@extends('layouts.app')
@section('content')
<div class="max-w-5xl mx-auto p-6">
  <h1 class="text-2xl font-semibold mb-4">Email Campaigns</h1>
  <table class="w-full text-left border">
    <thead>
      <tr class="bg-gray-50">
        <th class="p-2 border">ID</th>
        <th class="p-2 border">Name</th>
        <th class="p-2 border">Subject</th>
        <th class="p-2 border">Targets</th>
        <th class="p-2 border">Sent</th>
        <th class="p-2 border">Failed</th>
        <th class="p-2 border">Status</th>
        <th class="p-2 border">Created</th>
      </tr>
    </thead>
    <tbody>
      @foreach($campaigns as $c)
      <tr>
        <td class="p-2 border">{{ $c->id }}</td>
        <td class="p-2 border">{{ $c->name }}</td>
        <td class="p-2 border">{{ $c->subject }}</td>
        <td class="p-2 border">{{ $c->total_targets }}</td>
        <td class="p-2 border">{{ $c->sent }}</td>
        <td class="p-2 border">{{ $c->failed }}</td>
        <td class="p-2 border">{{ $c->status }}</td>
        <td class="p-2 border">{{ $c->created_at->format('Y-m-d H:i') }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
  <div class="mt-4">{{ $campaigns->links() }}</div>
</div>
@endsection
