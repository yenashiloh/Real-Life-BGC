<title>{{ $title }}</title>
  @include('admin-partials.header')
  @include('admin-partials.sidebar')

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Announcement</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Announcement</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Add Announcement</h5>
              <button type="button" class="btn btn-primary" style="font-size: 12px; width: 120px; margin-bottom: 10px;" onclick="location.href='{{ route('admin.announcement.add-announcement') }}'">Add</button>
              <table class="table datatable">
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
                      <td>{!! html_entity_decode(strip_tags($announcement->caption)) !!}</td>
                      <td>
                          <div>
                            <button type="button" onclick="location.href='{{ route('admin.announcement.edit-announcement', ['id' => $announcement->id]) }}'" class="btn" style="font-size: 12px; width: 80px; margin-bottom: 5px; background-color: #2EB85C; color: #fff;">Edit</button>
                          </div>
                          <div>
                              <form action="{{ route('delete.announcement', ['id' => $announcement->id]) }}" method="post" id="deleteForm_{{ $announcement->id }}">
                                @csrf
                                @method('DELETE')
                                <button type="button" onclick="confirmDelete('{{ $announcement->id }}')" class="btn" style="font-size: 12px; width: 80px; background-color: #E55353; color: #fff;">Delete</button>
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
    </section>
  </main><!-- End #main -->
     
  @include('admin-partials.footer')
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
