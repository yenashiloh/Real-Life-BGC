


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
              <button type="button" class="btn btn-secondary" style="font-size: 12px; width: 120px; margin-bottom: 10px;">Add</button>
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Caption</th>
                    <th scope="col">Images</th>
                    <th scope="col">Action</th>
  
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">1</th>
                    <td>Shiloh</td>
                    <td>Eugenio</td>
                   
                    <td>  <button type="button" class="btn" style="background-color: #2EB85C; color: white; font-size: 12px; width: 80px;">View</button> </td>
                  </tr>
                 
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
