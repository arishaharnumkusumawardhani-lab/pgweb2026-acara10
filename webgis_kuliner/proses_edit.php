<?php
require_once __DIR__ . '/config/koneksi.php';

$id = filter_var($_POST['id'] ?? null, FILTER_VALIDATE_INT);
$jenis = trim($_POST['jenis_usaha'] ?? '');
$nama = trim($_POST['nama_tempat'] ?? '');
$alamat = trim($_POST['alamat'] ?? '');
$kecamatan = trim($_POST['kecamatan'] ?? '');
$longitude = filter_var($_POST['longitude'] ?? null, FILTER_VALIDATE_FLOAT);
$latitude = filter_var($_POST['latitude'] ?? null, FILTER_VALIDATE_FLOAT);

if (!$id || $jenis === '' || $nama === '' || $alamat === '' || $kecamatan === '' ||
    $longitude === false || $latitude === false) {
    die("Data edit tidak valid. <a href='map.php'>Kembali</a>");
}

$stmt = $conn->prepare("UPDATE kuliner SET jenis_usaha=?, nama_tempat=?, alamat=?, kecamatan=?, longitude=?, latitude=? WHERE id=?");
$stmt->bind_param("ssssddi", $jenis, $nama, $alamat, $kecamatan, $longitude, $latitude, $id);

if ($stmt->execute()) {
    header("Location: map.php");
    exit;
}
die("Gagal memperbarui data: " . htmlspecialchars($stmt->error));

