<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    {{-- NAVBAR --}}
    @include('layouts.partials.navbar')

    <div class="d-flex">

        {{-- SIDEBAR --}}
        @include('layouts.partials.sidebar')

        {{-- MAIN CONTENT --}}
        <main class="main-content w-100 p-3">
            @yield('content')
        </main>

    </div>

</body>
</html>