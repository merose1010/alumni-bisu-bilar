<section id="login">
<div class="container">
        <div class="header-section">
            <img src="/images/LOGO-black.png" alt="" srcset="" class="logo-for-signin">
            <h5>Dashboard Login</h5>
        </div>

        @if (Session::has('loginfail'))
         <h6 class="loginfail">{{ Session::get('loginfail') }}</h6>
        @endif

        @if (session('successregister'))
         <h6 class="successregister" id="myAlert" style="font-size: 12px;">{{ session('successregister') }}</h6>
        @endif

         <!-- <h6 class="status" id="myAlert" style="font-size: 12px;">sdfsdfsdfsdf</h6> -->

        <form action="{{ route('login') }}" method="post">
        @csrf
            <div class="form first">
                <div class="details personal">
                    <!-- <span class="title">Login detals</span> -->
                    <div class="fields">
                        <div class="group">
                            <div class="input-field">
                                <label>Username</label>
                                <input type="text" name="email" placeholder="Enter Username" value="{{old('email')}}">
                                <span class="error-text">@error('email') {{$message}} @enderror</span>
                            </div>
                        </div>

                        <div class="group">
                            <div class="input-field">
                                <label>Password</label>
                                <input type="password" name="password" placeholder="Enter Password" >
                                <span class="error-text">@error('password') {{$message}} @enderror</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="group-2">

                    <button type="submit" class="nextBtn">
                        <span class="btnText">Log in</span>
                    </button>
                    

                    <div class="links">

                        
                        <div class="remember_me">
                            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>

                        <p class="forgot"><a href="{{ route('password.request') }}">Forgot Password?</a></p>

                    </div>
                    
                </div> 
            </div>
        </form>
    </div>
</section>