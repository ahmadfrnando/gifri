<div class="max-w-6xl mx-auto bg-white shadow-md rounded-lg p-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold text-gray-700 flex items-center">
            <x-heroicon-o-users class="w-6 h-6 mr-2 text-blue-600" /> Daftar Siswa
        </h2>
        <button wire:click="openModal" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 flex items-center">
            <x-heroicon-o-plus-circle class="w-5 h-5 mr-1" /> Tambah Siswa
        </button>
    </div>

    <!-- Flash Message -->
    @if (session()->has('message'))
    <div class="bg-green-500 text-white p-2 rounded mb-2 flex items-center">
        <x-heroicon-o-check-circle class="w-5 h-5 mr-2" /> {{ session('message') }}
    </div>
    @endif

    <div class="flex space-x-4 mb-4">
        <input type="text" wire:model="search" placeholder="Cari Nama Siswa..." class="border p-2 rounded-lg w-full">
    </div>

    <!-- Tabel -->
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300">
            <thead class="bg-gray-200">
                <tr>
                    <th class="border px-4 py-2 text-left">Nama Siswa</th>
                    <th class="border px-4 py-2 text-left">NISN</th>
                    <th class="border px-4 py-2 text-left">Agama</th>
                    <th class="border px-4 py-2 text-left">Jenis Kelamin</th>
                    <th class="border px-4 py-2 text-left">Tempat Lahir</th>
                    <th class="border px-4 py-2 text-left">Alamat</th>
                    <th class="border px-4 py-2 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($siswas as $siswa)
                <tr class="border hover:bg-gray-100">
                    <td class="border px-4 py-2 flex items-center">
                        <x-heroicon-o-user class="w-5 h-5 mr-2 text-gray-600" /> {{ $siswa->nama_siswa }}
                    </td>
                    <td class="border px-4 py-2">{{ $siswa->nisn }}</td>
                    <td class="border px-4 py-2">{{ $siswa->agama }}</td>
                    <td class="border px-4 py-2">{{ $siswa->jenis_kelamin == 'L' ? 'Laki-Laki' : 'Perempuan' }}</td>
                    <td class="border px-4 py-2">{{ $siswa->tempat_lahir }}</td>
                    <td class="border px-4 py-2 ">{{ Str::limit($siswa->alamat, 30) }}</td>
                    <td class="border px-4 py-2 flex space-x-2">
                        <button wire:click="edit({{ $siswa->id }})" class="bg-yellow-500 text-white px-3 py-1 rounded-lg hover:bg-yellow-600 flex items-center">
                            <x-heroicon-o-pencil class="w-4 h-4 mr-1" /> Edit
                        </button>
                        <button wire:click="delete({{ $siswa->id }})" class="bg-red-500 text-white px-3 py-1 rounded-lg hover:bg-red-600 flex items-center">
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
        {{ $siswas->links() }}
    </div>

    @if ($isOpen)
    <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white p-6 rounded-lg shadow-lg w-96">
            <h2 class="text-lg font-semibold mb-4">{{ $siswaId ? 'Edit Siswa' : 'Tambah Siswa' }}</h2>

            <input type="number" wire:model="userID" disabled hidden>

            <input type="text" wire:model="nama_siswa" placeholder="Nama Siswa" class="w-full p-2 border rounded mb-2">
            @error('nama_siswa') <span class="text-red-500">{{ $message }}</span> @enderror

            <input type="number" wire:model="nisn" placeholder="NISN" class="w-full p-2 border rounded mb-2">
            @error('nisn') <span class="text-red-500">{{ $message }}</span> @enderror
            
            <select wire:model="agama" class="w-full p-2 border rounded mb-2">
                <option value="">Pilih Agama</option>
                <option value="Islam">Islam</option>
                <option value="Kristen">Kristen</option>
                <option value="Katolik">Katolik</option>
                <option value="Hindu">Hindu</option>
                <option value="Buddha">Buddha</option>
            </select>
            
            <select wire:model="jenis_kelamin" class="w-full p-2 border rounded mb-2">
                <option value="">Pilih Jenis Kelamin</option>
                <option value="L">Laki - laki</option>
                <option value="P">Perempuan</option>
            </select>
            @error('jenis_kelamin') <span class="text-red-500">{{ $message }}</span> @enderror

            <input type="text" wire:model="tempat_lahir" placeholder="Tempat Lahir" class="w-full p-2 border rounded mb-2">
            @error('tempat_lahir') <span class="text-red-500">{{ $message }}</span> @enderror

            <textarea type="text" wire:model="alamat" placeholder="Alamat" class="w-full p-2 border rounded mb-2"></textarea>
            @error('alamat') <span class="text-red-500">{{ $message }}</span> @enderror

            <div class="flex justify-end space-x-2 mt-4">
                <button wire:click="closeModal" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Batal</button>
                <button wire:click="store" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
            </div>
        </div>
    </div>
    @endif
</div>