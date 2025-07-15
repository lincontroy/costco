<x-guest-layout>
@section('title')
    {{'Register'}}
@endsection
    <div class="register-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="/" class="h1"><b>Costcoworkwave</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Register a new membership</p>


                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <div class="input-group mb-3">
                        <input id="name" class="form-control" type="text" name="name" :value="old('name')"
                            required autofocus autocomplete="name" placeholder="Full name">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                        <x-input-error :messages="$errors->get('name')" class="text-danger" />
                    </div>
                    <div class="input-group mb-3">
                        <input id="email" class="form-control" type="tel" name="phonenumber" :value="old('phonenumber')"
                            required autocomplete="phonenumber" placeholder="0908900765">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-mobile"></span>
                            </div>
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="text-danger" />
                    </div>
                    <div class="input-group mb-3">
                        <input id="password" class="form-control" type="password" name="password" required
                            autocomplete="new-password" placeholder="Enter password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="text-danger" />
                    </div>
                    <div class="input-group mb-3">
                        <input id="password_confirmation" class="form-control" type="password"
                            name="password_confirmation" required autocomplete="new-password" placeholder="Re enter password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        <x-input-error :messages="$errors->get('password_confirmation')" class="text-danger" />
                    </div>
                    <div class="row justify-content-center">
    <div class="col-6 col-md-4">
        <button type="submit" class="btn btn-primary w-100">Register</button>
    </div>
</div>
</form>

<div class="text-center mt-3">
    <p class="mb-0">
        Already have an account?
        <a href="{{ route('login') }}" class="text-primary fw-bold">Login</a>
    </p>
</div>

            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
    </div>
</x-guest-layout>
