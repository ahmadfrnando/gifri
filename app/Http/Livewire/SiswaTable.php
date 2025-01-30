<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Guru; // Sesuaikan dengan model Guru
use App\Models\RefJabatan;
use App\Models\RefMapel;
use App\Models\Siswa;
use Livewire\WithPagination;

class SiswaTable extends Component
{
    use WithPagination;

    public $search = '';
    public $isOpen = false; // Modal state
    public $siswaId, $nama_siswa, $nisn, $jenis_kelamin, $agama, $alamat, $tempat_lahir;

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->reset(['nama_siswa', 'nisn', 'jenis_kelamin', 'agama', 'alamat', 'tempat_lahir']);
    }

    public function store()
    {   
        if($this->siswaId){
            $siswa = Siswa::find($this->siswaId);
            $siswa->update([
                'nama_siswa' => $this->nama_siswa,
                'nisn' => $this->nisn,
                'jenis_kelamin' => $this->jenis_kelamin,
                'agama' => $this->agama,
                'alamat' => $this->alamat,
                'tempat_lahir' => $this->tempat_lahir,
            ]);
            session()->flash('message', 'Siswa berhasil diubah!');
            $this->closeModal();
            return;
        }
        
        $this->validate([
            'nama_siswa' => 'required',
            'nisn' => 'required|numeric',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'alamat' => 'required',
            'tempat_lahir' => 'required',
        ]);

        Siswa::create([
            'nama_siswa' => $this->nama_siswa,
            'nisn' => $this->nisn,
            'jenis_kelamin' => $this->jenis_kelamin,
            'agama' => $this->agama,
            'alamat' => $this->alamat,
            'tempat_lahir' => $this->tempat_lahir,
        ]);

        session()->flash('message', 'Siswa berhasil ditambahkan!');
        $this->closeModal();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function edit($id)
    {
        $siswa = Siswa::findOrFail($id);
        $this->siswaId = $id;
        $this->nisn = $siswa->nisn;
        $this->nama_siswa = $siswa->nama_siswa;
        $this->jenis_kelamin = $siswa->jenis_kelamin;
        $this->agama = $siswa->agama;
        $this->alamat = $siswa->alamat;
        $this->tempat_lahir = $siswa->tempat_lahir;

        $this->isOpen = true;
    }

    public function delete($id)
    {
        Siswa::findOrFail($id)->delete();
        session()->flash('message', 'Siswa berhasil dihapus!');
    }

    public function render()
    {
        $siswas = Siswa::where('nama_siswa', 'like', '%' . $this->search . '%')->paginate(10);

        return view('livewire.siswa-table', [
            'siswas' => $siswas
        ]);
    }
}
