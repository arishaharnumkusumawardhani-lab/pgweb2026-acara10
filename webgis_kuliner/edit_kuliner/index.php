<?php
require_once __DIR__ . '/../config/koneksi.php';

if (!isset($_GET['id']) || !ctype_digit((string)$_GET['id'])) {
    die("ID data tidak valid.");
}
$id = (int)$_GET['id'];

$stmt = $conn->prepare("SELECT * FROM kuliner WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$stmt->close();

if (!$row) {
    die("Data kuliner tidak ditemukan.");
}
function e($value) { return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8'); }
$conn->close();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Data Kuliner</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
<div class="form-container">
    <h2>Edit Data Usaha Kuliner</h2>
    <form action="../proses_edit.php" method="POST">
        <input type="hidden" name="id" value="<?= (int)$row['id'] ?>">
        <div class="field"><label>Jenis Usaha</label><input name="jenis_usaha" required maxlength="100" value="<?= e($row['jenis_usaha']) ?>"></div>
        <div class="field"><label>Nama Tempat</label><input name="nama_tempat" required maxlength="150" value="<?= e($row['nama_tempat']) ?>"></div>
        <div class="field"><label>Alamat</label><textarea name="alamat" required><?= e($row['alamat']) ?></textarea></div>
        <div class="field"><label>Kecamatan</label><input name="kecamatan" required maxlength="100" value="<?= e($row['kecamatan']) ?>"></div>
        <div class="field"><label>Longitude</label><input type="number" step="any" name="longitude" required value="<?= e($row['longitude']) ?>"></div>
        <div class="field"><label>Latitude</label><input type="number" step="any" name="latitude" required value="<?= e($row['latitude']) ?>"></div>
        <div class="actions">
            <button type="submit">Simpan Perubahan</button>
            <a href="../map.php">Batal</a>
        </div>
    </form>
</div>
</body>
</html>
