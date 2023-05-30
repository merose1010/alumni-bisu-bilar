<section class="all-notif-section">


@if (session('status'))
  <h6 class="alert alert-success my-0" id="myAlert">{{ session('status') }}</h6>
@endif

    
<div class="pb-2 d-flex justify-content-between pt-4">
  <h5 class="pb-2 title"><strong>All Notifications</strong></h5>
  </div>

  <div class="table-responsive pb-3">
  
<table class="table  table-bordered align-middle mb-0 bg-light table-hover display responsive nowrap" id="clientTable" style="width: 100%;">
<thead class="bg-light">
<tr id="notif-head">
  <th scope="col">Message</th>
  <th scope="col">Created at</th>
  <th scope="col">Actions</th>
</tr>
</thead>
<tbody>
@foreach($notification as $item)
    <tr>
      <!-- <td>
        <div class="d-flex align-items-center">
          @if($item->user->profile_picture)
                <img src="{{ asset('images/user_profile/' . Auth::user()->profile_picture) }}" class="user_icon rounded-circle" height="42" width="42" style="object-fit: cover;">
            @else
                <img src="/images/default-user.webp" class="user_icon rounded-circle" height="42" width="42" style="object-fit: cover;">
            @endif
          <div class="ms-3">
            <p class="fw-bold mb-1">erte</p>
            <p class="text mb-0">wewewe</p>
          </div>
        </div>
      </td> -->
      <td>{{ $item->message}}</td>
      <td>{{ \Carbon\Carbon::parse($item->created_at)->format('F j, Y g:ia') }}</td>
      <td>
        @if(!$item->read_at)
          <form action="/mark_as_read_user/{{ $item->id}}" method="POST" class="d-inline-block">
            @csrf
            @method('PUT')
            <input type="hidden" name="notification_id" value="{{ $item->id }}">
            <button type="submit" class="btn btn-success text-white" style="font-size: 10px;">
              <i class="fas fa-envelope-open-text"></i> Mark as Read
            </button>
          </form>
        @endif

    <a href="/delete_user_notification/{{ $item->id }}" title="Delete" onclick="return confirm(&quot;Confirm delete?&quot;)" class="actions action-delete text-dark"><i class="fa fa-trash" aria-hidden="true"></i></a>


  </td>
  </tr>
  @endforeach




</tbody>
</table>
</div>
</section>
