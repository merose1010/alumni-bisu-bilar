@extends('layouts.app')

@section('content')
<section id="reset">
<div class="container">
        <div class="header-section">
            <img src="/images/LOGO-black.png" alt="" srcset="" class="logo-for-signin">
            <h5>Reset Password</h5>
        </div>

        @if (session('status'))
         <h6 class="successregister" id="myAlert" style="font-size: 12px;">{{ session('status') }}</h6>
        @endif

        <form action="{{ route('password.update') }}" method="post">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

            <div class="form first">
                <div class="details personal">
                    <div class="fields">
                        <div class="group">
                            <div class="input-field">
                                <label>Email Address</label>
                                <input type="text" name="email" placeholder="Enter Email" value="{{old('email')}}">
                                <span class="error-text">@error('email') {{$message}} @enderror</span>
                            </div>
                        </div>

                        
                        <div class="group">
                            <div class="input-field">
                                <label>New Password</label>
                                <input type="password" name="password" placeholder="Enter Password" required autocomplete="new-password">
                                <span class="error-text">@error('password') {{$message}} @enderror</span>
                            </div>
                        </div>

                        <div class="group">
                            <div class="input-field">
                                <label>Confirm Password</label>
                                <input id="password-confirm" type="password" name="password_confirmation" placeholder="Enter Password" required autocomplete="new-password">
                                <span class="error-text">@error('password') {{$message}} @enderror</span>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="group-2">

                    <button type="submit" class="nextBtn">
                        <span class="btnText">Reset Password</span>
                    </button>

                </div> 
            </div>
        </form>
    </div>
</section>
@endsection
