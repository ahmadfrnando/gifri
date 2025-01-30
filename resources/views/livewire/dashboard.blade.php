<div class="max-w-7xl mx-auto p-6">
    <h1 class="text-2xl font-semibold mb-4">Dashboard</h1>

    <!-- Statistik -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <!-- Total Surat Masuk -->
        <div class="bg-blue-500 text-white p-4 rounded-lg shadow-md">
            <h2 class="text-lg font-semibold">Surat Masuk</h2>
            <p class="text-3xl font-bold">{{ $totalSuratMasuk }}</p>
        </div>

        <!-- Total Surat Keluar -->
        <div class="bg-green-500 text-white p-4 rounded-lg shadow-md">
            <h2 class="text-lg font-semibold">Surat Keluar</h2>
            <p class="text-3xl font-bold">{{ $totalSuratKeluar }}</p>
        </div>

        <!-- Total Guru -->
        <div class="bg-yellow-500 text-white p-4 rounded-lg shadow-md">
            <h2 class="text-lg font-semibold">Total Guru</h2>
            <p class="text-3xl font-bold">{{ $totalGuru }}</p>
        </div>
    </div>

    <!-- Surat Terbaru -->
    <div class="bg-white p-4 rounded-lg shadow-md">
        <h2 class="text-lg font-semibold mb-2">Surat Terbaru</h2>
        <ul>
            @foreach($suratTerbaru as $surat)
                <li class="flex justify-between border-b py-2">
                    <span>{{ $surat->nama_surat }} ({{ $surat->jenis }})</span>
                    <a href="#" wire:click.prevent="openViewModal({{ $surat->id }})" class="text-blue-500">Lihat</a>
                </li>
            @endforeach
        </ul>
    </div>

    <!-- Tombol Akses Cepat -->
    <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-4">
        <a href="{{ route('arsip') }}" class="bg-blue-600 text-center text-white p-3 rounded-lg shadow-md hover:bg-blue-700">
            <span>📂 Arsip Surat</span>
        </a>
        <a href="{{ route('guru') }}" class="bg-yellow-500 text-center text-white p-3 rounded-lg shadow-md hover:bg-yellow-600">
            <span>👨‍🏫 Guru</span>
        </a>
    </div>
</div>
