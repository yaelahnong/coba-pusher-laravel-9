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
          <div id="resumeTerkiniSeluruhIndonesia" class="row justify-content-center">
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
            <div class="row" id="resumeTerkiniProvinsi"></div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End Resume By Province -->

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

  <script>
    window.resumeTerkiniSeluruhIndonesia = <?php echo json_encode($data['resume_terkini_seluruh_indonesia']); ?>;
    window.kandidatPemilihan = <?php echo json_encode($data['kandidat_pemilihan']); ?>;
    window.resumeTerkiniProvinsi = <?php echo json_encode($data['resume_terkini_provinsi']); ?>;
    window.kontenJumlahSuara = <?php echo json_encode($konten['jumlah_suara']); ?>;
  </script>

  @vite(['resources/js/jumlahsuara.js'])
</body>

</html>