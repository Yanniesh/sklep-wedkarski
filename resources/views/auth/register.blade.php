@extends('layouts.app')

@section('content')
<div class="container">
            <form class="FormCenter" method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="card-header">{{ __('Register') }}</div>
                        <div class="labelXinput">
                            <label for="name" class="pad-TB-5">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control pad-TB-5
                                @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"
                                       required autocomplete="name" autofocus>

                            </div>
                        </div>

                        <div class="labelXinput">
                            <label for="email" class="pad-TB-5">{{ __('Email Address') }}</label>

                            <div >
                                <input id="email" type="email" class="form-control pad-TB-5 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                            </div>
                        </div>

                        <div class="labelXinput">
                            <label for="nickname" class="pad-TB-5">{{ __('Nickname') }}</label>

                            <div>
                                <input id="nickname" type="text" class="form-control pad-TB-5 @error('nickname')is-invalid @enderror" name="nickname" value="{{ old('nickname') }}" required autocomplete="nickname" autofocus>


                            </div>
                        </div>

                        <div class="labelXinput">
                            <label for="password" class="pad-TB-5">{{ __('Password') }}</label>

                            <div class="form-control pad-TB-5">
                                <input id="password" type="password" class="form-control pad-TB-5 @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">


                            </div>
                        </div>

                        <div class="labelXinput">
                            <label for="password-confirm" class="pad-TB-5">{{ __('Confirm Password') }}</label>

                            <div class="">
                                <input id="password-confirm" type="password" class="form-control pad-TB-5" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="loginBtn">
                                <button type="submit" class="loginButton">
                                    {{ __('Register') }}
                                </button>
                        </div>
                        <div>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                            @error('nickname')
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
