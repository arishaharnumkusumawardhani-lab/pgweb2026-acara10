CREATE DATABASE IF NOT EXISTS kuliner_db
  CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE kuliner_db;

CREATE TABLE IF NOT EXISTS kuliner (
  id INT(11) NOT NULL AUTO_INCREMENT,
  jenis_usaha VARCHAR(100) NOT NULL,
  nama_tempat VARCHAR(150) NOT NULL,
  alamat TEXT NOT NULL,
  kecamatan VARCHAR(100) NOT NULL,
  longitude DOUBLE NOT NULL,
  latitude DOUBLE NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data awal sesuai file SQL yang diberikan.
-- Jika tabel sudah berisi data, jangan jalankan INSERT ini berulang kali.
INSERT INTO kuliner
(id, jenis_usaha, nama_tempat, alamat, kecamatan, longitude, latitude)
VALUES
(1, 'Resto (Rumah Makan)', 'Bebek Kalio Bang Azka',
 'Jl. Dipati Ukur No.29-31, Lebakgede, Kec. Coblong',
 'Coblong kanan', 107.618429805, -6.8637514722),
(2, 'Cafe', 'Kopi Janji Jiwa',
 'Istana Plaza, Pasirkaliki, Kec. Cicendo',
 'Cicendo', 107.59671, -6.90488),
(3, 'Resto (Rumah Makan)', 'NASI GORENG BAYU GRUP',
 'Jl. Garuda No.106, Garuda, Kec. Andir',
 'Andir', 107.578276508, -6.90798840612);
