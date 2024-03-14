<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Announcement</title>
  
    @include('admin-partials.admin-header')
    <style>
      .table-responsive td {
        max-width: 750px; 
        white-space: normal;
        margin-bottom: 10px; /* Adjust the value based on the amount of space you want */
        padding-bottom: 10px;
    }
 
    </style>
  </head>
  <body>
    @include('admin-partials.admin-sidebar')
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">Announcement </h3>  
            </div>
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <button type="button" class="btn btn-success btn-fw" style="font-size: 12px; margin-bottom: 10px;" onclick="location.href='{{ route('admin.announcement.add-announcement') }}'">Add</button>
                <br>
                <table class="table datatable table-responsive">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Title</th>
                      <th scope="col">Content</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                        $count = 1;
                    @endphp
                    @foreach($announcements as $announcement)
                    <tr>
                        <th scope="row">{{ $count++ }}</th>
                        <td>{{ $announcement->title }}</td> 
                        <td class="announcement-caption">{!! html_entity_decode(strip_tags($announcement->caption)) !!}</td>
                        <td>
                            <div>
                              <button type="button" onclick="location.href='{{ route('admin.announcement.edit-announcement', ['id' => $announcement->id]) }}'" class="btn btn-primary p-2 btn-fw" >Edit</button>
                            </div>
                            <div>
                                <form action="{{ route('delete.announcement', ['id' => $announcement->id]) }}" method="post" id="deleteForm_{{ $announcement->id }}">
                                  @csrf
                                  @method('DELETE')
                                  <button type="button" onclick="confirmDelete('{{ $announcement->id }}')" class="btn btn-danger p-2 btn-fw mt-1">Delete</button>
                              </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                </table>
              </div>
            </div>

          </div>
        </div>

         <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="../assets-new-admin/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="../assets-new-admin/js/off-canvas.js"></script>
    <script src="../assets-new-admin/js/misc.js"></script>
      <!-- Vendor JS Files -->
  <script src="../assets-admin/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="../assets-admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <script src="../assets-admin/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="../assets-admin/vendor/tinymce/tinymce.min.js"></script>
  <script src="../assets-admin/vendor/php-email-form/validate.js"></script>
  <script src="../assets-admin/tinymce/tinymce.min.js"></script>
 
  <script src="../assets-admin/vendor/chart.js/chart.umd.js"></script>
  <script src="../assets-admin/vendor/echarts/echarts.min.js"></script>
  <script src="../assets-admin/vendor/quill/quill.min.js"></script>

  <!-- Template Main JS File -->
  <script src="../assets-admin/js/main.js"></script>
    
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: 'Once deleted, you will not be able to recover.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Deleted!',
                    text: 'The announcement has been deleted.',
                    icon: 'success',
                    showConfirmButton: true 
                }).then(() => {
                    document.getElementById('deleteForm_' + id).submit();
                });
            }
        });
    }
</script>
</body>
</html>
