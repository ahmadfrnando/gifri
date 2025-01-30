<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Arsip;
use Illuminate\Support\Facades\Storage;

class ArsipSurat extends Component
{
    use WithPagination, WithFileUploads;

    public $search = '';
    public $filterJenis = '';
    public $filterTanggal = '';

    public $isOpen = false;
    public $isViewOpen = false;
    public $suratId, $nama_surat, $jenis, $file_surat, $tanggal_surat, $pihak_terkait, $keterangan;
    public $fileViewPath = '';


    public function openViewModal($id)
    {
        $path = Arsip::find($id)->file_surat;
        $this->suratId = $id;
        $this->fileViewPath = Storage::url($path);
        $this->isViewOpen = true;
    }

    public function closeViewModal()
    {
        $this->isViewOpen = false;
    }

    public function openModal()
    {
        $this->resetInput();
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->isViewOpen = false;
        $this->resetInput();
    }

    public function resetInput()
    {
        $this->suratId = null;
        $this->nama_surat = '';
        $this->jenis = '';
        $this->file_surat = null;
        $this->tanggal_surat = '';
        $this->pihak_terkait = '';
        $this->keterangan = '';
    }

    public function store()
    {
        $this->validate([
            'nama_surat' => 'required',
            'jenis' => 'required|in:masuk,keluar',
            'file_surat' => 'required|file|mimes:pdf,jpg,png|max:2048',
            'tanggal_surat' => 'required|date',
            'pihak_terkait' => 'required',
            'keterangan' => 'nullable',
        ]);

        $path = $this->file_surat->store('arsip_surat', 'public');

        Arsip::updateOrCreate(['id' => $this->suratId], [
            'nama_surat' => $this->nama_surat,
            'jenis' => $this->jenis,
            'file_surat' => $path,
            'tanggal_surat' => $this->tanggal_surat,
            'pihak_terkait' => $this->pihak_terkait,
            'keterangan' => $this->keterangan,
        ]);

        session()->flash('message', $this->suratId ? 'Surat berhasil diperbarui!' : 'Surat berhasil ditambahkan!');
        $this->closeModal();
    }

    public function edit($id)
    {
        $surat = Arsip::findOrFail($id);
        $this->suratId = $id;
        $this->nama_surat = $surat->nama_surat;
        $this->jenis = $surat->jenis;
        $this->tanggal_surat = $surat->tanggal_surat;
        $this->pihak_terkait = $surat->pihak_terkait;
        $this->keterangan = $surat->keterangan;

        $this->isOpen = true;
    }

    public function deleteFromView()
    {
        $surat = Arsip::findOrFail($this->suratId);
        Storage::delete('public/' . $surat->file_surat);
        $surat->delete();

        session()->flash('message', 'Surat berhasil dihapus!');
        $this->closeViewModal();
    }

    public function render()
    {
        $surats = Arsip::where('nama_surat', 'like', '%' . $this->search . '%')
            ->when($this->filterJenis, fn($query) => $query->where('jenis', $this->filterJenis))
            ->when($this->filterTanggal, fn($query) => $query->whereDate('tanggal_surat', $this->filterTanggal))
            ->paginate(8);

        return view('livewire.arsip-surat', ['surats' => $surats]);
    }
}
