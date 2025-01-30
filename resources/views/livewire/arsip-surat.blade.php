<div class="max-w-6xl mx-auto bg-white shadow-md rounded-lg p-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold text-gray-700 flex items-center">
            <x-heroicon-o-folder class="w-6 h-6 mr-2 text-blue-600" /> Arsip Surat
        </h2>
        <button wire:click="openModal" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 flex items-center">
            <x-heroicon-o-plus class="w-5 h-5 mr-1" /> Tambah Surat
        </button>
    </div>

    <!-- Pencarian & Filter -->
    <div class="flex space-x-4 mb-4">
        <input type="text" wire:model="search" placeholder="Cari Surat..." class="border p-2 rounded-lg w-full">
        <input type="date" wire:model="filterTanggal" class="border p-2 rounded-lg">
        <select wire:model="filterJenis" class="border px-8 py-2 rounded-lg">
            <option value="">Semua Surat</option>
            <option value="masuk">Surat Masuk</option>
            <option value="keluar">Surat Keluar</option>
        </select>
    </div>

    <!-- Grid Folder -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        @foreach($surats as $surat)
        <button wire:click="openViewModal('{{ $surat->id }}')" class="bg-gray-100 p-4 flex flex-col items-center rounded-lg shadow hover:bg-gray-200 transition cursor-pointer">
            @if($surat->jenis == 'masuk')
            <x-heroicon-o-document-arrow-down class="w-40 h-40 text-yellow-500 mb-2" />
            @else
            <x-heroicon-o-document-arrow-up class="w-40 h-40 text-yellow-500 mb-2" />
            @endif
            <p class="text-sm text-gray-500">{{ $surat->jenis == 'masuk' ? '📩 Surat Masuk' : '📤 Surat Keluar' }}</p>
            <h3 class="text-md font-semibold">{{ $surat->nama_surat }}</h3>
            <p class="text-sm text-gray-500">{{ $surat->tanggal_surat }}</p>
        </button>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $surats->links() }}
    </div>

    <!-- Modal View Surat -->
    @if ($isViewOpen)
    <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white p-6 rounded-lg shadow-lg w-[500px]">
            <h2 class="text-lg font-semibold mb-4 flex items-center">
                <x-heroicon-o-document-text class="w-5 h-5 mr-2" />
                Lihat Surat
            </h2>

            <iframe src="{{ $fileViewPath }}" class="w-full h-[500px]"></iframe>

            <div class="flex justify-between mt-4">
                <!-- Tombol Edit -->
                <button wire:click="edit({{ $suratId }})" class="bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600 flex items-center">
                    <x-heroicon-o-pencil class="w-5 h-5 mr-1" /> Edit
                </button>

                <!-- Tombol Hapus -->
                <button wire:click="deleteFromView" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 flex items-center">
                    <x-heroicon-o-trash class="w-5 h-5 mr-1" /> Hapus
                </button>

                <!-- Tombol Tutup -->
                <button wire:click="closeViewModal" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 flex items-center">
                    <x-heroicon-o-x-mark class="w-5 h-5 mr-1" /> Tutup
                </button>
            </div>
        </div>
    </div>
    @endif


    @if ($isOpen)
    <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white p-6 rounded-lg shadow-lg w-96">
            <h2 class="text-lg font-semibold mb-4 flex items-center">
                <x-heroicon-o-document-plus class="w-5 h-5 mr-2" />
                {{ $suratId ? 'Edit Surat' : 'Tambah Surat' }}
            </h2>
            <!-- Nama Surat -->
            <div class="mb-2">
                <label class="block text-sm font-medium">Nama Surat</label>
                <input type="text" wire:model="nama_surat" class="w-full p-2 border rounded">
                @error('nama_surat') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <!-- Jenis Surat -->
            <div class="mb-2">
                <label class="block text-sm font-medium">Jenis Surat</label>
                <select wire:model="jenis" class="w-full p-2 border rounded">
                    <option value="">Pilih Jenis</option>
                    <option value="masuk">Surat Masuk</option>
                    <option value="keluar">Surat Keluar</option>
                </select>
                @error('jenis') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <!-- Tanggal Surat -->
            <div class="mb-2">
                <label class="block text-sm font-medium">Tanggal Surat</label>
                <input type="date" wire:model="tanggal_surat" class="w-full p-2 border rounded">
                @error('tanggal_surat') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <!-- Pihak Terkait -->
            <div class="mb-2">
                <label class="block text-sm font-medium">Pihak Terkait</label>
                <input type="text" wire:model="pihak_terkait" class="w-full p-2 border rounded">
                @error('pihak_terkait') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <!-- Keterangan -->
            <div class="mb-2">
                <label class="block text-sm font-medium">Keterangan</label>
                <textarea wire:model="keterangan" class="w-full p-2 border rounded"></textarea>
            </div>

            <!-- Upload File Surat -->
            <div class="mb-2">
                <label class="block text-sm font-medium">Upload Surat</label>
                <input type="file" wire:model="file_surat" class="w-full p-2 border rounded">
                @if ($file_surat)
                <p class="text-sm text-green-600 mt-1">File siap diunggah.</p>
                @endif
                @error('file_surat') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <!-- Tombol -->
            <div class="flex justify-end space-x-2 mt-4">
                <button wire:click="closeModal" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 flex items-center">
                    <x-heroicon-o-x-mark class="w-4 h-4 mr-1" /> Batal
                </button>
                <button wire:click="store" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 flex items-center">
                    <x-heroicon-o-check-circle class="w-4 h-4 mr-1" /> Simpan
                </button>
            </div>
        </div>
    </div>
    @endif

</div>