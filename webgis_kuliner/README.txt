WEB GIS SEBARAN USAHA KULINER KOTA BANDUNG

CARA MEMASANG:
1. Ekstrak folder webgis_kuliner ke C:\xampp\htdocs\
2. Jalankan Apache dan MySQL dari XAMPP.
3. Buka http://localhost/phpmyadmin
4. Pilih Import, lalu pilih database/kuliner.sql dari folder project.
5. Jalankan http://localhost/webgis_kuliner/map.php

KONFIGURASI:
- Database: kuliner_db
- Tabel: kuliner
- Koneksi: config/koneksi.php
- Username MySQL default: root
- Password MySQL default: kosong

DATA:
File SQL berisi tiga data awal yang diambil dari dump SQL yang diberikan.
Jangan mengimpor file SQL berulang kali ke tabel yang sudah memiliki data,
agar data awal tidak terduplikasi.

CATATAN:
Leaflet dan plugin pengukuran memerlukan koneksi internet untuk memuat
library dan basemap. Jika peta tidak tampil, periksa koneksi internet.
