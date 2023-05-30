@role(['Super-Admin', 'Admin'])
<section class="all-vehicles-section">

@if (session('status'))
  <h6 class="alert alert-success my-0" id="myAlert" style="font-size: 14px;">{{ session('status') }}</h6>
@endif


    <div class="pb-3 d-flex justify-content-between px-3 pt-4">
    <h5 class="title">Dashboard Users</h5>
    <a href="#" title="Add Dashboard Users"><button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addModal"><i class="fa fa-plus" aria-hidden="true"></i> Add Users</button></a>
    </div>

<div class="table-responsive px-3 pb-3">

<table class="table align-middle mb-0 bg-light table-hover display responsive nowrap" id="dbTable" style="width: 100%;">
<thead class="table bg-primary text-white">
<tr>
  <th scope="col" class="col-3">Name</th>
  <th scope="col">Example TR</th>
  <th scope="col">Example TR</th>
  <th scope="col">Actions</th>
</tr>
</thead>
<tbody>
@foreach($user_roles as $roles)
 <tr>
  <td>
    <div class ="d-flex align-items-center">
    @if($roles->profile_picture)
        <img src="{{ asset('images/user_profile/' . $roles->profile_picture) }}" style="height: 45px; width: 45px; object-fit: cover;" class="rounded-circle">
    @else
        <img src="images/LOGO.png" style="height: 45px; width: 45px; object-fit: cover;" class="rounded-circle">
    @endif
    <div class="ms-3">
        <p class="fw-bold mb-1">{{ $roles->first_name }} {{ $roles->last_name }} </p>
        <p class="text-muted mb-0">{{ $roles->email }}</p>

    </div>
    </div>

  </td>
  <td>
  @foreach ($roles->roles as $role)
        {{ $role->name }}
        @if (!$loop->last), @endif
      @endforeach

  </td>
  
  <td>{{ \Carbon\Carbon::parse($roles->created_at)->format('F d, Y')}}</td>
  <td>
  <a href="#" title="View" class="actions action-view"  data-id="{{ $roles->id }}" data-bs-toggle="modal" data-bs-target="#viewModal"><i class="fa fa-eye" aria-hidden="true"></i></a>
  <a href="#" title="Edit" class="actions action-edit"  data-id="{{ $roles->id }}" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fa fa-pencil" aria-hidden="true"></i></a>
  <a href="/delete_user/{{ $roles->id }}" title="Delete" onclick="return confirm(&quot;Confirm delete?&quot;)" class="actions action-delete"><i class="fa fa-trash" aria-hidden="true"></i></a>

  </td>
  </tr>


@endforeach
</tbody>
</table>





</div>




</section>


<!-- ADD NEW DASHBOARD USERS -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">

    <form action="/create-user-role" method="post" id="new_user_form">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">New Dashboard Users</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body roles-modal">
          @csrf

            <div class="group">
              <div class="mb-2 input-field">
                <label for="recipient-name" class="">First name:</label>
                <input type="text" name="first_name" class="" id="fname">
                <span class="text-danger" id="error_fname" ></span>
              </div>

              
              <div class="mb-2 input-field">
                <label for="recipient-name" class="">Middle name:</label>
                <input type="text" name="middle_name" id="mname" class="">
                <span class="text-danger" id="error_mname"></span>
              </div>

              <div class="mb-2 input-field">
                <label for="recipient-name" class="">Last name:</label>
                <input type="text" name="last_name" class="" id="lname" >
                <span class="text-danger" id="error_lname" ></span>
              </div>

              <div class="mb-2 input-field">
                <label for="recipient-name" class="">Username or Email:</label>
                <input type="text" name="email" class="" id="email" >
                <span class="text-danger" id="error_email" ></span>
              </div>

              <div class="mb-2 input-field">
                <label for="message-text" class="">Password:</label>
                <input type="password"  name="password" class="" id="password">
                <span class="text-danger" id="error_password" ></span>
              </div>
            </div>

            <div class="group">
              <div class="mb-2 input-field">
                <label for="recipient-name" class="">Gender:</label>
                <select name="gender" id="gender" value="{{old('gender')}}">
                  <option disabled selected>Select gender</option>
                  <option value="Male">Male</option>
                  <option value="Female">Female</option>
                  <option value="Others">Others</option>
                </select>
                <span class="text-danger" id="error_gender" ></span>
              </div>

              <div class="mb-2 input-field">
                <label for="recipient-name" class="">Address:</label>
                <input type="text" name="address" class="" id="address">
                <span class="text-danger" id="error_address" ></span>
              </div>
              

              <div class="mb-2 input-field">
              <label>Roles</label>
                <select class="role" name="role" id=role>
                  <option disabled selected>Select Role</option>
                  <option value="2">Admin</option>
                  <option value="3">ID Staff</option>
                  <option value="4">Secretary</option>
                </select>
                <span class="text-danger" id="error_role" ></span>
              </div>
              
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" id="create_user_button" class="btn btn-primary">Create</button>
        </div>
      </form>
    </div>
  </div>
</div>


<!-- EDIT DASHBOARD USERS -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">

    <form action="/update_user" method="post" id="edit_user_form">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Dashboard Users</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body roles-modal">
        @csrf
        @method('put')

          <div class="mb-3" style="display: none;">
              <label for="recipient-name" class="col-form-label">ID:</label>
              <input type="text" id="user_id" class="form-control" name="user_id">
            </div>

            <div class="group">
              <div class="mb-2 input-field">
                <label for="recipient-name" class="">First name:</label>
                <input type="text" name="first_name" class="" id="edit_fname">
                <span class="text-danger" id="edit_error_fname"></span>
              </div>

              <div class="mb-2 input-field">
                <label for="recipient-name" class="">Middle name:</label>
                <input type="text" name="middle_name" class="" id="edit_mname">
                <span class="text-danger" id="edit_error_mname"></span>
              </div>

              <div class="mb-2 input-field">
                <label for="recipient-name" class="">Last name:</label>
                <input type="text" name="last_name" class="" id="edit_lname">
                <span class="text-danger" id="edit_error_lname"></span>
              </div>

              <div class="mb-2 input-field">
                <label for="recipient-name" class="">Username or Email:</label>
                <input type="text" name="email" class=""  name="email" id="edit_email">
                <span class="text-danger" id="edit_error_email"></span>
              </div>

            </div>

            <div class="group">
              <div class="mb-2 input-field">
                <label for="recipient-name" class="">Gender:</label>
                <select name="gender" value="{{old('gender')}}" id="edit_gender">
                  <option disabled selected>Select gender</option>
                  <option value="Male">Male</option>
                  <option value="Female">Female</option>
                  <option value="Others">Others</option>
                </select>
                <span class="text-danger" id="edit_error_gender"></span>
              </div>

              <div class="mb-2 input-field">
                <label for="recipient-name" class="">Address:</label>
                <input type="text" name="address" class="" name="subject" id="edit_address">
                <span class="text-danger" id="edit_error_address"></span>
              </div>
              

              <div class="mb-2 input-field">
              <label>Roles</label>
                <select class="role" name="role" id="edit_role"> 
                  <option value="2">Admin</option>
                  <option value="3">ID Staff</option>
                  <option value="4">Secreatary</option>
                </select>
                <span class="text-danger" id="edit_error_role"></span>
              </div>
              
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" id="update_user_button">Update</button>
        </div>
      </form>
    </div>
  </div>
</div>



<!-- MODAL FOR VIEW USER -->

<div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" style="width: 100%;">
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">View Records of Alumni Students</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            
        <table class="table" cellspacing="0" cellpadding="0" style="border: 1px solid #003049;">
          <thead class="table" style="background: #045597; color: white;">
            <tr>
            <th style="padding: 10px; text-align: left; width: 50%;">Student Details</th>
            <th style="padding: 10px; text-align: left; width: 50%;"></th>
            </tr>
          </thead>
          <tbody>
            <tr style="border-bottom: 1px solid black;">
              <td style="padding: 10px;" >First Name</td>
              <td style="padding: 10px;"><span id="view_fname"></span></td>
            </tr>
            <tr style="border-bottom: 1px solid black;">
              <td style="padding: 10px;" >Middle Name</td>
              <td style="padding: 10px;"><span id="view_mname"></span></td>
            </tr>
            <tr style="border-bottom: 1px solid black;">
              <td style="padding: 10px;" >Last Name</td>
              <td style="padding: 10px;"><span id="view_lname"></span></td>
            </tr>
            <tr>
              <td style="padding: 10px;">Email</td>
              <td style="padding: 10px;"><span id="view_email"></span></td>
            </tr>
            <tr>
              <td style="padding: 10px;">Gender</td>
              <td style="padding: 10px;"><span id="view_gender"></span></td>
            </tr>
            <tr>
              <td style="padding: 10px;">Adress</td>
              <td style="padding: 10px;"><span id="view_address"></span></td>
            </tr>
            <tr>
              <td style="padding: 10px;">Roles</td>
              <td style="padding: 10px;"><span id="view_roles"></span></td>
            </tr>
          </tbody>
        </table>

        <span><strong>Created at:</strong> <span id="view_date"></span></span>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
    </div>
  </div>
</div>
@endrole