<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;

    protected $table = 'guru';
    protected $guarded = [];

    public function jabatan()
    {
        return $this->belongsTo(RefJabatan::class, 'id_jabatan');
    }

    public function mapel()
    {
        return $this->belongsTo(RefMapel::class, 'id_mapel');
    }
}
