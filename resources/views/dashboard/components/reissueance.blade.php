@role(['Secretary','Super-Admin', 'Admin'])
<section class="reissueance-section">

@if (session('status'))
  <h6 class="alert alert-success my-0" id="myAlert" style="font-size: 14px;">{{ session('status') }}</h6>
@endif


    <div class="pb-3 d-flex justify-content-between px-3 pt-4">
    <h5 class="title">Re-Issueance of ID</h5>
    </div>

<div class="table-responsive px-3 pb-3">

<div class="table-options">
  <div class="length-menu" style="display: none;"></div>
  <div class="print-button"></div>
</div>


<table class="table align-middle mb-0 bg-light table-hover display responsive nowrap" id="dbTable" style="width:100%">
<thead class="table bg-primary text-white">
<tr>
  <th scope="col" class="col-3">Student</th>
  <th scope="col">Or No.</th>
  <th scope="col">ID No.</th>
  <th scope="col">Degree</th>
  <th scope="col">Reason</th>
  <th scope="col">Actions</th>
</tr>
</thead>
<tbody>
@foreach($reissueance as $item)
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
  
  <td>{{ $item->or_no}}</td>
  
  <td>{{ $item->id_no}}</td>
  <td>{{ $item->degree}}</td>
  <td>{{ $item->reason}}</td>
  <td>
  <a href="#" title="View" class="actions action-view" data-id="{{ $item->id }}" data-bs-toggle="modal" data-bs-target="#viewModal"><i class="fa fa-eye" aria-hidden="true"></i></a>
  <a href="#" title="Edit" class="actions action-edit" data-id="{{ $item->id }}" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fa fa-pencil" aria-hidden="true"></i></a>
  <a href="/delete_reissueance/{{ $item->id }}" title="Delete" onclick="return confirm(&quot;Confirm delete?&quot;)" class="actions action-delete"><i class="fa fa-trash" aria-hidden="true"></i></a>

    <form action="/notify-reissueance/{{ $item->id}}" method="POST" class="d-inline-block">
      @csrf
      <input type="hidden" name="notification_id" value="{{ $item->id }}">
      <input type="hidden" name="user_id" id="" value="{{ $item->user_id}}">
      <button type="submit" class="btn btn-success text-white" style="font-size: 10px;">
        <i class="fas fa-envelope-open-text"></i> Notify
      </button>
    </form>


  </td>
  </tr>

  @endforeach

</tbody>
</table>





</div>

<div class="chart-wrapper px-3 pb-3">
  <div class="bg-light db-chart px-3 py-3 mt-4" style=" border-radius: 10px; width: 100%; ">
    <h5><strong>Reissueances Graphical Reports</strong></h5>
    <canvas id="reissuance_Chart" style=" margin: 0; padding: 0;"></canvas>

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




<!-- MODAL FOR VIEW REISSUEANCE -->

<div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" style="width: 100%;">
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Reissuance</h5>
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
              <td style="padding: 10px;">ID No</td>
              <td style="padding: 10px;"><span id="view_idno"></span></td>
            </tr>
            <tr>
              <td style="padding: 10px;">Degree</td>
              <td style="padding: 10px;"><span id="view_degree"></span></td>
            </tr>
            <tr>
              <td style="padding: 10px;">Reason</td>
              <td style="padding: 10px;"><span id="view_reason"></span></td>
            </tr>
            <tr>
              <td style="padding: 10px;">OR No</td>
              <td style="padding: 10px;"><span id="view_orno"></span></td>
            </tr>
            <tr>
              <td style="padding: 10px;">Signature</td>
              <td style="padding: 10px;"><span id="view_sig"><img src="" style="width: 200px;"></span></td>
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






<!-- EDIT Reiisuence -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">

    <form action="/update-student-reissueance-db" method="post" id="edit_user_form" enctype="multipart/form-data">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Reissueance</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body roles-modal">
        @csrf
        @method('put')


            <div class="group">
              
              <div class="mb-3" style="display: none;">
                <label for="recipient-name" class="col-form-label">ID:</label>
                <input type="text" id="edit_r_id" class="form-control" name="r_id">
              </div>
              
              <div class="mb-2 input-field">
                <label for="recipient-name" class="">Name:</label>
                <input type="text" name="name" class="" id="edit_r_name">
                <span class="text-danger" id="edit_error_fname"></span>
              </div>

              <div class="mb-2 input-field">
                <label for="recipient-name" class="">ID #:</label>
                <input type="number" name="id_no" class="" id="edit_r_idno">
                <span class="text-danger" id="edit_error_mname"></span>
              </div>

              <div class="mb-2 input-field">
                <label for="recipient-name" class="">Degree:</label>
                <input type="text" name="degree" class="" id="edit_r_degree">
                <span class="text-danger" id="edit_error_mname"></span>
              </div>


              
            <div class="mb-2 input-field">
                <label for="recipient-name" class="">Reason:</label>
                <input type="text" name="reason" class="" id="edit_r_reason">
                <span class="text-danger" id="edit_error_lname"></span>
              </div>

              <div class="mb-2 input-field">
                <label for="recipient-name" class="">OR #:</label>
                <input type="number" name="or_no" class=""  name="email" id="edit_r_orno">
                <span class="text-danger" id="edit_error_email"></span>
              </div>


            </div>

            <div class="group">


              <div class="editPhoto">
                <img src=""
                id="change-img-add" style="object-fit: cover;">
                <p class="pt-2">Edit your Signature <span class="error-text" id="error_sig"></span></p>
              </div>

              <div class="img-button">
                  <input type="file" name="signature" id="addphotoBtn" accept="image/jpg, image/jpeg, image/png" hidden>
                  <button onclick ="addPhoto()" type="button" class="addphoto-btn btn btn-primary" id="addphotoBtn">Choose Image</button>
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
@endrole