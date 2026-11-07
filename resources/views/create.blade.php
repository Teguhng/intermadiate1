<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Cabang Baru T-ONE</title>
    <!-- Google Fonts Inter & Tailwind CSS CDN -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
    <style>
        body { font-family: 'Inter', sans-serif; }
        #map { height: 420px; width: 100%; border-radius: 1rem; z-index: 10; }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 antialiased min-h-screen py-10 px-4 sm:px-6 lg:px-8">

    <div class="max-w-3xl mx-auto">
        <!-- Header & Back Button -->
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold tracking-tight text-slate-900">Tambah Cabang Baru</h1>
                <p class="text-sm text-slate-500 mt-1">Daftarkan titik lokasi toko atau bengkel resmi baru ke dalam sistem.</p>
            </div>
            <a href="{{ route('branches.index') }}" class="inline-flex items-center text-sm font-medium text-slate-600 hover:text-slate-900 transition-colors">
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"></path></svg>
                Kembali
            </a>
        </div>

        <!-- Main Form Card -->
        <div class="bg-white rounded-2xl shadow-xl shadow-slate-100 border border-slate-100 p-6 sm:p-8">
            <form action="{{ route('branches.store') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Nama Cabang -->
                <div>
                    <label for="nama" class="block text-sm font-semibold text-slate-700 mb-2">Nama Cabang</label>
                    <input type="text" id="nama" name="nama" required 
                           class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50/50 text-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:bg-white transition-all"
                           placeholder="Contoh: Cabang Cirebon Perjuangan">
                </div>

                <!-- Kategori / Jenis -->
                <div>
                    <label for="jenis" class="block text-sm font-semibold text-slate-700 mb-2">Kategori Cabang</label>
                    <select id="jenis" name="jenis" required 
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50/50 text-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:bg-white transition-all">
                        <option value="">-- Pilih Kategori --</option>
                        <option value="toko">Toko Suku Cadang</option>
                        <option value="bengkel">Bengkel Resmi</option>
                    </select>
                </div>

                <!-- Alamat Lengkap -->
                <div>
                    <label for="alamat" class="block text-sm font-semibold text-slate-700 mb-2">Alamat Lengkap</label>
                    <textarea id="alamat" name="alamat" rows="3" required 
                              class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50/50 text-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:bg-white transition-all resize-none"
                              placeholder="Masukkan alamat lengkap lokasi..."></textarea>
                </div>

                <!-- Nomor Telepon -->
                <div>
                    <label for="telepon" class="block text-sm font-semibold text-slate-700 mb-2">Nomor Telepon</label>
                    <input type="text" id="telepon" name="telepon" 
                           class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50/50 text-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:bg-white transition-all font-mono"
                           placeholder="Contoh: (0231) 123456">
                </div>

                <!-- Latitude & Longitude Grid (Bisa diketik manual) -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="latitude" class="block text-sm font-semibold text-slate-700 mb-2">Latitude</label>
                        <input type="text" id="latitude" name="latitude" required 
                               class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-slate-900 text-sm font-mono focus:outline-none focus:ring-2 focus:ring-blue-600 focus:bg-white transition-all"
                               placeholder="Contoh: -6.7056000">
                    </div>
                    <div>
                        <label for="longitude" class="block text-sm font-semibold text-slate-700 mb-2">Longitude</label>
                        <input type="text" id="longitude" name="longitude" required 
                               class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-slate-900 text-sm font-mono focus:outline-none focus:ring-2 focus:ring-blue-600 focus:bg-white transition-all"
                               placeholder="Contoh: 108.5574000">
                    </div>
                </div>

                <!-- Peta Interaktif -->
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Pilih Titik Lokasi pada Peta</label>
                    <p class="text-xs text-slate-500 mb-3">Klik di peta untuk otomatis mengisi koordinat, atau ketik koordinat secara manual di atas.</p>
                    <div class="border border-slate-200 rounded-2xl p-1 bg-slate-50">
                        <div id="map"></div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="pt-4">
                    <button type="submit" 
                            class="w-full py-3.5 px-6 rounded-xl bg-blue-600 text-white font-semibold text-sm shadow-md hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-2 transition-all">
                        Simpan Data Cabang
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        // Inisialisasi peta berpusat di Cirebon
        const map = L.map('map').setView([-6.7056, 108.5574], 13);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        let currentMarker = null;

        function updateMarker(lat, lng) {
            const parsedLat = parseFloat(lat);
            const parsedLng = parseFloat(lng);

            if (!isNaN(parsedLat) && !isNaN(parsedLng)) {
                if (currentMarker) {
                    currentMarker.setLatLng([parsedLat, parsedLng]);
                } else {
                    currentMarker = L.marker([parsedLat, parsedLng]).addTo(map)
                        .bindPopup('Titik Lokasi Cabang')
                        .openPopup();
                }
                map.setView([parsedLat, parsedLng], 15);
            }
        }

        // 1. Event klik pada peta (mengisi input otomatis)
        map.on('click', function(e) {
            const lat = e.latlng.lat.toFixed(7);
            const lng = e.latlng.lng.toFixed(7);

            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = lng;

            updateMarker(lat, lng);
        });

        // 2. Event ketik manual pada input (menggeser pin di peta secara otomatis)
        const latInput = document.getElementById('latitude');
        const lngInput = document.getElementById('longitude');

        function handleManualInput() {
            const lat = latInput.value;
            const lng = lngInput.value;
            updateMarker(lat, lng);
        }

        latInput.addEventListener('input', handleManualInput);
        lngInput.addEventListener('input', handleManualInput);
    </script>
</body>
</html>