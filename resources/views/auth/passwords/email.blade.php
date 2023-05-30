@extends('layouts.app')

@section('content')
<section id="forgot">
<div class="container">
        <div class="header-section">
            <img src="/images/LOGO-black.png" alt="" srcset="" class="logo-for-signin">
            <h5>Forgot Password</h5>
        </div>

        @if (session('status'))
         <h6 class="successregister" id="myAlert" style="font-size: 12px;">{{ session('status') }}</h6>
        @endif

         <!-- <h6 class="status" id="myAlert" style="font-size: 12px;">sdfsdfsdfsdf</h6> -->

        <form action="{{ route('password.email') }}" method="post">
        @csrf
            <div class="form first">
                <div class="details personal">
                        <div class="group">
                            <div class="input-field">
                                <label>Email Address</label>
                                <input type="text" name="email" placeholder="Enter Username" value="{{old('email')}}">
                                <span class="error-text">@error('email') {{$message}} @enderror</span>
                            </div>
                        </div>
                </div>

                <div class="group-2">

                    <button type="submit" class="nextBtn">
                        <span class="btnText">Send Password Reset Link</span>
                    </button>

                </div> 
            </div>
        </form>
    </div>
</section>
@endsection
