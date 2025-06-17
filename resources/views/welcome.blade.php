<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Pengaduan Sekolah</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
      <a class="navbar-brand" href="#">Pengaduan Sekolah</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
            @auth
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ url('home') }}">Dashboard</a>
                </li>
            @endauth
            @guest
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ url('home') }}">Login</a>
                </li>
            @endguest
        </ul>
      </div>
    </div>
  </nav>

  <!-- Hero Section -->
  <section class="bg-light text-dark py-5 text-center">
    <div class="container">
      <h1 class="display-4">Sistem Pengaduan Sekolah</h1>
      <p class="lead">Platform untuk menyampaikan keluhan dan aspirasi demi menciptakan lingkungan sekolah yang lebih baik.</p>
      <a href="{{ url('home') }}" class="btn btn-primary btn-lg">Ajukan Pengaduan</a>
    </div>
  </section>

  <!-- Features Section -->
  <section class="py-5">
    <div class="container text-center">
      <h2 class="mb-4">Fitur Unggulan</h2>
      <div class="row">
        <div class="col-md-4">
          <div class="card mb-4">
            <div class="card-body">
              <h5 class="card-title">Mudah Digunakan</h5>
              <p class="card-text">Sistem kami dirancang agar mudah digunakan oleh siswa, guru, dan pihak sekolah lainnya.</p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card mb-4">
            <div class="card-body">
              <h5 class="card-title">Pengaduan Cepat Tanggap</h5>
              <p class="card-text">Setiap pengaduan akan segera ditindaklanjuti oleh pihak terkait untuk penyelesaian yang cepat.</p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card mb-4">
            <div class="card-body">
              <h5 class="card-title">Aman & Terpercaya</h5>
              <p class="card-text">Data dan identitas Anda terjamin keamanannya. Kami mengutamakan privasi dalam setiap pengaduan.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Call to Action Section -->
  <section class="bg-primary text-white text-center py-5">
    <div class="container">
      <h2>Ingin Mengajukan Pengaduan?</h2>
      <p class="lead">Segera ajukan pengaduan Anda sekarang dan kami akan membantu menyelesaikannya.</p>
      <a href="" class="btn btn-light btn-lg">Ajukan Pengaduan Sekarang</a>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-dark text-white py-4">
    <div class="container text-center">
      <p>&copy; 2024 Pengaduan Sekolah. Semua Hak Cipta Dilindungi.</p>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
