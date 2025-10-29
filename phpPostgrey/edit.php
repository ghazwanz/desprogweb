<?php
require __DIR__ . '/koneksi.php';

$err = '';
$id = (int)($_GET['id'] ?? 0);

if ($id <= 0) {
  http_response_code(400);
  exit('ID tidak valid.');
}

// Ambil data lama
try {
  $res = qparams('SELECT id, nim, nama, email, jurusan FROM public.mahasiswa WHERE id=$1', [$id]);
  $row = pg_fetch_assoc($res);
  if (!$row) {
    http_response_code(404);
    exit('Data tidak ditemukan.');
  }
} catch (Throwable $e) {
  exit('Error: ' . htmlspecialchars($e->getMessage()));
}

$nim = $row['nim'];
$nama = $row['nama'];
$email = $row['email'];
$jurusan = $row['jurusan'];

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
        'UPDATE public.mahasiswa
                   SET nim=$1, nama=$2, email=NULLIF($3, \'\'), jurusan=NULLIF($4, \'\')
                 WHERE id=$5',
        [$nim, $nama, $email, $jurusan, $id]
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
  <title>Ubah Mahasiswa</title>
  <link rel="stylesheet" href="./css/bootstrap.min.css">
</head>

<body>
  <div class="container mt-5">

    <h1>Ubah Mahasiswa</h1>

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
        <input class="form-control" name="nama" value="<?= htmlspecialchars($nama) ?>" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Email (opsional)</label>
        <input class="form-control" name="email" value="<?= htmlspecialchars($email) ?>">
      </div>
      <div class="mb-3">
        <label>Jurusan (opsional)</label>
        <input class="form-control" name="jurusan" value="<?= htmlspecialchars($jurusan) ?>">
      </div>
      <p>
        <button class="btn btn-primary" type="submit">Simpan Perubahan</button>
        <a class="btn btn-danger" href="index.php">Batal</a>
      </p>
    </form>
  </div>
  <script src="./js/bootstrap.bundle.min.js"></script>
</body>

</html>