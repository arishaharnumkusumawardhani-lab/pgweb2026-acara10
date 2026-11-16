<?php
require_once __DIR__ . '/config/koneksi.php';

$jenis = trim($_POST['jenis_usaha'] ?? '');
$nama = trim($_POST['nama_tempat'] ?? '');
$alamat = trim($_POST['alamat'] ?? '');
$kecamatan = trim($_POST['kecamatan'] ?? '');
$longitude = filter_var($_POST['longitude'] ?? null, FILTER_VALIDATE_FLOAT);
$latitude = filter_var($_POST['latitude'] ?? null, FILTER_VALIDATE_FLOAT);

if ($jenis === '' || $nama === '' || $alamat === '' || $kecamatan === '' ||
    $longitude === false || $latitude === false) {
    die("Semua kolom wajib diisi dengan data yang valid. <a href='input_kuliner/index.php'>Kembali</a>");
}

$stmt = $conn->prepare("INSERT INTO kuliner (jenis_usaha, nama_tempat, alamat, kecamatan, longitude, latitude) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssdd", $jenis, $nama, $alamat, $kecamatan, $longitude, $latitude);

if ($stmt->execute()) {
    header("Location: map.php");
    exit;
}
die("Gagal menyimpan data: " . htmlspecialchars($stmt->error));

