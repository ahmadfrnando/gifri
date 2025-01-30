<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Arsip;
use App\Models\Guru;

class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.dashboard', [
            'totalSuratMasuk' => Arsip::where('jenis', 'masuk')->count(),
            'totalSuratKeluar' => Arsip::where('jenis', 'keluar')->count(),
            'totalGuru' => Guru::count(),
            'suratTerbaru' => Arsip::latest()->take(5)->get(),
        ]);
    }
}
