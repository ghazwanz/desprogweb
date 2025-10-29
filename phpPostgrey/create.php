<?php
require __DIR__ . '/koneksi.php';

$err = $ok = '';
$nim = $nama = $email = $jurusan = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nim     = trim($_POST['nim'] ?? '');
  $nama    = trim($_POST['nama'] ?? '');
  $email   = trim($_POST['email'] ?? '');
  $jurusan = trim($_POST['jurusan'] ?? '');

  if ($nim === '' || $nama === '') {
    $err = 'NIM dan Nama wajib diisi.';
  } elseif ($email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $err = 'Format email tidak valid.';
  } else {
    try {
      qparams(
        'INSERT INTO public.mahasiswa (nim, nama, email, jurusan) VALUES ($1, $2, NULLIF($3, \'\'), NULLIF($4, \'\'))',
        [$nim, $nama, $email, $jurusan]
      );
      header('Location: index.php');
      exit;
    } catch (Throwable $e) {
      $err = $e->getMessage();
    }
  }
}
?>
<!doctype html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <title>Tambah Mahasiswa</title>
  <link rel="stylesheet" href="./css/bootstrap.min.css">
</head>

<body>
  <div class="container mt-5">

    <h1>Tambah Mahasiswa</h1>
  
    <?php if ($err): ?>
      <div class="alert alert-danger alert-dismissible">
        <?= htmlspecialchars($err) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php endif; ?>
  
    <form method="post">
      <div class="mb-3">
        <label class="form-label">NIM</label>
        <input name="nim" class="form-control" value="<?= htmlspecialchars($nim) ?>" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Nama</label>
        <input name="nama" class="form-control" value="<?= htmlspecialchars($nama) ?>" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Email (opsional)</label>
        <input name="email" class="form-control" value="<?= htmlspecialchars($email) ?>" placeholder="nama@kampus.ac.id">
      </div>
      <div class="mb-3">
        <label class="form-label">Jurusan (opsional)</label>
        <input name="jurusan" class="form-control" value="<?= htmlspecialchars($jurusan) ?>">
      </div>
  
      <div>
        <button class="btn btn-primary" type="submit">Simpan</button>
        <a class="btn btn-danger" href="index.php">Kembali</a>
      </div>
    </form>
  </div>
  <script src="./js/bootstrap.bundle.min.js"></script>
</body>

</html>