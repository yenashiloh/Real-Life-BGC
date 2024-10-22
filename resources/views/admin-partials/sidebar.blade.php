 <!-- Sidebar -->
 <div class="sidebar" data-background-color="dark">
     <div class="sidebar-logo">
         <!-- Logo Header -->
         <div class="logo-header" data-background-color="white">
             <a href="{{ route('dashboard') }}" class="logo">
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
                 <li class="nav-item {{ Route::currentRouteName() === 'dashboard' ? 'active' : '' }}">
                     <a href="{{ route('dashboard') }}" aria-expanded="false">
                         <i class="fas fa-home"></i>
                         <p>Dashboard</p>
                     </a>
                 </li>
                 <li class="nav-section">
                     <span class="sidebar-mini-icon">
                         <i class="fa fa-ellipsis-h"></i>
                     </span>
                     <h4 class="text-section">Applicants</h4>
                 </li>
                 <li
                     class="nav-item {{ Route::currentRouteName() === 'admin.applicants.new_applicants' ? 'active' : '' }}">
                     <a href="{{ route('admin.applicants.new_applicants') }}">
                         <i class="fas fa-users"></i>
                         <p>All Applicants</p>
                     </a>
                 </li>
                 <li
                     class="nav-item {{ Route::currentRouteName() === 'admin.applicants.approved_applicants' ? 'active' : '' }}">
                     <a href="{{ route('admin.applicants.approved_applicants') }}">
                         <i class="fas fa-th-list"></i>
                         <p>Approved Applicants</p>
                     </a>
                 </li>
                 <li
                     class="nav-item {{ Route::currentRouteName() === 'admin.applicants.declined_applicants' ? 'active' : '' }}">
                     <a href="{{ route('admin.applicants.declined_applicants') }}">
                         <i class="fas fa-pen-square"></i>
                         <p>Declined Applicants</p>
                     </a>
                 </li>

                 <li class="nav-section">
                     <span class="sidebar-mini-icon">
                         <i class="fa fa-ellipsis-h"></i>
                     </span>
                     <h4 class="text-section">Content Management</h4>
                 </li>
                 <li
                     class="nav-item {{ in_array(Route::currentRouteName(), ['admin.announcement.admin-announcement', 'admin.announcement.add-announcement', 'admin.announcement.edit-announcement']) ? 'active' : '' }}">
                     <a href="{{ route('admin.announcement.admin-announcement') }}">
                         <i class="fas fa-bullhorn"></i>
                         <p>Announcement</p>
                     </a>
                 </li>

                 <li class="nav-item {{ in_array(Route::currentRouteName(), ['admin.email.email']) ? 'active' : '' }}">
                     <a href="{{ route('admin.email.email') }}">
                         <i class="fas fa-envelope"></i>
                         <p>Email</p>
                     </a>
                 </li>
                 <li
                     class="nav-item {{ in_array(Route::currentRouteName(), ['admin.application-settings']) ? 'active' : '' }}">
                     <a href="{{ route('admin.application-settings') }}">
                         <i class="fas fa-cog"></i>
                         <p>Application Settings</p>
                     </a>
                 </li>
                 <li
                     class="nav-item {{ in_array(Route::currentRouteName(), ['admin.registration']) ? 'active' : '' }}">
                     <a href="{{ route('admin.registration') }}">
                         <i class="fas fa-user-plus"></i>
                         <p>Create Account</p>
                     </a>
                 </li>
             </ul>
         </div>
     </div>
 </div>
 <!-- End Sidebar -->
