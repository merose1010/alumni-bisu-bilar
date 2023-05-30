<section class="all-vehicles-section">

@if (session('status'))
  <h6 class="alert alert-success my-0" id="myAlert" style="font-size: 14px;">{{ session('status') }}</h6>
@endif


    <div class="pb-3 d-flex justify-content-between px-3 pt-4">
    <h5 class="title">Alumni Record</h5>
    </div>

<div class="table-responsive px-3 pb-3" style="width: 100%;">

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
  <a href="#" title="View" class="actions action-view" data-id="{{ $roles->id }}" data-bs-toggle="modal" data-bs-target="#viewModal"><i class="fa fa-eye" aria-hidden="true"></i></a>

  @role(['Super-Admin', 'Admin'])
  <a href="/delete_student/{{ $roles->id }}" title="Delete" onclick="return confirm(&quot;Confirm delete?&quot;)" class="actions action-delete"><i class="fa fa-trash" aria-hidden="true"></i></a>
  @endrole

  </td>
  </tr>


@endforeach
</tbody>
</table>





</div>



<!-- <div class="chart-wrapper px-3 pb-3">
  <div class="bg-light db-chart px-3 py-3 mt-4" style=" border-radius: 10px; width: 100%; ">
    <h5><strong>Alumni Record Graphical Reports</strong></h5>
    <canvas id="student_Chart" style=" margin: 0; padding: 0;"></canvas>

    <select id="display-selector">
      <option value="day" selected>Daily</option>
      <option value="week">Weekly</option>
      <option value="month" >Monthly</option>
      <option value="year" >Year</option>
    </select>

    <select id="chart-type-selector" onchange="chartType(this.value)">
      <option value="bar" selected>Bar Chart</option>
      <option value="line">Line Chart</option>
    </select>
  </div>
</div> -->



</section>




<!-- MODAL FOR VIEW STUDENT -->

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
              <td style="padding: 10px;">Course</td>
              <td style="padding: 10px;"><span id="view_course"></span></td>
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