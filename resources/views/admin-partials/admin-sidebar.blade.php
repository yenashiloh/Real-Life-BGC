<div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="navbar-brand-wrapper d-flex align-items-center">
        <a class="navbar-brand brand-logo" href="index.html">
        <h4 style="color: white;">Real LIFE Foundation</h4>
        </a>
        <a class="navbar-brand brand-logo-mini" href="index.html"><h4 style="color: white;">Real LIFE Foundation</h4></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center flex-grow-1">
        <h5 class="mb-0 font-weight-medium d-none d-lg-flex">Welcome, {{ Session::get('adminFirstName') }}!</h5>
        <ul class="navbar-nav navbar-nav-right ml-auto">
          <form class="search-form d-none d-md-block" action="#" id="applicants-search-form">
              <i class="icon-magnifier"></i>
              <input type="search" class="form-control" id="searchInput" placeholder="Search Here" title="Search here">
          </form>
          <li class="nav-item dropdown">
              <a class="nav-link count-indicator message-dropdown" id="messageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                  <i class="icon-bell"></i>
                  <span id="notificationCount" class="count">{{ \App\Models\Notification::where('status', 'unread')->count() }}</span>
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0" aria-labelledby="messageDropdown">
                  <a class="dropdown-item py-3">
                      <p class="mb-0 font-weight-medium float-left">You have <span class="count">{{ \App\Models\Notification::where('status', 'unread')->count() }}</span> notifications</p>
                  </a>
                  <div class="dropdown-divider"></div>
                  @foreach($notifications as $notification)
                      <a href="/applicants/{{ $notification->applicant_id }}" class="dropdown-item preview-item" data-notification-id="{{ $notification->id }}">
                          <div class="preview-thumbnail">
                              <img src="../assets-new-admin/images/faces/face23.png" alt="image" class="img-sm profile-pic">
                          </div>
                          <div class="preview-item-content flex-grow py-2">
                              <p class="preview-subject ellipsis font-weight-medium text-dark">{{ $notification->applicant_name }}</p>
                              <p class="font-weight-light small-text">{{ $notification->message }}</p>
                              <span></span>
                              <p class="font-weight-light" style="font-size:12px; font-style: italic;">
                                  @if($notification->created_at->gt(now()->subDay()))
                                      {{ $notification->created_at->diffForHumans() }}
                                  @else
                                      {{ $notification->created_at->format('F d, Y \a\t g:iA') }}
                                  @endif
                              </p>
                          </div>
                      </a>
                      <hr style=" margin:0;">
                  @endforeach
              </div>
          </li>
          <li class="nav-item dropdown d-none d-xl-inline-flex user-dropdown">
              <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                  <img class="img-xs rounded-circle ml-2" src="../assets-new-admin/images/faces/face22.png" alt="Profile image"> <span class="font-weight-normal">{{ Session::get('adminFirstName') }} {{ Session::get('adminLastName') }}</span></a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                  <div class="dropdown-header text-center">
                      <p class="mb-1 mt-3" style="font-weight: bold; color: black;">{{ Session::get('adminFirstName') }} {{ Session::get('adminLastName') }}</p>
                      <p class="font-weight-light text-muted mb-0">{{ Session::get('adminEmail') }} </p>
                  </div>
                  <a href="/admin-profile" class="dropdown-item"><i class="dropdown-item-icon icon-user text-primary"></i> My Profile</a>
                  <a class="dropdown-item" href="{{ route('admin.admin-logout') }}"><i class="dropdown-item-icon icon-power text-primary"></i>Sign Out</a>
              </div>
          </li>
      </ul>      
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="icon-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item nav-profile">
            <a href="#" class="nav-link">
              <div class="profile-image">
                <img class="img-xs rounded-circle" src="../assets-new-admin/images/faces/face22.png" alt="profile image">
                <div class="dot-indicator bg-success"></div>
              </div>
              <div class="text-wrapper">
                <p class="profile-name">{{ Session::get('adminFirstName') }} {{ Session::get('adminLastName') }}</p>
                <p class="designation">Administrator</p>
              </div>
              {{-- <div class="icon-container">
                <i class="icon-bubbles"></i>
                <div class="dot-indicator bg-danger"></div>
              </div> --}}
            </a>
          </li>
          <li class="nav-item nav-category">
            <span class="nav-link">Dashboard</span>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/dashboard">
              <span class="menu-title">Dashboard</span>
              <i class="icon-screen-desktop menu-icon"></i>
            </a>
          </li>
          <li class="nav-item nav-category"><span class="nav-link">Applicants</span></li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.applicants.new_applicants') }}">
              <span class="menu-title">All Applicants</span>
              <i class="icon-people menu-icon"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.applicants.approved_applicants') }}">
              <span class="menu-title">Approved Applicants</span>
              <i class="icon-user-following menu-icon"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.applicants.declined_applicants') }}">
              <span class="menu-title">Declined Applicants</span>
              <i class="icon-user-unfollow menu-icon"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pages/charts/chartist.html">
              <span class="menu-title">Scheduling</span>
              <i class="icon-calendar menu-icon"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pages/charts/chartist.html">
              <span class="menu-title">Checklist</span>
              <i class="icon-check menu-icon"></i>
            </a>
          </li>
          <li class="nav-item nav-category"><span class="nav-link">Content </span></li>
          <li class="nav-item">
            <a class="nav-link"  href="{{ route('admin.announcement.admin-announcement') }}">
              <span class="menu-title">Announcement</span>
              <i class="icon-screen-tablet menu-icon"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link"  href="{{ route('admin.email.email') }}">
              <span class="menu-title">Email</span>
              <i class=" icon-envelope-open menu-icon"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link"  href="{{ route('admin.registration') }}">
              <span class="menu-title">Create Account</span>
              <i class="icon-user-follow menu-icon"></i>
            </a>
          </li>
        </ul>
      </nav>

      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Include jQuery library if not already included -->


      <script>
  $(document).ready(function() {
    // Function to fetch notification count from the server
    function fetchNotificationCount() {
        $.ajax({
            url: '/fetch-notification-count', // Endpoint to fetch notification count
            type: 'GET',
            success: function(response) {
                $('#notificationCount').text(response.count); // Update notification count
            },
            error: function(xhr, status, error) {
                console.error('Error fetching notification count:', error);
            }
        });
    }

    // Fetch notification count initially when the page loads
    fetchNotificationCount();

    // Fetch notification count every 10 seconds (adjust interval as needed)
    setInterval(fetchNotificationCount, 10000); // 10 seconds interval

    // Handle click event on notification dropdown to reset count
    $('#messageDropdown').on('click', function() {
        // Reset the notification count to zero on the client side
        $('#notificationCount').text('0');
        // Send request to server to mark notifications as read if needed
        $.ajax({
            url: '/mark-notifications-as-read', // Endpoint to mark notifications as read
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include CSRF token
            },
            success: function(response) {
                // Optionally, you can perform additional actions after marking notifications as read
            },
            error: function(xhr, status, error) {
                console.error('Error marking notifications as read:', error);
            }
        });
    });
});

      </script>
      