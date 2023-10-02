@extends('layouts.admin')
@section('title','login pannel')
@section('admin_content')

<div class="container">
    <div class="screen">
      <div class="screen__content">
        <form class="login"  method="POST" action="{{ route('login') }}">
            @csrf
            <strong> Admin Login Panel</strong>
          <div class="login__field">
            <i class="login__icon fas fa-user"></i>
            <input type="email" class="login__input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="User name / Email">

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
          <div class="login__field">
            <i class="login__icon fas fa-lock"></i>
            <input type="password" class="login__input @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">

            <input title="Remamber me" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
            @if (session('error'))
                <strong class="text-danger">{{ session('error') }}</strong>
            @endif
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>

          <button class="button login__submit">
            <span class="button__text">Log In Now</span>
            <i class="button__icon fas fa-chevron-right"></i>
          </button>
        </form>
        <div class="social-login">
          <h3>log in via</h3>
          <div class="social-icons">
            <a href="#" class="social-login__icon fab fa-instagram"></a>
            <a href="#" class="social-login__icon fab fa-facebook"></a>
            <a href="#" class="social-login__icon fab fa-twitter"></a>
          </div>
        </div>
      </div>
      <div class="screen__background">
        <span class="screen__background__shape screen__background__shape4"></span>
        <span class="screen__background__shape screen__background__shape3"></span>
        <span class="screen__background__shape screen__background__shape2"></span>
        <span class="screen__background__shape screen__background__shape1"></span>
      </div>
    </div>
  </div>

@endsection
