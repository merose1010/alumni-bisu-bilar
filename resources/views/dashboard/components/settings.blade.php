@if (session('accountstatus'))
  <h6 class="alert alert-success my-0" id="myAlert" style="font-size: 14px;">{{ session('accountstatus') }}</h6>
@endif

@if (session('successpassword'))
  <h6 class="alert alert-success my-0" id="myAlert" style="font-size: 14px;">{{ session('successpassword') }}</h6>
@endif

@if (session('failpassword'))
  <h6 class="alert alert-danger my-0" id="myAlert" style="font-size: 14px;">{{ session('failpassword') }}</h6>
@endif

<section id="settings" class="px-3 py-4">
    <h5 class="pb-2">Settings</h5>

    <div class="settings-row-1">
    <div class="settings-wrapper-1 bg-white px-3 py-4">
        <h6>Edit profile Information</h6>
        <hr>

        <form action="/change-admin-info" method="post">
        @csrf
        @method('put')
            <div class="settings-col-1 bg-white">

                <div class="group">
                    <div class="mb-2" style="width: 100%;">
                        <label for="exampleFormControlInput1" class="form-label">First Name</label>
                        <input type="text" name="first_name" class="form-control bg-white" id="exampleFormControlInput1" placeholder="First Name" value="{{ Auth::user()->first_name }}">
                    </div>

                    <div class="mb-2" style="width: 100%;">
                        <label for="exampleFormControlInput1" class="form-label">Middle Name</label>
                        <input type="text" name="middle_name" class="form-control bg-white" id="exampleFormControlInput1" placeholder="Middle Name" value="{{ Auth::user()->middle_name }}">
                    </div>
                </div>

                <div class="group">
                    <div class="mb-2" style="width: 100%;">
                        <label for="exampleFormControlInput1" class="form-label">Last Name</label>
                        <input type="text" name="last_name" class="form-control bg-white" id="exampleFormControlInput1" placeholder="Last Name" value="{{ Auth::user()->last_name }}">
                    </div>
                    
                    <div class="mb-2" style="width: 100%;">
                        <label for="exampleFormControlInput1" class="form-label">Username</label>
                        <input type="email" name="email" class="form-control bg-white" id="exampleFormControlInput1" placeholder="Edit Username" value="{{ Auth::user()->email }}">
                    </div>
                </div>

                <div class="group">
                    <div class="mb-2" style="width: 100%;">
                        <label for="exampleFormControlInput1" class="form-label">Gender</label>
                        <input type="text" name="gender" class="form-control bg-white" id="exampleFormControlInput1" placeholder="Edit Gender" value="{{ Auth::user()->gender }}">
                    </div>

                    <div class="mb-2" style="width: 100%;">
                        <label for="exampleFormControlInput1" class="form-label">Address</label>
                        <input type="text"  name="address" class="form-control bg-white" id="exampleFormControlInput1" placeholder="Edit Address" value="{{ Auth::user()->address }}">
                    </div>
                </div>

            </div>

        <div class="mt-2 password-button text-right">
            <button type="submit" class="btn btn-success" id="default-btn">Update Information</button>
        </div>

        </form>

    </div>

    <div class="settings-wrapper-2 bg-white px-3 py-5">
        <div class="settings-col-2">
            <form enctype="multipart/form-data" action="/change-admin-pp" method="post">
            @csrf
            @method('put')
            <div class="addphoto">

                @if(Auth::user()->profile_picture)
                    <img src="{{ asset('images/user_profile/' . Auth::user()->profile_picture) }}"  id="change-img-add" style="object-fit: cover;">
                @else
                    <img src="images/LOGO.png" id="change-img-add" style="object-fit: cover;">
                @endif
            </div>

            <div class="db-user">
                <span><strong>{{ Auth::user()->first_name }} {{ Auth::user()->middle_name }} {{ Auth::user()->last_name }}</strong></span>
                <span class="text-muted">{{ Auth::user()->roles->pluck('name')->implode(', ') }}</span>
            </div>

            <div class="img-button mt-3">
                <input type="file" name="profile_picture" id="addphotoBtn" accept="image/jpg, image/jpeg, image/png" hidden>
                <button onclick ="addPhoto()" type="button" class="addphoto-btn btn btn-primary" id="addphotoBtn">Choose Image</button>
                <button type="submit"  class="addphoto-btn btn btn-success">Save</button>
            </div>
            </form>
        </div>
    </div>
    </div>


    <div class="settings-wrapper bg-white px-3 py-4 mt-4">
        <h6 class="mt-3">Edit Password</h6>
        <hr>

        <form action="/change-admin-password" method="post" class="py-2">
        @csrf
        @method('put')
        <div class="mb-3 old_password">
            <div class="input-group">
                <input type="password" class="form-control border-right-0" placeholder="Old Password" id="oldPassword" name="old_password">
                <span class="input-group-text"><i class="far fa-eye" id="togglePassword1" style="cursor: pointer;"></i></span>
            </div>
            @if($errors->any('old_password'))
                <p class="my-0 text-danger" style="font-size: 12px;">{{$errors->first('old_password')}}</p>
            @endif
        </div>

        <div class="mb-3 new_password">
            <div class="input-group">
                <input type="password" class="form-control border-right-0" placeholder="New Password" id="newPassword" name="new_password">
                <span class="input-group-text"><i class="far fa-eye" id="togglePassword2" style="cursor: pointer;"></i></span>
            </div>
            @if($errors->any('new_password'))
                <p class="my-0 text-danger" style="font-size: 12px;">{{$errors->first('new_password')}}</p>
            @endif
        </div>

        <div class="mb-3 confirm_password">
            <div class="input-group">
                <input type="password" class="form-control border-right-0" placeholder="Confirm Password" id="confirmPassword" name="confirm_password">
                <span class="input-group-text"><i class="far fa-eye" id="togglePassword3" style="cursor: pointer;"></i></span>
            </div>
            @if($errors->any('confirm_password'))
                <p class="my-0 text-danger" style="font-size: 12px;">{{$errors->first('confirm_password')}}</p>
            @endif
        </div>


        <div class="mb-2 password-button justify-content-right">
        <button type="submit" class="btn btn-success" id="default-btn">Update Password</button>
        </div>

        </form>
    </div>



</section>