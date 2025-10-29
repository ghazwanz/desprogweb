<?php
require __DIR__ . '/koneksi.php';

// Ambil semua data
$res = q('SELECT id, nim, nama, email, jurusan, to_char(created_at, \'YYYY-MM-DD HH24:MI\') AS created_at
          FROM public.mahasiswa
          ORDER BY id DESC');

$rows = pg_fetch_all($res) ?: [];
?>

<!doctype html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <title>CRUD Mahasiswa (PHP + PostgreSQL)</title>
  <link rel="stylesheet" href="./css/bootstrap.min.css">
</head>

<body>
  <div class="container mt-5">

    <h1>Data Mahasiswa</h1>

    <p><a class="btn btn-primary" href="create.php">+ Tambah Mahasiswa</a></p>

    <table class="table">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">NIM</th>
          <th scope="col">Nama</th>
          <th scope="col">Email</th>
          <th scope="col">Jurusan</th>
          <th scope="col">Dibuat</th>
          <th scope="col">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!$rows): ?>
          <tr>
            <td colspan="7">Belum ada data.</td>
          </tr>
          <?php else: foreach ($rows as $r): ?>
            <tr>
              <td scope="row"><?= htmlspecialchars($r['id']) ?></td>
              <td><?= htmlspecialchars($r['nim']) ?></td>
              <td><?= htmlspecialchars($r['nama']) ?></td>
              <td><?= htmlspecialchars($r['email']) ?></td>
              <!-- karena ada kemungkinan jurusan bernilai NULL maka ditambahkan 
               ?? '', ENT_QUOTES, 'UTF-8' agar tdak error -->
              <td><?= htmlspecialchars($r['jurusan'] ?? '', ENT_QUOTES, 'UTF-8') ?></td>
              <td><?= htmlspecialchars($r['created_at']) ?></td>
              <td class="row-actions">
                <a class="btn btn-sm btn-warning" href="edit.php?id=<?= urlencode($r['id']) ?>">Ubah</a>
                <!-- <form action="delete.php" method="post" style="display:inline" onsubmit="return confirm('Hapus data ini?');">
              <input type="hidden" name="id" value="<?= htmlspecialchars($r['id']) ?>">
              <button class="btn" type="submit">Hapus</button>
            </form> -->
                <a href="#" class="btn btn-sm btn-danger" onclick="if(confirm('Hapus data ini?')) { 
         document.getElementById('deleteForm<?= $r['id'] ?>').submit(); 
     }">Hapus</a>

                <form id="deleteForm<?= $r['id'] ?>" action="delete.php" method="post" style="display:none;">
                  <input type="hidden" name="id" value="<?= htmlspecialchars($r['id']) ?>">
                </form>
              </td>
            </tr>
        <?php endforeach;
        endif; ?>
      </tbody>
    </table>
  </div>
  <script src="./js/bootstrap.bundle.min.js"></script>
</body>

</html>