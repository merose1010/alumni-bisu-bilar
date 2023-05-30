<section id="record_section">

    <span class="record_title">My Records</span>

    @if (session('success'))
    <h6 class="alert alert-success" id="myAlert">{{ session('success') }}</h6>
    @endif


    <div class="alumniid_application">
        <div class="alumniid_application_sec">
        @if(Auth::user()->alumni_id_applied)
        <span class="text mb-2 sub-text"><strong> Alumni ID Application</strong></span>
            <div class="table-responsive pb-3" style="width: 100%;">
                <table class="table align-middle mb-0 bg-light table-bordered table-hover display responsive nowrap" id="clientTable" style="width: 100%;">
                    <thead class="table text-black" >
                        <tr>
                            <th scope="col">Student</th>
                            <th scope="col">ALumni #</th>
                            <th scope="col">ID #</th>
                            <th scope="col">Address</th>
                            <th scope="col">Bday</th>
                            <th scope="col">Course</th>
                            <th scope="col">Payment Method</th>
                            <th scope="col">Status</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($alumni_id as $item)
                        <tr>
                            <td>
                            {{ $item->name}}
                            </td>
                            <td>
                            {{ $item->a_no}}
                            </td>
                            <td>
                            {{ $item->id_no}}
                            </td>
                            <td>
                            {{ $item->address}}
                            </td>
                            <td>
                            {{ $item->bday}}
                            </td>
                            <td>
                            {{ $item->course}}
                            </td>
                            <td>{{ $item->pay_med}}</td>
                            <td>
                            @if ($item->status == 'In Progress')
                                <span class="badge bg-warning rounded-pill">{{ $item->status }}</span>
                            @elseif ($item->status == 'Paid')
                                <span class="badge bg-success rounded-pill">{{ $item->status }}</span>
                            @endif
                            </td>


                            <td>
                            <a href="#" title="View" class="text-dark actions view_alumni_id" data-id="{{ $item->id }}" data-bs-toggle="modal" data-bs-target="#viewModal_alumni_id"><i class="fa fa-eye" aria-hidden="true"></i></a>
                            <a href="#" title="Edit" class="actions edit_alumni_id" data-id="{{ $item->id }}" data-bs-toggle="modal" data-bs-target="#editModal_alumni_id"><i class="fa fa-edit"></i></a>
                            <a href="" title="Delete" onclick="return confirm(&quot;Confirm delete?&quot;)" class="text-danger actions action-delete"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
                @else

            <span class="text">Not yet Applied for Alumni ID. <a href="/home-alumni-id"> Apply Now!</a></span>
            @endif
        </div>
    </div>

    <div class="alumnimem_application">
    <div class="alumnimem_application_sec">
        @if(Auth::user()->alumni_mem_applied)
        <span class="text mb-2 sub-text"><strong> Alumni Membership Application</strong></span>
            <div class="table-responsive pb-3" style="width: 100%;">
                <table class="table align-middle mb-0 bg-light table-bordered table-hover display responsive nowrap" id="clientTable2" style="width: 100%;">
                    <thead class="table text-black" >
                        <tr>
                            <th scope="col">Student</th>
                            <th scope="col">Address</th>
                            <th scope="col">Bday</th>
                            <th scope="col">Contact #</th>
                            <th scope="col">FB</th>
                            <th scope="col">Payment Method</th>
                            <th scope="col">Status</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($alumni_mem as $item)
                        <tr>
                        <td>
                            {{ $item->name}}
                            </td>
                            <td>
                            {{ $item->address}}
                            </td>
                            <td>
                            {{ $item->bday}}
                            </td>
                            <td>
                            {{ $item->con_num}}
                            </td>
                            <td>
                            {{ $item->fb}}
                            </td>
                            <td>{{ $item->pay_med}}</td>
                            <td>
                            @if ($item->status == 'In Progress')
                                <span class="badge bg-warning rounded-pill">{{ $item->status }}</span>
                            @elseif ($item->status == 'Paid')
                                <span class="badge bg-success rounded-pill">{{ $item->status }}</span>
                            @endif
                            </td>


                            <td>
                            <a href="#" title="View" class="text-dark actions view_alumni_mem" data-id="{{ $item->id }}"  data-bs-toggle="modal" data-bs-target="#viewModal_alumni_mem"><i class="fa fa-eye" aria-hidden="true"></i></a>
                            <a href="#" title="Edit" class="actions edit_alumni_mem"  data-id="{{ $item->id }}" data-bs-toggle="modal" data-bs-target="#editModal_alumni_mem"><i class="fa fa-edit"></i></a>
                            <a href="" title="Delete" onclick="return confirm(&quot;Confirm delete?&quot;)" class="text-danger actions action-delete"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
                @else

            <span class="text">Not yet Applied for Alumni Membership. <a href="/home-alumni-membership"> Apply Now!</a></span>
            @endif
        </div>

    </div>

    <div class="reissueance_application">

    <div class="reissueance_application_sec">
        @if(Auth::user()->reissueance_applied)
        <span class="text mb-2 sub-text"><strong>Reissueance of ID</strong></span>
            <div class="table-responsive pb-3" style="width: 100%;">
                <table class="table align-middle mb-0 bg-light table-bordered table-hover display responsive nowrap" id="clientTable3" style="width: 100%;">
                    <thead class="table text-black" >
                        <tr>
                            <th scope="col">Student</th>
                            <th scope="col">ID #</th>
                            <th scope="col">Degree</th>
                            <th scope="col">Reason</th>
                            <th scope="col">OR_No</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reissue as $item)
                        <tr>
                            <td>
                            {{ $item->name}}
                            </td>
                            <td>
                            {{ $item->id_no}}
                            </td>
                            <td>
                            {{ $item->degree}}
                            </td>
                            <td>
                            {{ $item->reason}}
                            </td>
                            <td>
                            {{ $item->or_no}}
                            </td>


                            <td>
                            <a href="#" title="View" class="text-dark actions view_reissue" data-id="{{ $item->id }}" data-bs-toggle="modal" data-bs-target="#viewModal_reissue"><i class="fa fa-eye" aria-hidden="true"></i></a>
                            <a href="#" title="Edit" class="actions edit_reissue" data-id="{{ $item->id }}" data-bs-toggle="modal" data-bs-target="#editModal_reissueance"><i class="fa fa-edit"></i></a>
                            <a href="" title="Delete" onclick="return confirm(&quot;Confirm delete?&quot;)" class="text-danger actions action-delete"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
                @else

            <span class="text">You have no Reissueance. <a href="/home-reissuance"> Apply Now!</a></span>
            @endif
        </div>

    </div>


</section>



<!-- MODAL FOR VIEW  ALUMNI ID -->

<div class="modal fade" id="viewModal_alumni_id" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" style="width: 100%;">
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Alumni ID</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            
        <table class="table" cellspacing="0" cellpadding="0" style="border: 1px solid #003049;"  id="dbTable">
          <thead class="table" style="background: #045597; color: white;">
            <tr>
            <th style="padding: 10px; text-align: left; width: 30%;">Details</th>
            <th style="padding: 10px; text-align: left; width: 70%;"></th>
            </tr>
          </thead>
          <tbody>
            <tr style="border-bottom: 1px solid black;">
              <td style="padding: 10px;" >Alumni Id</td>
              <td style="padding: 10px;"><span id="view_a_no"></span></td>
            </tr>
            <tr style="border-bottom: 1px solid black;">
              <td style="padding: 10px;" >ID No</td>
              <td style="padding: 10px;"><span id="view_id_no"></span></td>
            </tr>
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
              <td style="padding: 10px;">Course</td>
              <td style="padding: 10px;"><span id="view_course"></span></td>
            </tr>
            <tr>
              <td style="padding: 10px;">Payment Method</td>
              <td style="padding: 10px;"><span id="view_paymed"></span></td>
            </tr>
            <tr>
              <td style="padding: 10px;">Citizenship</td>
              <td style="padding: 10px;"><span id="view_cs"></span></td>
            </tr>
            <tr>
              <td style="padding: 10px;">Month Garduated</td>
              <td style="padding: 10px;"><span id="view_month"></span></td>
            </tr>
            <tr>
              <td style="padding: 10px;">Status</td>
              <td style="padding: 10px;"><span id="view_status"></span></td>
            </tr>
            <tr>
              <td style="padding: 10px;">Gcash Ref. No</td>
              <td style="padding: 10px;"><span id="view_ref"></span></td>
            </tr>
            <tr>
              <td style="padding: 10px;">Price</td>
              <td style="padding: 10px;"><span id="view_price"></span></td>
            </tr>
            <tr>
              <td style="padding: 10px;">Signature</td>
              <td style="padding: 10px;"><span id="view_sig"><img src="" style="width: 200px;"></span></td>
            </tr>

            <tr>
              <td style="padding: 10px;">Created at</td>
              <td style="padding: 10px;"><span id="view_date"></span></td>
            </tr>

          </tbody>
        </table>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
    </div>
  </div>
</div>


<!-- EDIT AlUMNI ID -->
<div class="modal fade" id="editModal_alumni_id" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">

    <form action="/update-student-aid" method="post" id="edit_user_form" enctype="multipart/form-data">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Alumni ID</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body roles-modal">
        @csrf
        @method('put')


            <div class="group">
              
          <div class="mb-3" style="display: none;">
              <label for="recipient-name" class="col-form-label">ID:</label>
              <input type="text" id="edit_aid_id" class="form-control" name="aid_id">
            </div>


              <div class="mb-2 input-field">
                <label for="recipient-name" class="">ID # (Year Graudated):</label>
                <input type="number" name="id_no" class="" id="edit_id_no">
                <span class="text-danger" id="edit_error_mname"></span>
              </div>

              <div class="mb-2 input-field" style="display: none;">
                <label for="recipient-name" class="">ALUMNI #:</label>
                <input type="text" name="a_no" class="" id="">
                <span class="text-danger" id="edit_error_mname"></span>
              </div>

              <div class="mb-2 input-field">
                <label for="recipient-name" class="">Name:</label>
                <input type="text" name="name" class="" id="edit_name">
                <span class="text-danger" id="edit_error_lname"></span>
              </div>

              <div class="mb-2 input-field">
                <label for="recipient-name" class="">Address:</label>
                <input type="text" name="address" class="" id="edit_address" >
                <span class="text-danger" id="edit_error_email"></span>
              </div>

              <div class="mb-2 input-field">
                <label for="recipient-name" class="">Birthday:</label>
                <input type="date" name="bday" class="" id="edit_bday">
                <span class="text-danger" id="edit_error_address"></span>
              </div>

              <div class="mb-2 input-field" >
                <label for="recipient-name" class="">Month Graduated:</label>
                  <select id="edit_month" name="month_grad" value="{{ old('month_grad') }}">
                      <option value="" disabled>Select a month</option>
                      <?php
                      $months = [
                          'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'
                      ];
                      foreach ($months as $month) {
                          echo "<option value='$month'>$month</option>";
                      }
                      ?>
                  </select>
              </div>

              <div class="mb-2 input-field">
                <label for="recipient-name" class="">Citizenship:</label>
                <input type="text" name="citizenship" class=""  id="edit_cs" >
                <span class="text-danger" id="edit_error_email"></span>
              </div>
              
              <div class="mb-2 input-field">
                <label for="recipient-name" class="">Course:</label>
                <input type="text" name="course" class="" id="edit_course">
                <span class="text-danger" id="edit_error_address"></span>
              </div>

              <div class="mb-2 input-field">
                <label for="recipient-name" class="">Gcash Ref. no.:</label>
                <input type="number" name="reference_no" class="" id="edit_ref">
                <span class="text-danger" id="edit_error_address"></span>
              </div>


            </div>

            <div class="group">



              <div class="editPhoto">
                <img src=""
                id="edit_sig_img" style="object-fit: cover;">
                <p class="pt-2">Edit your Signature <span class="error-text" id="error_sig"></span></p>
              </div>

              <div class="img-button">
                  <input type="file" name="signature" id="addphotoBtn_aid" accept="image/jpg, image/jpeg, image/png" hidden>
                  <button onclick ="addphoto_aid()" type="button" class="addphoto-btn bg-primary" id="addphotoBtn_aid">Choose Image</button>
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


<!-- MODAL FOR VIEW  ALUMNI MEMBERSHIP -->

<div class="modal fade" id="viewModal_alumni_mem" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" style="width: 100%;">
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Alumni Membership</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            
        <table class="table" cellspacing="0" cellpadding="0" style="border: 1px solid #003049;" id="dbTable">
          <thead class="table" style="background: #045597; color: white;">
            <tr>
            <th style="padding: 10px; text-align: left; width: 30%;">Details</th>
            <th style="padding: 10px; text-align: left; width: 70%;"></th>
            </tr>
          </thead>
          <tbody>
            <tr style="border-bottom: 1px solid black;">
              <td style="padding: 10px;" >Name</td>
              <td style="padding: 10px;"><span id="view_mem_name"></span></td>
            </tr>
            <tr>
              <td style="padding: 10px;">Address</td>
              <td style="padding: 10px;"><span id="view_mem_address"></span></td>
            </tr>
            <tr>
              <td style="padding: 10px;">Birthday</td>
              <td style="padding: 10px;"><span id="view_mem_bday"></span></td>
            </tr>
            <tr>
              <td style="padding: 10px;">Contact #</td>
              <td style="padding: 10px;"><span id="view_mem_con_num"></span></td>
            </tr>
            <tr>
              <td style="padding: 10px;">FB Url</td>
              <td style="padding: 10px;"><span id="view_mem_fb"></span></td>
            </tr>
            <tr>
              <td style="padding: 10px;">Payment Method</td>
              <td style="padding: 10px;"><span id="view_mem_paymed"></span></td>
            </tr>
            <tr>
              <td style="padding: 10px;">Status</td>
              <td style="padding: 10px;"><span id="view_mem_status"></span></td>
            </tr>
            <tr>
              <td style="padding: 10px;">Gcash Ref. No</td>
              <td style="padding: 10px;"><span id="view_mem_ref"></span></td>
            </tr>
            <tr>
              <td style="padding: 10px;">Price</td>
              <td style="padding: 10px;"><span id="view_mem_price"></span></td>
            </tr>
            <tr>
              <td style="padding: 10px;">Created at</td>
              <td style="padding: 10px;"><span id="view_mem_date"></span></td>
            </tr>
            
          </tbody>
        </table>


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
    </div>
  </div>
</div>


<!-- EDIT AlUMNI MEM -->
<div class="modal fade" id="editModal_alumni_mem" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">

    <form action="/update-student-amem" method="post" id="edit_user_form" enctype="multipart/form-data">
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
                <input type="number" name="con_num" class="" id="edit_mem_con_num">
                <span class="text-danger" id="edit_error_email"></span>
              </div>

              <div class="mb-2 input-field">
                <label for="recipient-name" class="">FB Account:</label>
                <input type="text" name="fb" class="" id="edit_mem_fb">
                <span class="text-danger" id="edit_error_email"></span>
              </div>

              <div class="mb-2 input-field">
                <label for="recipient-name" class="">Gcash Ref. no. :</label>
                <input type="number" name="reference_no" class=""  id="edit_mem_ref">
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


<!-- MODAL FOR VIEW REISSUEANCE -->

<div class="modal fade" id="viewModal_reissue" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" style="width: 100%;">
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Reissuance</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            
        <table class="table" cellspacing="0" cellpadding="0" style="border: 1px solid #003049;" id="dbTable">
          <thead class="table" style="background: #045597; color: white;">
            <tr>
            <th style="padding: 10px; text-align: left; width: 30%;">Details</th>
            <th style="padding: 10px; text-align: left; width: 70%;"></th>
            </tr>
          </thead>
          <tbody>
            <tr style="border-bottom: 1px solid black;">
              <td style="padding: 10px;" >Name</td>
              <td style="padding: 10px;"><span id="view_r_name"></span></td>
            </tr>
            <tr>
              <td style="padding: 10px;">ID No</td>
              <td style="padding: 10px;"><span id="view_r_idno"></span></td>
            </tr>
            <tr>
              <td style="padding: 10px;">Degree</td>
              <td style="padding: 10px;"><span id="view_r_degree"></span></td>
            </tr>
            <tr>
              <td style="padding: 10px;">Reason</td>
              <td style="padding: 10px;"><span id="view_r_reason"></span></td>
            </tr>
            <tr>
              <td style="padding: 10px;">OR No</td>
              <td style="padding: 10px;"><span id="view_r_orno"></span></td>
            </tr>
            <tr>
              <td style="padding: 10px;">Signature</td>
              <td style="padding: 10px;"><span id="view_r_sig"><img src="" style="width: 200px;"></span></td>
            </tr>

            <tr>
              <td style="padding: 10px;">Created at</td>
              <td style="padding: 10px;"><span id="view_r_date"></span></td>
            </tr>

          </tbody>
        </table>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
    </div>
  </div>
</div>


<!-- EDIT Reiisuence -->
<div class="modal fade" id="editModal_reissueance" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">

    <form action="/update-student-reissueance" method="post" id="edit_user_form" enctype="multipart/form-data">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Reissueance</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
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
                <input type="number" name="or_no" class=""  id="edit_r_orno">
                <span class="text-danger" id="edit_error_email"></span>
              </div>


            </div>

            <div class="group">


              <div class="editPhoto">
                <img src=""
                id="edit_r_sig_img" style="object-fit: cover;">
                <p class="pt-2">Edit your Signature <span class="error-text" id="error_sig"></span></p>
              </div>

              <div class="img-button">
                  <input type="file" name="signature" id="addphotoBtn_reissue" accept="image/jpg, image/jpeg, image/png" hidden>
                  <button onclick ="addphoto_reissue()" type="button" class="addphoto-btn bg-primary" id="addphotoBtn_reissue">Choose Image</button>
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
