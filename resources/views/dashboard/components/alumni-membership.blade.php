<section class="all-vehicles-section">

@if (session('status'))
  <h6 class="alert alert-success my-0" id="myAlert" style="font-size: 14px;">{{ session('status') }}</h6>
@endif


    <div class="pb-3 d-flex justify-content-between px-3 pt-4">
    <h5 class="title">Alumni Membership</h5>
    </div>

<div class="table-responsive px-3 pb-3" style="width: 100%;">

<table class="table align-middle mb-0 bg-light table-hover display responsive nowrap" id="dbTable" style="width: 100%;">
<thead class="table bg-primary text-white">
<tr>
  <th scope="col" class="col-3">Student</th>
  <th scope="col">Address</th>
  <th scope="col">Bday</th>
  <th scope="col">Contact #</th>
  <th scope="col">Payment Method</th>
  <th scope="col">Status</th>
  <th scope="col">Actions</th>
</tr>
</thead>
<tbody>
@foreach($amem as $item)
 <tr>
 <td>
    <div class ="d-flex align-items-center">
    @if($item->user->profile_picture)
        <img src="{{ asset('images/user_profile/' . $item->user->profile_picture) }}" style="height: 45px; width: 45px; object-fit: cover;" class="rounded-circle">
    @else
        <img src="images/LOGO.png" style="height: 45px; width: 45px; object-fit: cover;" class="rounded-circle">
    @endif
    <div class="ms-3">
        <p class="fw-bold mb-1">{{ $item->name }}</p>
        <p class="text-muted mb-0">{{ $item->user->email }}</p>

    </div>
    </div>

  </td>
  <td>
   {{ $item->address}}
  </td>
  <td>{{ $item->bday}}</td>
  
  <td>{{ $item->con_num}}</td>
  <td>{{ $item->pay_med}}</td>
  <td>
  @if ($item->status == 'In Progress')
      <span class="badge bg-warning rounded-pill">{{ $item->status }}</span>
  @elseif ($item->status == 'Paid')
      <span class="badge bg-success rounded-pill">{{ $item->status }}</span>
  @endif
  </td>


  <td>

  <div style="display: flex;">
  <div class="d-flex align-items-center">
  <a href="#" title="View" class="actions action-view" data-id="{{ $item->id }}" data-bs-toggle="modal" data-bs-target="#viewModal"><i class="fa fa-eye" aria-hidden="true"></i></a>
  <a href="#" title="Edit" class="actions action-edit" data-id="{{ $item->id }}" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fa fa-pencil" aria-hidden="true"></i></a>


  @role(['ID Staff','Super-Admin', 'Admin'])
  <a href="/delete_alumni_mem/{{ $item->id }}" title="Delete" onclick="return confirm(&quot;Confirm delete?&quot;)" class="actions action-delete"><i class="fa fa-trash" aria-hidden="true"></i></a>
  @endrole
  </div>


  <div class="d-flex align-items-center" style="gap: 5px;">
  @if ($item->status != 'Paid')
      <form method="POST" action="/confirm_amem/{{$item->id}}">
        @csrf
        <input type="hidden" name="amem_id" value="{{ $item->id }}">
        <button type="submit" class="btn btn-primary" style="font-size: 10px;">Confirm</button>
      </form>
    </div>
  @endif

  @if ($item->status === 'Paid')
    <form action="/notify-alumni-mem/{{ $item->id}}" method="POST" class="d-inline-block">
      @csrf
      <input type="hidden" name="notification_id" value="{{ $item->id }}">
      <input type="hidden" name="user_id" id="" value="{{ $item->user_id}}">
      <button type="submit" class="btn btn-success text-white" style="font-size: 10px;">
        <i class="fas fa-envelope-open-text"></i> Notify
      </button>
    </form>
    </div>
    @endif

  </div>


  </td>
  </tr>
  @endforeach



</tbody>
</table>





</div>



<div class="chart-wrapper px-3 pb-3">
  <div class="bg-light db-chart px-3 py-3 mt-4" style=" border-radius: 10px; width: 100%; ">
    <h5><strong>Alumni Membership Graphical Reports</strong></h5>
    <canvas id="alumni_mem_Chart" style=" margin: 0; padding: 0;"></canvas>

    <select id="display-selector">
      <option value="day" selected>Daily</option>
      <option value="week">Weekly</option>
      <option value="month" >Monthly</option>
      <option value="year" >Year</option>
    </select>

    <select id="chart-type-selector" onchange="chartType(this.value)">
      <option value="bar" selected>Bar Chart</option>
      <option value="line">Line Chart</option>
      <!-- <option value="pie">Pie Chart</option> -->
    </select>
  </div>
</div>



</section>




<!-- MODAL FOR VIEW AMEM -->

<div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" style="width: 100%;">
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Alumni Membership</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            
        <table class="table" cellspacing="0" cellpadding="0" style="border: 1px solid #003049;">
          <thead class="table" style="background: #045597; color: white;">
            <tr>
            <th style="padding: 10px; text-align: left; width: 30%;">Details</th>
            <th style="padding: 10px; text-align: left; width: 70%;"></th>
            </tr>
          </thead>
          <tbody>
            <tr style="border-bottom: 1px solid black;">
              <td style="padding: 10px;" >Name</td>
              <td style="padding: 10px;"><span id="view_name"></span></td>
            </tr>
            <tr>
              <td style="padding: 10px;">Adress</td>
              <td style="padding: 10px;"><span id="view_address"></span></td>
            </tr>
            <tr>
              <td style="padding: 10px;">Birthday</td>
              <td style="padding: 10px;"><span id="view_bday"></span></td>
            </tr>
            <tr>
              <td style="padding: 10px;">Contact #</td>
              <td style="padding: 10px;"><span id="view_con_num"></span></td>
            </tr>
            <tr>
              <td style="padding: 10px;">FB Url</td>
              <td style="padding: 10px;"><span id="view_fb"></span></td>
            </tr>
            <tr>
              <td style="padding: 10px;">Payment Method</td>
              <td style="padding: 10px;"><span id="view_paymed"></span></td>
            </tr>
            <tr>
              <td style="padding: 10px;">Gcash Reference #</td>
              <td style="padding: 10px;"><span id="view_ref"></span></td>
            </tr>
            <tr>
              <td style="padding: 10px;">Status</td>
              <td style="padding: 10px;"><span id="view_status"></span></td>
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


<!-- EDIT AlUMNI MEM -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">

    <form action="/update-student-amem-db" method="post" id="edit_user_form" enctype="multipart/form-data">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Alumni Membership</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body roles-modal">
        @csrf
        @method('put')


            <div class="group">

              <div class="mb-3" style="display: none;">
                <label for="recipient-name" class="col-form-label">ID:</label>
                <input type="text" id="edit_mem_id" class="form-control" name="mem_id">
              </div>

              <div class="mb-2 input-field">
                <label for="recipient-name" class="">Name:</label>
                <input type="text" name="name" class="" id="edit_mem_name">
                <span class="text-danger" id="edit_error_fname"></span>
              </div>

              <div class="mb-2 input-field">
                <label for="recipient-name" class="">Address:</label>
                <input type="text" name="address" class="" id="edit_mem_address">
                <span class="text-danger" id="edit_error_mname"></span>
              </div>

              <div class="mb-2 input-field">
                <label for="recipient-name" class="">Birthday:</label>
                <input type="date" name="bday" class="" id="edit_mem_bday">
                <span class="text-danger" id="edit_error_lname"></span>
              </div>

              <div class="mb-2 input-field">
                <label for="recipient-name" class="">Contact #:</label>
                <input type="number" name="con_num" class=""  name="email" id="edit_mem_con_num">
                <span class="text-danger" id="edit_error_email"></span>
              </div>

              <div class="mb-2 input-field">
                <label for="recipient-name" class="">FB Account:</label>
                <input type="text" name="fb" class=""  name="email" id="edit_mem_fb">
                <span class="text-danger" id="edit_error_email"></span>
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