<x-guest-layout>
    @section('title')
        {{ 'Log in' }}
    @endsection
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="/" class="h1"><b>Costco work wave</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Sign in to start your session</p>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('login') }}" method="POST">
    @csrf

    {{-- Phone Number --}}
    <div class="input-group mb-3">
        <label for="phonenumber" class="sr-only">Phone Number</label>
        <input
            id="phonenumber"
            class="form-control"
            type="tel"
            name="phonenumber"
            value="{{ old('phonenumber') }}"
            required
            autofocus
            autocomplete="tel"
            placeholder="Phone Number"
        >
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-phone"></span>
            </div>
        </div>
    </div>
    <x-input-error :messages="$errors->get('phonenumber')" class="mt-2" />

    {{-- Password --}}
    <div class="input-group mb-3">
        <label for="password" class="sr-only">Password</label>
        <input
            id="password"
            class="form-control"
            type="password"
            name="password"
            required
            autocomplete="current-password"
            placeholder="Password"
        >
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-lock"></span>
            </div>
        </div>
    </div>
    <x-input-error :messages="$errors->get('password')" class="mt-2" />

    <div class="row">
        <div class="col-8">
            <div class="icheck-primary">
                <input type="checkbox" name="remember" id="remember">
                <label for="remember">
                    Remember Me
                </label>
            </div>
        </div>

        <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">
                Sign In
            </button>
        </div>
    </div>
</form>

               
                <p class="mb-0">
                    <a href="{{ route('register') }}" class="text-center">Register a new Account</a>
                </p>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</x-guest-layout>
