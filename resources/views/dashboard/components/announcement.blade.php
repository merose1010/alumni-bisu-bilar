@role(['Super-Admin', 'Admin'])
<section class="announcement-section">

@if (session('status'))
  <h6 class="alert alert-success my-0" id="myAlert" style="font-size: 14px;">{{ session('status') }}</h6>
@endif


    <div class="pb-3 d-flex justify-content-between px-3 pt-4">
    <h5 class="title">Announcements</h5>
    <a href="#" title="Add Announcement"><button class="btn btn-success add-announcement" data-bs-toggle="modal" data-bs-target="#addModal"><i class="fa fa-plus" aria-hidden="true"></i> Add Announcements</button></a>
    </div>

<div class="table-responsive px-3 pb-3">

<table class="table align-middle mb-0 bg-light table-hover" id="dbTable">
<thead class="table bg-primary text-white">
<tr>
  <th scope="col" class="col-sm-2">Subject</th>
  <th scope="col" class="col-7">Description</th>
  <th scope="col">Date</th>
  <th scope="col">Actions</th>
</tr>
</thead>
<tbody>
@foreach($announce as $item)
 <tr>
  <td>{{ $item->subject}}</td>
  
  <td>{{ $item->description}}</td>
  <td>{{ date('F j, Y', strtotime($item->date)) }}</td>
  <td>

  
  <a href="#" title="View" class="actions action-view" data-id="{{ $item->id }}" data-bs-toggle="modal" data-bs-target="#viewModal"><i class="fa fa-eye" aria-hidden="true"></i></a>
  <a href="#" title="Edit" class="actions action-edit" data-id="{{ $item->id }}" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fa fa-pencil" aria-hidden="true"></i></a>
  <a href="/delete_announcement/{{ $item->id }}" title="Delete" onclick="return confirm(&quot;Confirm delete?&quot;)" class="actions action-delete"><i class="fa fa-trash" aria-hidden="true"></i></a>

  </td>-
  </tr>

@endforeach

</tbody>
</table>





</div>




</section>

<!-- MODAL FOR NEW ANNOUNCEMENT -->

<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">

    <form action="/post_announcement" method="post" id="announcement_form">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">New Announcements</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          @csrf
            <div class="mb-3">
              <label for="recipient-name" class="col-form-label">Subject:</label>
              <input type="text" class="form-control" id="subject" name="subject">
              <span class="text-danger error-text" id="error_sub"></span>
            </div>
            <div class="mb-3">
              <label for="message-text" class="col-form-label">Description:</label>
              <textarea rows="5" class="form-control" id="description" name="description"></textarea>
              <span class="text-danger error-text" id="error_des"></span>

            </div>

            <div class="mb-3">
              <label for="message-text" class="col-form-label">Date:</label>
              <input type="date" class="form-control" name="date" id="date">
              <span class="text-danger error-text" id="error_date"></span>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" id="announce_button">Create & Send</button>
        </div>
      </form>
    </div>
  </div>
</div>



<!-- MODAL FOR VIEW ANNOUNCEMENT -->

<div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" style="width: 100%;">
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">View Announcements</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            
        <table class="table" cellspacing="0" cellpadding="0" style="border: 1px solid #003049;">
          <thead class="table" style="background: #045597; color: white;">
            <tr>
            <th style="padding: 10px; text-align: left; width: 30%;">Announcement Details</th>
            <th style="padding: 10px; text-align: left; width: 70%;"></th>
            </tr>
          </thead>
          <tbody>
            <tr style="border-bottom: 1px solid black;">
              <td style="padding: 10px;" >Subject</td>
              <td style="padding: 10px;"><span id="view_subject"></span></td>
            </tr>
            <tr>
              <td style="padding: 10px;">Date</td>
              <td style="padding: 10px;"><span id="view_date"></span></td>
            </tr>
            <tr>
              <td style="padding: 10px;">Description</td>
              <td style="padding: 10px;"><span id="view_description"></span></td>
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


<!-- MODAL FOR UPDATE ANNOUNCEMENT -->

<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" style="width: 100%;">
    <div class="modal-content">

    <form action="/update_announcement" method="post" id="edit_announcement_form">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Announcements</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          @csrf
          @method('put')

            <div class="mb-3" style="display: none;">
              <label for="recipient-name" class="col-form-label">ID:</label>
              <input type="text" id="id" class="form-control" name="aid">
            </div>

            <div class="mb-3">
              <label for="recipient-name" class="col-form-label">Subject:</label>
              <input type="text" id="edit_subject" class="form-control" name="subject">
              <span class="text-danger error-text" id="e_error_sub"></span>
            </div>
            <div class="mb-3">
              <label for="message-text" class="col-form-label">Description:</label>
              <textarea rows="5" id="edit_description" class="form-control" name="description"></textarea>
              <span class="text-danger error-text" id="e_error_des"></span>

            </div>

            <div class="mb-3">
              <label for="message-text" class="col-form-label">Date:</label>
              <input type="date" id="edit_date" class="form-control" name="date">
              <span class="text-danger error-text" id="e_error_date"></span>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" id="edit_announce_button">Update & Send</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endrole