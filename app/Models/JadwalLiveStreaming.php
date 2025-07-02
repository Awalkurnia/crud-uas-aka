<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalLiveStreaming extends Model
{
    protected $table = 'jadwal_live_streamings';
    protected $primaryKey = 'id_live';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'nama_acara',
        'tanggal',
        'jam',
        'platform',
    ];
} 