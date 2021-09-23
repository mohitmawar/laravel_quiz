@extends('layouts.admin')

@section('content')
    <div class="login-box w-50 mx-auto">
        <div class="login-logo text-center">
            <a href="#"><b>Admin</b>Login</a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">Sign in to start</p>

            {!! Form::open(['route' => 'adminLogin']) !!}
            <div class="form-group has-feedback mb-2">
                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                    value="{{ old('email') }}" placeholder="Email" autofocus="autofocus">
                <span class="fa fa-envelope form-control-feedback"></span>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                    placeholder="Password">
                <span class="fa fa-lock form-control-feedback"></span>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label>
                            <input type="checkbox" name='remember'> Remember Me
                        </label>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                </div>
                <!-- /.col -->
            </div>
            </form>
        </div>
        <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->

@endsection
