<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Peta Cabang Toko Suku Cadang</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
    <style>
        body { margin: 0; font-family: sans-serif; }
        #map { height: 100vh; }
    </style>
</head>
<body>
    <div style="display: flex; height: 100vh;">
    <!-- Sidebar Daftar Cabang -->
    <div style="width: 300px; padding: 15px; overflow-y: auto; background: #f8f9fa;">
        <h3>Daftar Cabang</h3>
        <ul style="list-style: none; padding: 0;">
            @foreach($branches as $b)
                <li style="margin-bottom: 10px; padding: 10px; background: white; border-radius: 5px; cursor: pointer; box-shadow: 0 1px 3px rgba(0,0,0,0.1);"
                    onclick="fokusKeCabang({{ $b->latitude }}, {{ $b->longitude }})">
                    <strong>{{ $b->nama }}</strong><br>
                    <small>{{ $b->alamat }}</small>
                </li>
            @endforeach
        </ul>
    </div>

    <!-- Peta -->
    <div id="map" style="flex-grow: 1; height: 100vh;"></div>
</div>

    <button id="btn-near" style="position:absolute; z-index: 1000; top:10px; right:10px; padding: 8px 12px; cursor:pointer;">
    Cabang Terdekat
</button>



    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        const branches = @json($branches);
        const map = L.map('map').setView([-6.2, 106.82], 12);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);



const markers = [];

branches.forEach(b => {
    // Tentukan warna pin berdasarkan jenis (toko = merah, bengkel = hijau)
    const warna = b.jenis === 'bengkel' ? '#28a745' : '#dc3545';

    // Membuat ikon pin kustom menggunakan CSS (bentuk teardrop/pin peta)
    const customIcon = L.divIcon({
        className: 'custom-pin',
        html: `<div style="
            background-color: ${warna}; 
            width: 24px; 
            height: 24px; 
            border-radius: 50% 50% 50% 0; 
            transform: rotate(-45deg); 
            box-shadow: 0 3px 6px rgba(0,0,0,0.4); 
            border: 2px solid #fff;">
        </div>`,
        iconSize: [24, 24],
        iconAnchor: [12, 24],
        popupAnchor: [0, -24]
    });

    // Gunakan L.marker dengan ikon kustom
    const m = L.marker([b.latitude, b.longitude], { icon: customIcon }).addTo(map);

    // Format teks jenis untuk ditampilkan di popup
    const namaJenis = b.jenis === 'bengkel' ? 'Bengkel Resmi' : 'Toko Suku Cadang';

    m.bindPopup('<b>' + b.nama + '</b><br>Jenis: ' + namaJenis + '<br>' + b.alamat);
    markers.push(m);
});

if (markers.length) {
    map.fitBounds(L.featureGroup(markers).getBounds().pad(0.2));
}

L.polygon([
    [-6.20, 106.80], 
    [-6.20, 106.85],
    [-6.15, 106.85], 
    [-6.15, 106.80]
], {
    color: 'purple',
    fillColor: '#f03',
    fillOpacity: 0.3
}).addTo(map).bindPopup('Area Layanan Toko');

function jarakKm(lat1, lon1, lat2, lon2) {
    const R = 6371;
    const rad = d => d * Math.PI / 180;
    const dLat = rad(lat2 - lat1);
    const dLon = rad(lon2 - lon1);
    const a = Math.sin(dLat / 2) ** 2 +
              Math.cos(rad(lat1)) * Math.cos(rad(lat2)) * Math.sin(dLon / 2) ** 2;
    return 2 * R * Math.asin(Math.sqrt(a));
}

document.getElementById('btn-near').addEventListener('click', () => {
    navigator.geolocation.getCurrentPosition(pos => {
        const { latitude, longitude } = pos.coords;
        let best = null;

        branches.forEach((b, i) => {
            const d = jarakKm(latitude, longitude, b.latitude, b.longitude);
            if (!best || d < best.d) best = { d, i };
        });

        L.circleMarker([latitude, longitude], { radius: 8 }).addTo(map)
            .bindPopup('Lokasi Anda');

        const b = branches[best.i];
        markers[best.i]
            .bindPopup('<b>' + b.nama + '</b><br>Jarak: ' + best.d.toFixed(2) + ' km')
            .openPopup();

        map.fitBounds(L.latLngBounds([
            [latitude, longitude], [b.latitude, b.longitude]
        ]).pad(0.3));
    }, () => alert('Lokasi tidak dapat diakses. Periksa izin browser.'));
});

const sampleGeoJSON = {
    "type": "Feature",
    "geometry": {
        "type": "Polygon",
        "coordinates": [
            [
              [106.80, -6.15],
              [106.85, -6.15],
              [106.85, -6.20],
              [106.80, -6.20],
              [106.80, -6.15]
            ]
        ]
    },
    "properties": {
        "name": "Zona Pengiriman Ekspres"
    }
};

L.geoJSON(sampleGeoJSON, {
    style: function (feature) {
        return { color: "#00ff00", weight: 2 };
    },
    onEachFeature: function (feature, layer) {
        if (feature.properties && feature.properties.name) {
            layer.bindPopup(feature.properties.name);
        }
    }
}).addTo(map);

function fokusKeCabang(lat, lng) {
    map.setView([lat, lng], 15); // Geser peta ke koordinat cabang dengan zoom level 15
}
    </script>
    
</body>
</html>