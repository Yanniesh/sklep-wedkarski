@extends('layouts.app')

@section('content')
<div class="container">
     <form class="FormCenter" method="POST" action="{{ route('login') }}">
         <div class="card-header">{{ __('Login') }}</div>
         @csrf
         <div class="labelXinput">
             <label for="email" class="pad-TB-5">{{ __('Email Address') }}</label>
             <div class="labelXinput">
                 <input id="email" type="email" class="form-control pad-TB-5 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

             </div>
         </div>

         <div class="labelXinput">
             <label for="password" class="pad-TB-5">{{ __('Password') }}</label>

             <div class="labelXinput">
                 <input id="password" type="password" class="form-control pad-TB-5 @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

             </div>
         </div>

         <div class="rememberCheckBox">
                 <div class="form-check">
                     <input class="larger" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                     <label for="remember">{{ __('Remember Me') }}</label>
                 </div>
         </div>

             <div class="loginBtn">
                 <button type="submit" class="loginButton">
                     {{ __('Login') }}
                 </button>

                 @if (Route::has('password.request'))
                     <a class="passRequestText" href="{{ route('password.request') }}">
                         {{ __('Forgot Your Password?') }}
                     </a>
                 @endif

             </div>
         <div>
             @error('email')
             <span class="invalid-feedback" role="alert">
                         <strong>{{ $message }}</strong>
                     </span>
             @enderror
             @error('password')
             <span class="invalid-feedback" role="alert">
                         <strong>{{ $message }}</strong>
                     </span>
             @enderror
         </div>
     </form>
    </div>
@endsection
