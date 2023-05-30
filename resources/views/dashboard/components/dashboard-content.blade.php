<div class="dashboard-content px-3 pt-4">
        <h2>Hi!  <span><strong>{{ Auth::user()->first_name }} {{ Auth::user()->middle_name }}, {{ Auth::user()->last_name }}</strong></span> ({{ Auth::user()->roles->pluck('name')->implode(', ') }})</h2>
        <!-- <p class="text-par">Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore voluptas iste nemo quasi aperiam ducimus sed culpa, in, praesentium iure non aliquam veniam neque! In molestias eveniet laudantium eius facere!</p> -->
      
      <div class="row pt-2 d-flex justify-content-between" id="dashboard-row">
      
        <div class="dashboard-tab-wrapper">

        @role(['Secretary','Super-Admin', 'Admin'])
        <a href="/alumni-membership" class="text-decoration-none">
          <div class="bg-dark text-white dashboard-tab">
            <p>Alumni Members</p>
            <p>{{ $numberOfAlumniMem }}</p>
          </div>
        </a>
        @endrole

        @role(['ID Staff','Super-Admin', 'Admin'])
        <a href="alumni-id" class="text-decoration-none">
          <div class="bg-dark text-white dashboard-tab">
            <p>Alumni ID Production</p>
            <p>{{ $numberOfAlumniID }}</p>
          </div>
        </a>
        @endrole

        @role(['ID Staff','Super-Admin', 'Admin','Secretary'])
        <a href="/record-of-alumni" class="text-decoration-none">
          <div class="bg-dark text-white dashboard-tab">
            <p>Record for Information of Alumni Students</p>
            <p>{{ $numberOfStudents }}</p>
          </div>
        </a>
        @endrole

        @role(['Super-Admin', 'Admin'])
        <a href="/announcement" class="text-decoration-none">
          <div class="bg-dark text-white dashboard-tab">
            <p>Announcements</p>
            <p>{{ $numberOfAnnouncement }}</p>
          </div>
        </a>
        @endrole

        </div>


      </div>

      <hr class="hr-2">


    <div class="pt-2 d-flex justify-content-between db-bottom-row" >

    <div class="db-bottom-col1" >
    <div class="bg-light db-chart px-2 py-2" style=" border-radius: 10px; ">
    <canvas id="dashboard-Chart"></canvas>
    </div>
    </div>

    <div class="db-bottom-col2" >
      <table class="table table-hover align-middle mb-0 bg-light" id="dashboard-content-table">
        <thead class="bg-light ">
          <tr>
            <th scope="col">New Customers</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
            @if(count($allusers) > 0)
            @foreach($allusers->reverse() as $item)
              <tr>

                <td>
                  <div class ="d-flex align-items-center">

                  @if($item->profile_picture)
                      <img src="{{ asset('images/user_profile/' . $item->profile_picture) }}" style="height: 45px; width: 45px; object-fit: cover;" class="rounded-circle">
                  @else
                      <img src="images/LOGO.png" style="height: 45px; width: 45px; object-fit: cover;" class="rounded-circle">
                  @endif

                    <div class="ms-3 ">
                        <p class="fw-bold mb-1">{{ $item->first_name}} {{ $item->last_name}}</p>
                        <p class="text-muted mb-0">{{ $item->email}}</p>

                    </div>
                  </div>

                </td>

                <td style="text-align: right">
                  <p class="fst-italic text-muted my-0" >Member Since:</p>
                  <p class="fst-italic text-muted my-0" >{{ $item->created_at->format('M j, Y h:i A')}}</p>
                </td>

              </tr>
              @endforeach
              @else
              <tr class="no-data">
                <td colspan="2" class="text-center">No new user for the last 24hrs</td>
              </tr>
              @endif
            </tbody>
      </table>
    </div>

    

      </div>
      
      </div>