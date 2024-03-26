@extends('layouts.auth')
@section('page', 'Login Authentication')
@section('content')

    <div class="page page-center">
        <div class="container container-tight py-4">
            <div class="text-center mb-4">
                <a href="." class="navbar-brand navbar-brand-autodark"><img src="{{ asset('admin/static/logo.png') }}"
                        height="96" alt=""></a>
            </div>
            <div class="card card-md">
                <div class="card-body">
                    <h2 class="h2 text-center mb-4">Login to your account</h2>
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Email address</label>
                            <input type="email" id="email" name="email" class="form-control"
                                placeholder="your@email.com" autocomplete="off" required>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <label class="form-label">
                                Password
                                <span class="form-label-description">
                                    <a href="#">I forgot password</a>
                                </span>
                            </label>
                            <div class="input-group input-group-flat">
                                <input name="password" type="password" id="password" class="form-control"
                                    placeholder="Your password" autocomplete="off" required>

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-2">
                            <label class="form-check">
                                <input type="checkbox" name="remember" class="form-check-input" />
                                <span class="form-check-label">Remember me on this device</span>
                            </label>
                        </div>
                        <div class="form-footer">
                            <button type="submit" class="btn btn-primary w-100">Sign in</button>
                        </div>
                    </form>
                </div>
                <div class="hr-text">or</div>
            </div>
            <div class="text-center text-muted mt-3">
                Don't have account yet? <a href="{{ route('register') }}" tabindex="-1">Sign up</a>
            </div>
        </div>
    </div>
@endsection

@push('after-scripts')
    {{-- Jquery cdn --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $("#email").keyup(function() {
            var email = $("#email").val();

            if (email.length >= 5) {
                $.ajax({
                    type: "GET",
                    data: {
                        email: email
                    },
                    dataType: "JSON",
                    url: "{{ url('/login/cek_email/json') }}",
                    success: function(data) {
                        if (data.success) {
                            $("#email").removeClass("is-invalid");
                            $("#email").addClass("is-valid");
                            $("#password").val('');
                            $("#password").removeAttr("disabled", "disabled");
                        } else {
                            $("#email").removeClass("is-valid");
                            $("#email").addClass("is-invalid");
                            $("#password").val('');
                            $("#password").attr("disabled", "disabled");
                            $("#remember").attr("disabled", "disabled");
                            $("#btn-login").attr("disabled", "disabled");
                        }
                    },
                    error: function() {}
                });
            } else {
                $("#email").removeClass("is-valid");
                $("#email").removeClass("is-invalid");
                $("#password").val('');
                $("#password").attr("disabled", "disabled");
                $("#remember").attr("disabled", "disabled");
                $("#btn-login").attr("disabled", "disabled");
            }
        });

        $("#password").keyup(function() {
            var email = $("#email").val();
            var password = $("#password").val();

            if (password.length >= 8) {
                $.ajax({
                    type: "GET",
                    data: {
                        email: email,
                        password: password
                    },
                    dataType: "JSON",
                    url: "{{ url('/login/cek_password/json') }}",
                    success: function(data) {
                        if (data.success) {
                            $("#password").removeClass("is-invalid");
                            $("#password").addClass("is-valid");
                            $("#remember").removeAttr("disabled", "disabled");
                            $("#btn-login").removeAttr("disabled", "disabled");
                        } else {
                            $("#password").removeClass("is-valid");
                            $("#password").addClass("is-invalid");
                            $("#remember").attr("disabled", "disabled");
                            $("#btn-login").attr("disabled", "disabled");
                        }
                    },
                    error: function() {}
                });
            } else {
                $("#password").removeClass("is-valid");
                $("#password").removeClass("is-invalid");
                $("#remember").attr("disabled", "disabled");
                $("#btn-login").attr("disabled", "disabled");
            }
        });
    </script>
@endpush
