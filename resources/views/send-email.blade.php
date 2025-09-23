<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Send Test Email</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body class="p-5">
    <div class="container">
        <h2>Send Test Email</h2>

        @if(session('success'))
            <div class="alert alert-success mt-3">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger mt-3">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('send.test.email') }}">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Recipient Email</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Enter recipient email" required>
            </div>
            <button type="submit" class="btn btn-primary">Send Test Email</button>
        </form>
    </div>
</body>
</html>
