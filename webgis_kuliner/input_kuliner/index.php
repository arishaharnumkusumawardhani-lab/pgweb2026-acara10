<?php
function e($value) { return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8'); }
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Input Data Kuliner</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
<div class="form-container">
    <h2>Input Data Usaha Kuliner</h2>
    <form action="../proses_input.php" method="POST">
        <div class="field"><label>Jenis Usaha</label><input name="jenis_usaha" required maxlength="100"></div>
        <div class="field"><label>Nama Tempat</label><input name="nama_tempat" required maxlength="150"></div>
        <div class="field"><label>Alamat</label><textarea name="alamat" required></textarea></div>
        <div class="field"><label>Kecamatan</label><input name="kecamatan" required maxlength="100"></div>
        <div class="field"><label>Longitude</label><input type="number" step="any" name="longitude" required></div>
        <div class="field"><label>Latitude</label><input type="number" step="any" name="latitude" required></div>
        <div class="actions">
            <button type="submit">Simpan Data</button>
            <a href="../map.php">Kembali</a>
        </div>
    </form>
</div>
</body>
</html>
