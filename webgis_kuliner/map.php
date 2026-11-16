<?php
require_once __DIR__ . '/config/koneksi.php';

$result = $conn->query("SELECT id, jenis_usaha, nama_tempat, alamat, kecamatan, longitude, latitude FROM kuliner ORDER BY id ASC");
if (!$result) {
    die("Gagal mengambil data: " . $conn->error);
}
$kuliner = [];
while ($row = $result->fetch_assoc()) {
    $kuliner[] = $row;
}
function e($value) {
    return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Web GIS Sebaran Usaha Kuliner Kota Bandung</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet-measure@3.1.0/dist/leaflet-measure.css">
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <h2>Web GIS Sebaran Usaha Kuliner Kota Bandung</h2>
    <div id="map"></div>

    <div class="table-container">
        <a href="input_kuliner/index.php" class="btn">+ Input Data Baru</a>
        <?php if (count($kuliner) > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>No</th><th>Jenis Usaha</th><th>Nama Tempat</th>
                    <th>Alamat</th><th>Kecamatan</th><th>Longitude</th>
                    <th>Latitude</th><th colspan="2">Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($kuliner as $i => $row): ?>
                <tr>
                    <td><?= $i + 1 ?></td>
                    <td><?= e($row['jenis_usaha']) ?></td>
                    <td><?= e($row['nama_tempat']) ?></td>
                    <td><?= e($row['alamat']) ?></td>
                    <td><?= e($row['kecamatan']) ?></td>
                    <td><?= e($row['longitude']) ?></td>
                    <td><?= e($row['latitude']) ?></td>
                    <td><a class="btn-danger" href="delete_kuliner.php?id=<?= (int)$row['id'] ?>" onclick="return confirm('Yakin hapus data ini?')">Hapus</a></td>
                    <td><a class="btn-edit" href="edit_kuliner/index.php?id=<?= (int)$row['id'] ?>">Edit</a></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <?php else: ?>
            <p class="notice">Data kuliner belum tersedia. Klik Input Data Baru untuk menambahkan data.</p>
        <?php endif; ?>
    </div>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/leaflet-measure@3.1.0/dist/leaflet-measure.min.js"></script>
    <script>
        const map = L.map('map').setView([-6.914744, 107.609810], 13);

        const osm = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19, attribution: '&copy; OpenStreetMap'
        });
        const esri = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
            attribution: 'Tiles &copy; Esri'
        });

        osm.addTo(map);

        const kulinerLayerGroup = L.layerGroup().addTo(map);
        const dbData = <?= json_encode($kuliner, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ?>;

        dbData.forEach(item => {
            const lat = Number(item.latitude);
            const lng = Number(item.longitude);
            if (Number.isFinite(lat) && Number.isFinite(lng)) {
                const popup = '<b>' + escapeHtml(item.nama_tempat) + '</b><br>' +
                    'Jenis: ' + escapeHtml(item.jenis_usaha) + '<br>' +
                    'Kecamatan: ' + escapeHtml(item.kecamatan) + '<br>' +
                    'Alamat: ' + escapeHtml(item.alamat);
                L.marker([lat, lng]).bindPopup(popup).addTo(kulinerLayerGroup);
            }
        });

        function escapeHtml(value) {
            return String(value).replace(/[&<>"']/g, char => ({
                '&': '&amp;', '<': '&lt;', '>': '&gt;',
                '"': '&quot;', "'": '&#039;'
            })[char]);
        }

        L.control.layers(
            { 'OpenStreetMap': osm, 'Esri Imagery': esri },
            { 'Sebaran Kuliner': kulinerLayerGroup },
            { collapsed: false }
        ).addTo(map);

        L.control.scale({ maxWidth: 150, position: 'bottomright', imperial: false }).addTo(map);

        if (L.Control.Measure) {
            new L.Control.Measure({
                position: 'topleft',
                primaryLengthUnit: 'meters',
                secondaryLengthUnit: 'kilometers',
                primaryAreaUnit: 'sqmeters',
                activeColor: '#007bff',
                completedColor: '#28a745'
            }).addTo(map);
        }

        if (dbData.length > 0) {
            const bounds = dbData
                .map(item => [Number(item.latitude), Number(item.longitude)])
                .filter(point => Number.isFinite(point[0]) && Number.isFinite(point[1]));
            if (bounds.length > 0) map.fitBounds(bounds, { padding: [30, 30], maxZoom: 14 });
        }
    </script>
</body>
</html>
<?php $conn->close(); ?>
