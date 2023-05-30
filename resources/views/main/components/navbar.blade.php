<!-- <nav>
    <div class="nav-bar">
      <i class='bx bx-menu'></i>
      <img src="/images/LOGO-3.png" alt="" srcset="" class="logox">
      <div class="nav-links">
        <div class="sidebar_logo">

          <img src="/images/LOGO-3.png" alt="" srcset="" class="logox">
          <i class='bx bx-x' ></i>
        </div>
        <ul class="_links">
          <li><a href="/home">Home</a></li>
          <li><a href="#news-announce">Announcements</a></li>
          <li>
            <a href="#">ALUMNI</a>
            <i class='bx bxs-chevron-down jsarrow arrow '></i>
            <ul class="js-sub-menu submenu">
              <li><a href="/home-alumni-membership">Apply for Alumni Membership</a></li>
              <li><a href="/home-alumni-id">Apply for Alumni ID</a></li>

            </ul>
          </li>

          <li><a href="/home-reissuance">Re-issueance</a></li>
          
          <li><a href="#about_sec">Contact Us</a></li>
        </ul>
      </div>

      <div class="user-profile" onclick="menuToggle();">

        @if(Auth::user()->profile_picture)
            <img src="{{ asset('images/user_profile/' . Auth::user()->profile_picture) }}" class="user_icon" height="42" width="42" style="object-fit: cover;">
        @else
            <img src="/images/default-user.webp" class="user_icon" height="42" width="42" style="object-fit: cover;">
        @endif
      </div>
    </div>

    <div class="pro-menu-wrap">
        <div class="pro-menu">
            <div class="user-info">

            @if (Auth::check())
              <div><h5>{{ Auth::user()->first_name }} {{ Auth::user()->middle_name }}, {{ Auth::user()->last_name }}</h5></div>
              <div><span>{{ Auth::user()->email }}</span></div>
            @endif
                    
            </div>
            <hr>

        <a href="/home-account" class="pro-menu-link">
            <span>Account Settings</span>
        </a>
        
        <a href="/records-of-students" class="pro-menu-link">
            <span>My Records</span>
        </a>
        <a href="/clientlogout" class="pro-menu-link">
            <span>Logout</span>
        </a>



        </div>
    </div>

  </nav> -->


   
<header id="header">
     <nav>
     <div class="header-col-1 ">
        <a href="/home" class="brand"><img src="/images/LOGO-3.png" class="logo"></a>
    </div>

    <div class="header-col-mid">
          <li> <a href="/home">Home</a></li>
          <li> <a href="/home-alumni-id">Alumni ID</a></li>
          <li> <a href="/home-alumni-membership">Alumni Membership</a></li>
          <li> <a href="/home-reissuance">Reissueance</a></li>
          <li> <a href="/home-announcements">Announcements</a></li>
          <li> <a href="/home-about">Contact Us</a></li>
    </div>

    <div class="header-col-2">
                <div>
                    <a href="#" id="mainside-bar" class="sidebar-toggle" style="color: white;"><i class="fas fa-bars"></i></a>
                </div>
                <!-- <span>
                    <button type="button" class="icon-button">
                    <span><i class="fas fa-comment-alt-dots"></i></span>
                    <span class="icon-button__badge">2</span>
                    </button>
                </span> -->

                <!-- <span>
                    <button type="button" class="icon-button">
                    <span><i class="fas fa-shopping-cart"></i></span>
                    <span class="icon-button__badge">2</span>
                    </button>
                </span> -->

                <span>
                    <a href="/my_notification" type="button" class="icon-button" title="Notifications">
                    <span><i class="fas fa-bell"></i></span>
                  
                    @if($notificationsUnread->count() > 0)
                    <span class="icon-button__badge">{{ $notificationsUnread->count() }}</span>
                    @endif
                    </a>
                </span>



                <span class="user-profile" onclick="menuToggle();">

                @if(Auth::user()->profile_picture)
                    <img src="{{ asset('images/user_profile/' . Auth::user()->profile_picture) }}" class="user_icon" height="42" width="42" style="object-fit: cover;">
                @else
                    <img src="/images/default-user.webp" class="user_icon" height="42" width="42" style="object-fit: cover;">
                @endif
                </span>
    </div>


    <div class="sub-menu-wrap">
        <div class="sub-menu">
            <div class="user-info">
                    <div><h5>            
                        @if (Auth::check())
                        {{ Auth::user()->first_name }} {{ Auth::user()->middle_name }}, {{ Auth::user()->last_name }}
                        @endif
                    </h5>
                    </div>
                    <div><span>                        
                        @if (Auth::check())
                        {{ Auth::user()->email }}
                        @endif
                    </span></div>
            </div>
            <hr>

        <div class="sub-menu-link-wrapper">
        <a href="/home-account" class="sub-menu-link">
            <span>Account Settings</span>
        </a>
        
        <a href="/records-of-students" class="sub-menu-link">
            <span>My Records</span>
        </a>
        <a href="/my_notification" class="sub-menu-link">
            <span>My Notifications</span>
        </a>
        <a href="/clientlogout" class="sub-menu-link">
            <span>Logout</span>
        </a>

            
        </div>



        </div>
    </div>


    </nav>
</header>



<div class="sidebar">
  <span class="close-btn" class="sidebar-toggle">&times;</span>

  <div class="user-profile">
    <div>
    @if(Auth::user()->profile_picture)
        <img src="{{ asset('images/user_profile/' . Auth::user()->profile_picture) }}" class="user_icon" height="42" width="42" style="object-fit: cover;">
    @else
        <img src="/images/default-user.webp" class="user_icon" height="42" width="42" style="object-fit: cover;">
    @endif
    </div>
    <div class="pt-3 user-info">
        <div><span>                        
            @if (Auth::check())
            {{ Auth::user()->first_name }} {{ Auth::user()->middle_name }}, {{ Auth::user()->last_name }}
            @endif
        </span></div>
        <div><span>
            @if (Auth::check())
            {{ Auth::user()->email }} 
            @endif
        </span></div>
    </div>
 </div>

 <hr>

  <div>
<a href="/home-account">Account Settings</a>
<a href="/records-of-students">My Records</a>

<div class="my-notif">
    <a href="/my_notification">
    <span class="notif-word">My Notification
    @if($notificationsUnread->count() > 0)<span class="notif-number">{{ $notificationsUnread->count() }}</span></span>
    @endif
    </a>
</div>
    <hr>
<a href="/home">Home</a>
<a href="/home-alumni-id">Alumni ID</a>
<a href="/home-alumni-membership">Alumni Membership</a>
<a href="/home-reissuance">Reissueance</a>
<a href="/home">Contact Us</a>
<a href="/clientlogout">Logout</a>
  </div>

</div>
