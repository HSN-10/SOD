@extends('layouts.app')
@section('title', __('auth.login'))

@section('content')
    <form class="form-signin" method="POST" action="{{ route('login') }}">
        {!! csrf_field() !!}
        <div class="text-center mb-4">
          <img class="mb-4" src="css/logo.svg" width="150" height="150">
           <h1 class="h3 mb-3 font-weight-normal">{{ config('app.name') }}</h1>
        </div>

        <div class="form-label-group">
          <input type="text" id="inputUsername" class="form-control @error('username') is-invalid @enderror" placeholder="@lang('auth.username')" name="username" value="{{ old('username') }}" required autofocus>
          <label for="inputUsername">@lang('auth.username')</label>
          @error('username')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
        </div>

        <div class="form-label-group">
          <input type="password" id="inputPassword" class="form-control @error('password') is-invalid @enderror" placeholder="@lang('auth.password')" name="password" required>
          <label for="inputPassword">@lang('auth.password')</label>
          @error('password')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
        </div>

        <div style="position:relative; height:50px;">
            <div class="custom-control custom-checkbox" style="position:absolute; left:0; top:+13%;">
                <input type="checkbox" id="remember" class="custom-control-input" name="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="custom-control-label" for="remember">@lang('auth.rememberMe')</label>
            </div>

            <div style="position:absolute; right:-3%;">
                @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">@lang('auth.ForgotPassword')</a>
                @endif
            </div>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">@lang('auth.login') <i class="fa fa-btn fa-sign-in"></i></button>

        <p class="mt-5 mb-3 text-muted text-center">@lang('auth.copyright')</p>
      </form>
@endsection
