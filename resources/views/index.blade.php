<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ $konten['meta_title'] }}</title>

  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

  <style>
    html,
    body {
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', sans-serif;
    }

    h1,
    h2 {
      font-size: 1.25rem;
    }

    h3 {
      font-size: 1rem
    }

    h1,
    h2,
    h3 {
      font-weight: bold;
    }

    .wrap_avatar {
      border-radius: 50%;
      width: 75px;
      height: 75px;
      overflow: hidden;
    }

    .wrap_avatar img {
      max-width: 100%;
    }

    .wrap_candidate_info p {
      margin-bottom: .5rem;
    }

    .wrap_candidate_info .candidate_name {
      max-width: 75%;
    }

    .wrap_province_table .table {
      border-color: #cccccc;
    }
  </style>
</head>

<body>
  <!-- Start Overall Resume -->
  <section class="py-5 container">
    <div class="row pt-5 justify-content-center">
      <div class="col-lg-8 col-md-12">
        <div class="wrap_title">
          <h1 class="text-center">{{ $konten['judul_utama'] }}</h1>
        </div>
      </div>
      <div class="col-md-12 mt-5">
        <div class="wrap_overall_resume">
          <div class="row justify-content-center">
            <!-- Start Candidate -->
            @foreach($data['resume_terkini_seluruh_indonesia'] as $row)
            <div class="col-lg-3 mt-3">
              <div class="wrap_candidate">
                <div class="card">
                  <div class="card-body d-flex flex-column align-items-center">
                    <div class="d-flex">
                      <div class="wrap_avatar">
                        <img src="{{ uploader($row['foto_capres']) }}" alt="{{ $row['nama'] }}">
                      </div>
                      <div class="wrap_avatar ms-2">
                        <img src="{{ uploader($row['foto_cawapres']) }}" alt="{{ $row['nama'] }}">
                      </div>
                    </div>
                    <div class="wrap_candidate_info py-3 text-center d-flex flex-column align-items-center">
                      <p class="fw-bold candidate_name">{{ $row['nama'] }}</p>
                      <p class="party_name">{{ $row['partai'] }}</p>
                      <p class="ballot">{{ $konten['jumlah_suara'] }} {{ $row['jumlah_suara'] }}</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
            <!-- End Candidate -->
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Start Overall Resume -->

  <!-- Start Resume By Province -->
  <section class="py-4 mt-5 container bg-light">
    <div class="wrap_province_resume">
      <div class="row">
        <div class="col-md-12 mt-3">
          <div class="wrap_sub_title">
            <h2 class="text-center">{{ $konten['judul_per_provinsi'] }}</h2>
          </div>
        </div>

        <div class="col-md-12 mt-5">
          <div class="wrap_province_table">
            <div class="row">
              @foreach($data['kandidat_pemilihan'] as $index => $row)
              <div class="col-lg-6 mt-3">
                <div class="wrap_province_ballot">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="wrap_candidate_name">
                        <h3>{{ $index + 1 }}. {{ $row['nama'] }}</h3>
                      </div>
                    </div>
                    <div class="col-md-12 mt-3">
                      <div class="wrap_province_table table-responsive">
                        <table class="table table-hover table-bordered">
                          <thead class="bg-light">
                            <tr>
                              <th>WILAYAH</th>
                              <th>PEROLEHAN SUARA</th>
                            </tr>
                          </thead>

                          <tbody class="bg-white">
                            @foreach(cariResumeProvinsi($row['id'], $data['resume_terkini_provinsi']) as $row)
                            <tr>
                              <td>{{ $row['provinsi'] }}</td>
                              <td>{{ $row['jumlah_suara'] }}</td>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End Resume By Province -->

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>