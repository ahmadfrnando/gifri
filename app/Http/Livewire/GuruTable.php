<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Guru; // Sesuaikan dengan model Guru
use App\Models\RefJabatan;
use App\Models\RefMapel;
use Livewire\WithPagination;

class GuruTable extends Component
{
    use WithPagination;

    public $search = '';
    public $filterJabatan = '';
    public $filterMapel = '';
    public $isOpen = false; // Modal state
    public $guruId, $nama_guru, $nip, $id_mapel, $id_jabatan;

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->reset(['nama_guru', 'nip', 'id_mapel', 'id_jabatan']);
    }

    public function store()
    {
        if ($this->guruId) {
            $guru = Guru::find($this->guruId);
            $guru->update([
                'nama_guru' => $this->nama_guru,
                'nip' => $this->nip,
                'id_mapel' => $this->id_mapel,
                'id_jabatan' => $this->id_jabatan,
            ]);
            session()->flash('message', 'Guru berhasil diubah!');
            $this->closeModal();
            return;
        }
        $this->validate([
            'nama_guru' => 'required',
            'nip' => 'required|numeric',
            'id_mapel' => 'required',
            'id_jabatan' => 'required',
        ]);

        Guru::create([
            'nama_guru' => $this->nama_guru,
            'nip' => $this->nip,
            'id_mapel' => $this->id_mapel,
            'id_jabatan' => $this->id_jabatan,
        ]);

        session()->flash('message', 'Guru berhasil ditambahkan!');
        $this->closeModal();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingFilterJabatan()
    {
        $this->resetPage();
    }

    public function updatingFilterMapel()
    {
        $this->resetPage();
    }

    public function edit($id)
    {
        $guru = Guru::findOrFail($id);
        $this->guruId = $id;
        $this->nama_guru = $guru->nama_guru;
        $this->nip = $guru->nip;
        $this->id_mapel = $guru->id_mapel;
        $this->id_jabatan = $guru->id_jabatan;

        $this->isOpen = true;
    }

    public function delete($id)
    {
        Guru::findOrFail($id)->delete();
        session()->flash('message', 'Guru berhasil dihapus!');
    }

    public function render()
    {
        $gurus = Guru::where('nama_guru', 'like', '%' . $this->search . '%')
            ->when($this->filterJabatan, function ($query) {
                return $query->where('id_jabatan', $this->filterJabatan);
            })
            ->when($this->filterMapel, function ($query) {
                return $query->where('id_mapel', $this->filterMapel);
            })
            ->paginate(10);

        $jabatans = RefJabatan::all();
        $mapels = RefMapel::all();

        return view('livewire.guru-table', [
            'gurus' => $gurus,
            'jabatans' => $jabatans,
            'mapels' => $mapels,
        ]);
    }
}
