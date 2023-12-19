


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
              <!-- Table with stripped rows -->
              <button type="button" class="btn btn-primary" style="font-size: 12px; width: 120px; margin-bottom: 10px;" onclick="location.href='{{ route('admin.announcement.add-announcement') }}'">Add</button>

              <table class="table datatable">
                @if(session('success'))
                    <div class="alert alert-success" style="margin: 0 auto; text-align: center; margin-bottom: 10px; width: 400px;">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger" style="margin: 0 auto; text-align: center; margin-bottom: 10px; width: 400px;">
                        {{ session('error') }}
                    </div>
                @endif
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
                            <a  class="btn" style="font-size: 12px; width: 80px; margin-bottom: 5px; background-color: #2EB85C; color: #fff;">Edit</a>
                          </div>
                          <div>
                              <form action="{{ route('delete.announcement', ['id' => $announcement->id]) }}" method="post">
                                  @csrf
                                  @method('DELETE')
                                  <button type="submit" class="btn" style="font-size: 12px; width: 80px; background-color: #E55353; color: #fff;" >Delete</button>
                              </form>
                          </div>
                      </td>
                  </tr>
                  @endforeach
              </tbody>
              </table>
              <!-- End Table with stripped rows -->
            </div>
          </div>

        </div>
      </div>
    </section>
  </main><!-- End #main -->
     
  @include('admin-partials.footer')

</body>
</html>
