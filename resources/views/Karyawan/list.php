<?php
$conn = new mysqli("localhost", "root", "", "db_karyawan");

// Jika ada pencarian
$cari = $_GET['cari'] ?? '';
if ($cari) {
    $stmt = $conn->prepare("SELECT * FROM karyawan WHERE nama LIKE ? OR username LIKE ?");
    $like = "%$cari%";
    $stmt->bind_param("ss", $like, $like);
    $stmt->execute();
    $karyawan = $stmt->get_result();
} else {
    $karyawan = $conn->query("SELECT * FROM karyawan");
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Data Karyawan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-4">
  <div class="text-center mb-4">
    <h2 class="fw-bold">Data Karyawan</h2>
  </div>

  <div class="mb-3">
    <form method="get" class="d-flex">
      <input type="text" class="form-control me-2" name="cari" placeholder="Cari karyawan" value="<?= htmlspecialchars($cari) ?>">
      <button class="btn btn-primary">Cari</button>
    </form>
  </div>

  <div class="mb-3 text-end">
    <a href="form_karyawan.php" class="btn btn-success">Input Karyawan</a>
  </div>

  <table class="table table-bordered text-center">
    <thead class="table-primary">
      <tr>
        <th>Nama Lengkap</th>
        <th>Username</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php if ($karyawan->num_rows > 0): ?>
        <?php while($row = $karyawan->fetch_assoc()): ?>
        <tr>
          <td><?= htmlspecialchars($row['nama']) ?></td>
          <td>@<?= htmlspecialchars($row['username']) ?></td>
          <td>
            <a href="form_karyawan.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
            <a href="proses_karyawan.php?hapus=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</a>
          </td>
        </tr>
        <?php endwhile; ?>
      <?php else: ?>
        <tr><td colspan="3">Data tidak ditemukan</td></tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>

</body>
</html>
