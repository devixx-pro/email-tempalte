{{-- resources/views/imports/show.blade.php --}}
<form method="post" action="{{ route('imports.sendByTime', $import) }}" class="mt-8 space-y-3">
  @csrf
  <div>
    <label class="block font-medium">Subject</label>
    <input name="subject" class="border px-3 py-2 w-full" required value="Hello from Your Brand">
  </div>
  <div>
    <label class="block font-medium">Body</label>
    <textarea name="body" class="border px-3 py-2 w-full" rows="6" required>Your message goes here…</textarea>
  </div>
  <div>
    <label class="block font-medium">Limit (optional)</label>
    <input name="limit" type="number" class="border px-3 py-2 w-40" placeholder="e.g. 50000">
  </div>
  <button class="bg-blue-600 text-white px-4 py-2 rounded">Queue Send for This Import</button>
</form>
