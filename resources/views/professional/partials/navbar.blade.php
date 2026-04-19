<nav class="navbar navbar-expand-lg navbar-dark bg-success navbar-fixed">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="#">
            🧠 Mental Health Professional
        </a>

        <div class="d-flex align-items-center">
            <span class="text-white me-3">
                {{ auth()->user()->name }}
            </span>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-outline-light btn-sm">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </div>
    </div>
</nav>
