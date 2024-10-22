 <!-- Sidebar -->
 <div class="sidebar" data-background-color="dark">
     <div class="sidebar-logo">
         <!-- Logo Header -->
         <div class="logo-header" data-background-color="white">
             <a href="{{ route('user.applicant_dashboard') }}" class="logo">
                 <img src="../../admin-assets/img/RLlogo.png" alt="navbar brand" class="navbar-brand" height="45" />
             </a>
             <div class="nav-toggle">
                 <button class="btn btn-toggle toggle-sidebar">
                     <i class="gg-menu-right"></i>
                 </button>
                 <button class="btn btn-toggle sidenav-toggler">
                     <i class="gg-menu-left"></i>
                 </button>
             </div>
             <button class="topbar-toggler more">
                 <i class="gg-more-vertical-alt"></i>
             </button>
         </div>
         <!-- End Logo Header -->
     </div>
     <div class="sidebar-wrapper scrollbar scrollbar-inner">
         <div class="sidebar-content">
             <ul class="nav nav-secondary">
                 <li class="nav-section">
                     <span class="sidebar-mini-icon">
                         <i class="fa fa-ellipsis-h"></i>
                     </span>
                     <h4 class="text-section">Menu</h4>
                 </li>
                 <li class="nav-item {{ Route::currentRouteName() === 'user.applicant_dashboard' ? 'active' : '' }}">
                     <a href="{{ route('user.applicant_dashboard') }}" aria-expanded="false">
                         <i class="fas fa-tachometer-alt"></i>
                         <p>Dashboard</p>
                     </a>
                 </li>
                 <li class="nav-section">
                     <span class="sidebar-mini-icon">
                         <i class="fa fa-ellipsis-h"></i>
                     </span>
                     <h4 class="text-section">Application</h4>
                 </li>
                 <li
                     class="nav-item {{ Route::currentRouteName() === 'user.documents.upload-documents' ? 'active' : '' }}">
                     <a href="{{ route('user.documents.upload-documents') }}">
                         <i class="fas fa-file-alt"></i>
                         <p>Documents</p>
                     </a>
                 </li>
                 <li class="nav-item {{ Route::currentRouteName() === 'user.profile' ? 'active' : '' }}">
                     <a href="{{ route('user.profile') }}">
                         <i class="fas fa-id-card"></i>
                         <p>Personal Details</p>
                     </a>
                 </li>
                 <li class="nav-section">
                     <span class="sidebar-mini-icon">
                         <i class="fa fa-ellipsis-h"></i>
                     </span>
                     <h4 class="text-section">Account Settings</h4>
                 </li>
                 <li class="nav-item {{ Route::currentRouteName() === 'user.change_password' ? 'active' : '' }}">
                     <a href="{{ route('user.change_password') }}">
                         <i class="fas fa-cogs"></i>
                         <p>Change Password</p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="#" onclick="confirmLogout(); return false;"> <i
                             class="fas fa-sign-out-alt"></i>Logout</a>
                     <form id="logout-form" action="" method="POST" style="display: none;">
                         @csrf
                     </form>
                 </li>
             </ul>
         </div>
     </div>
 </div>
 <!-- End Sidebar -->

 <script>
     function confirmLogout() {
         Swal.fire({
             title: 'Are you sure?',
             text: "You will be logged out of your account.",
             icon: 'warning',
             showCancelButton: true,
             confirmButtonColor: '#3085d6',
             cancelButtonColor: '#d33',
             confirmButtonText: 'Yes, log me out!'
         }).then((result) => {
             if (result.isConfirmed) {
                 var form = document.createElement('form');
                 form.method = 'POST';
                 form.action = '{{ route('logout') }}';

                 var csrfToken = document.createElement('input');
                 csrfToken.type = 'hidden';
                 csrfToken.name = '_token';
                 csrfToken.value = '{{ csrf_token() }}';
                 form.appendChild(csrfToken);

                 document.body.appendChild(form);
                 form.submit();
             }
         });
     }
 </script>
