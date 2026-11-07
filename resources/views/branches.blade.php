<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Jaringan Cabang - Cirebon Motor Parts</title>
    <!-- Google Fonts Inter & Tailwind CSS CDN -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 antialiased min-h-screen py-10 px-4 sm:px-6 lg:px-8">

    <div class="max-w-6xl mx-auto">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8 gap-4">
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold tracking-tight text-slate-900">Jaringan Cabang Cirebon</h1>
                <p class="text-sm text-slate-500 mt-1">Kelola dan pantau seluruh titik lokasi toko suku cadang serta bengkel resmi.</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('branches.create') }}" class="inline-flex items-center justify-center px-4 py-2.5 rounded-xl bg-blue-600 text-white text-sm font-semibold shadow-sm hover:bg-blue-500 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-2">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"></path></svg>
                    Tambah Cabang
                </a>
                <a href="{{ url('/peta') }}" class="inline-flex items-center justify-center px-4 py-2.5 rounded-xl bg-emerald-600 text-white text-sm font-semibold shadow-sm hover:bg-emerald-500 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-emerald-600 focus:ring-offset-2">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path></svg>
                    Lihat Peta Interaktif
                </a>
            </div>
        </div>

        <!-- Main Card Table Container -->
        <div class="bg-white rounded-2xl shadow-xl shadow-slate-100 border border-slate-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/75 border-b border-slate-100 text-xs font-semibold uppercase tracking-wider text-slate-500">
                            <th class="py-4 px-6">No</th>
                            <th class="py-4 px-6">Nama Cabang</th>
                            <th class="py-4 px-6">Kategori</th>
                            <th class="py-4 px-6">Alamat Lengkap</th>
                            <th class="py-4 px-6">Telepon</th>
                            <th class="py-4 px-6">Koordinat (Lat, Lng)</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        @forelse($branches as $index => $b)
                            <tr class="hover:bg-slate-50/80 transition-colors duration-150">
                                <td class="py-4 px-6 font-medium text-slate-400">{{ $index + 1 }}</td>
                                <td class="py-4 px-6 font-semibold text-slate-900">{{ $b->nama }}</td>
                                <td class="py-4 px-6">
                                    @if($b->jenis == 'bengkel')
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700 border border-emerald-200/60">
                                            <span class="w-1.5 h-1.5 mr-1.5 rounded-full bg-emerald-600"></span> Bengkel Resmi
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-rose-50 text-rose-700 border border-rose-200/60">
                                            <span class="w-1.5 h-1.5 mr-1.5 rounded-full bg-rose-600"></span> Toko Suku Cadang
                                        </span>
                                    @endif
                                </td>
                                <td class="py-4 px-6 text-slate-600 max-w-xs truncate">{{ $b->alamat }}</td>
                                <td class="py-4 px-6 text-slate-600 font-mono text-xs">{{ $b->telepon ?? '-' }}</td>
                                <td class="py-4 px-6 text-slate-500 font-mono text-xs">
                                    <span class="bg-slate-100 px-2 py-1 rounded-md text-slate-600 border border-slate-200/50">
                                        {{ $b->latitude }}, {{ $b->longitude }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-12 text-center text-slate-400">
                                    <svg class="mx-auto h-12 w-12 text-slate-300 mb-3" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                                    Belum ada data cabang yang tersimpan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>