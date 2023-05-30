<section id="signin">
<div class="container">
        <div class="header-section">
            <img src="/images/LOGO-black.png" alt="" srcset="" class="logo-for-signin">
            <h1>|</h1>
            <header>Sign In</header>
        </div>
        <form action="post_signin" method="post">
        @csrf
            <div class="form first">
                <div class="details personal">
                    <span class="title">Personal Details</span>
                    <div class="fields">
                        <form action="/post_signin" method="post">
                        @csrf
                            <div class="group">
                                <div class="input-field">
                                    <label>Last Name</label>
                                    <input type="text" name="last_name" placeholder="Enter your Lastname" value="{{old('last_name')}}">
                                    <span class="error-text">@error('last_name') {{$message}} @enderror</span>
                                </div>

                                <div class="input-field">
                                    <label>First Name</label>
                                    <input type="text" name="first_name" placeholder="Enter your Firstname" value="{{old('first_name')}}">
                                    <span class="error-text">@error('first_name') {{$message}} @enderror</span>
                                </div>

                                <div class="input-field">
                                    <label>Middle Name</label>
                                    <input type="text" name="middle_name" placeholder="Enter your Middlename" value="{{old('middle_name')}}">
                                    <span class="error-text">@error('middle_name') {{$message}} @enderror</span>
                                </div>
                            </div>

                            <div class="group">
                                <div class="input-field">
                                    <label>Course</label>
                                    <input type="text" name="course" placeholder="Enter Course" value="{{old('course')}}">
                                    <span class="error-text">@error('course') {{$message}} @enderror</span>
                                </div>

                                <div class="input-field">
                                    <label>Email</label>
                                    <input type="text" name="email" placeholder="Enter your email" value="{{old('email')}}">
                                    <span class="error-text">@error('email') {{$message}} @enderror</span>
                                </div>

                                <div class="input-field">
                                    <label>Password</label>
                                    <input type="password" name="password" placeholder="Enter Password" value="{{old('password')}}">
                                    <span class="error-text">@error('password') {{$message}} @enderror</span>
                                </div>
                            </div>


                            <div class="group">
                                <div class="input-field">
                                    <label>Gender</label>
                                    <select name="gender" value="{{old('gender')}}">
                                        <option disabled selected>Select gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Others">Others</option>
                                    </select>
                                    <span class="error-text">@error('gender') {{$message}} @enderror</span>
                                </div>

                                <div class="input-field" style="width: 100%;">
                                    <label>Address</label>
                                    <input type="text" name="address" placeholder="Enter your Address" value="{{old('address')}}">
                                    <span class="error-text">@error('address') {{$message}} @enderror</span>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="group-2">

                    <button type="submit" class="nextBtn">
                        <span class="btnText">SUBMIT</span>
                        <i class="uil uil-navigator"></i>
                    </button>
                    
                    <span class="already_member">Already a Member? <a href="/student_login">Login Here</a></span>

                </div> 
            </div>
        </form>
    </div>
</section>