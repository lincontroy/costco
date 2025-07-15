<nav class="main-header navbar navbar-expand navbar-{{ Auth::user()->mode }} navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto align-items-center">

    {{-- User level pill --}}
    <li class="nav-item me-4">
        <span class="badge rounded-pill bg-info text-dark px-4 py-2 fs-5">
            Level: {{ auth()->user()->level ?? 0 }}
        </span>
    </li>

    <br><br>

    {{-- Logout button --}}
    <li class="nav-item">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <input type="submit" name="submit" value="Log out" class="btn btn-primary btn-sm">
        </form>
    </li>

</ul>


</nav>
