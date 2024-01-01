  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

      <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
          <a class="nav-link collapsed" href="/dashboard" id="dashboard-link">
            <i class="bi bi-grid"></i>
            <span>Dashboard</span>
          </a>
        </li><!-a- End Dashboard Nav -->


        <li class="nav-item">
          <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#" id="applicants-link">
            <i class="bi bi-menu-button-wide" ></i><span>Applicants</span><i class="bi bi-chevron-down ms-auto"></i>
          </a>
          <ul id="components-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
            <li>
              <a href="{{ route('admin.applicants.new_applicants') }}">
                <i class="bi bi-circle"></i><span>New Applicants</span>
              </a>
            </li>
            <li>
              <a href="components-accordion.html">
                <i class="bi bi-circle"></i><span>Approved Applicants</span>
              </a>
            </li>
            <li>
              <a href="{{ route('admin.applicants.declined_applicants') }}">
                <i class="bi bi-circle"></i><span>Declined Applicants</span>
              </a>
            </li>
            {{-- <li>
              <a href="components-breadcrumbs.html">
                <i class="bi bi-circle"></i><span>For House Visitation</span>
              </a>
            </li>
            <li>
              <a href="components-buttons.html">
                <i class="bi bi-circle"></i><span>Approved</span>
              </a>
            </li>
            <li>
              <a href="components-cards.html">
                <i class="bi bi-circle"></i><span>Declined</span>
              </a>
            </li>
             --}}
          </ul>
        </li><!-- End Components Nav -->

    
        <li class="nav-item">
          <a class="nav-link collapsed" href="{{ route('admin.announcement.admin-announcement') }}" id="announcement-link">
            <i class="bi bi-journal-text"></i><span>Announcement</span></i>
          </a>
        
        </li><!-- End Forms Nav -->

        <li class="nav-item">
          <a class="nav-link collapsed" href="{{ route('admin.announcement.admin-announcement') }}" id="notify-link">
            <i class="bi bi-envelope-arrow-up"></i><span>Notify</span></i>
          </a>
        
        </li><!-- End Tables Nav -->

        <li class="nav-item">
          <a class="nav-link collapsed" href="{{ route('admin.registration') }}" id="createaccount-link">
            <i class="bi bi-person-plus"></i><span>Create Account</span></i>
          </a>
          
        </li><!-- End Charts Nav -->

        <li class="nav-item">
          <a class="nav-link collapsed"  href="{{ route('admin.admin-logout') }}" id="signout-link">
            <i class="bi bi-box-arrow-in-right"></i><span>Sign out</span></i>
          </a>
        </li><!-- End Icons Nav -->



      
    </aside><!-- End Sidebar-->



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<script>
  function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const navLinks = document.querySelectorAll('.nav-link');

    sidebar.classList.toggle('active');

    const isActive = sidebar.classList.contains('active');

    navLinks.forEach((link) => {
      if (isActive) {
        link.classList.remove('collapsed');
      } else {
        link.classList.add('collapsed');
      }
    });
  }

  const sidebarToggleBtn = document.getElementById('sidebar-toggle-btn');
  sidebarToggleBtn.addEventListener('click', toggleSidebar);
</script>
