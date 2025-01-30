<div class="max-w-6xl mx-auto bg-white shadow-md rounded-lg p-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold text-gray-700 flex items-center">
            <x-heroicon-o-users class="w-6 h-6 mr-2 text-blue-600" /> Daftar Guru
        </h2>
        <button wire:click="openModal" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 flex items-center">
            <x-heroicon-o-plus-circle class="w-5 h-5 mr-1" /> Tambah Guru
        </button>
    </div>

    <!-- Flash Message -->
    @if (session()->has('message'))
    <div class="bg-green-500 text-white p-2 rounded mb-2 flex items-center">
        <x-heroicon-o-check-circle class="w-5 h-5 mr-2" /> {{ session('message') }}
    </div>
    @endif

    <!-- Pencarian & Filter -->
    <div class="flex space-x-4 mb-4">
        <input type="text" wire:model="search" placeholder="Cari Nama Guru..." class="border p-2 rounded-lg w-full">

        <select wire:model="filterJabatan" class="border px-4 py-2 rounded-lg">
            <option value="">Filter Jabatan</option>
            @foreach($jabatans as $jabatan)
            <option value="{{ $jabatan->id }}">{{ $jabatan->nama_jabatan }}</option>
            @endforeach
        </select>

        <select wire:model="filterMapel" class="border p-2 rounded-lg">
            <option value="">Filter Mapel</option>
            @foreach($mapels as $mapel)
            <option value="{{ $mapel->id }}">{{ $mapel->nama_mapel }}</option>
            @endforeach
        </select>
    </div>

    <!-- Tabel -->
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300">
            <thead class="bg-gray-200">
                <tr>
                    <th class="border px-4 py-2 text-left">Nama Guru</th>
                    <th class="border px-4 py-2 text-left">NIP</th>
                    <th class="border px-4 py-2 text-left">Mata Pelajaran</th>
                    <th class="border px-4 py-2 text-left">Jabatan</th>
                    <th class="border px-4 py-2 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($gurus as $guru)
                <tr class="border hover:bg-gray-100">
                    <td class="border px-4 py-2 flex items-center">
                        <x-heroicon-o-user class="w-5 h-5 mr-2 text-gray-600" /> {{ $guru->nama_guru }}
                    </td>
                    <td class="border px-4 py-2">{{ $guru->nip }}</td>
                    <td class="border px-4 py-2">{{ $guru->mapel->nama_mapel }}</td>
                    <td class="border px-4 py-2">{{ $guru->jabatan->nama_jabatan }}</td>
                    <td class="border px-4 py-2 flex space-x-2">
                        <button wire:click="edit({{ $guru->id }})" class="bg-yellow-500 text-white px-3 py-1 rounded-lg hover:bg-yellow-600 flex items-center">
                            <x-heroicon-o-pencil class="w-4 h-4 mr-1" /> Edit
                        </button>
                        <button wire:click="delete({{ $guru->id }})" class="bg-red-500 text-white px-3 py-1 rounded-lg hover:bg-red-600 flex items-center">
                            <x-heroicon-o-trash class="w-4 h-4 mr-1" /> Hapus
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $gurus->links() }}
    </div>

    @if ($isOpen)
    <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white p-6 rounded-lg shadow-lg w-96">
            <h2 class="text-lg font-semibold mb-4">{{ $guruId ? 'Edit Guru' : 'Tambah Guru' }}</h2>

            <input type="number" wire:model="guruId" disabled hidden>

            <input type="text" wire:model="nama_guru" placeholder="Nama Guru" class="w-full p-2 border rounded mb-2">
            @error('nama_guru') <span class="text-red-500">{{ $message }}</span> @enderror

            <input type="text" wire:model="nip" placeholder="NIP" class="w-full p-2 border rounded mb-2">
            @error('nip') <span class="text-red-500">{{ $message }}</span> @enderror

            <select wire:model="id_mapel" class="w-full p-2 border rounded mb-2">
                <option value="">Pilih Mata Pelajaran</option>
                @foreach($mapels as $mapel)
                <option value="{{ $mapel->id }}">{{ $mapel->nama_mapel }}</option>
                @endforeach
            </select>
            @error('id_mapel') <span class="text-red-500">{{ $message }}</span> @enderror

            <select wire:model="id_jabatan" class="w-full p-2 border rounded mb-2">
                <option value="">Pilih Jabatan</option>
                @foreach($jabatans as $jabatan)
                <option value="{{ $jabatan->id }}">{{ $jabatan->nama_jabatan }}</option>
                @endforeach
            </select>
            @error('id_jabatan') <span class="text-red-500">{{ $message }}</span> @enderror

            <div class="flex justify-end space-x-2 mt-4">
                <button wire:click="closeModal" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Batal</button>
                <button wire:click="store" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
            </div>
        </div>
    </div>
    @endif
</div>