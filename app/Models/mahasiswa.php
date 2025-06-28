<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    // PENTING: samakan nama tabel dengan yang ada di database
    protected $table = 'mahasiswas';

    protected $primaryKey = 'nim';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['nim', 'nama', 'jk', 'tgl_lahir', 'jurusan', 'alamat'];
}
