<?php
require_once __DIR__ . '/config/koneksi.php';

$id = filter_var($_GET['id'] ?? null, FILTER_VALIDATE_INT);
if (!$id) {
    die("ID data tidak valid. <a href='map.php'>Kembali</a>");
}

$stmt = $conn->prepare("DELETE FROM kuliner WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: map.php");
    exit;
}
die("Gagal menghapus data: " . htmlspecialchars($stmt->error));

