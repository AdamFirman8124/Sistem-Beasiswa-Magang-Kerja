<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MagangUser extends Model
{
    protected $table = 'data_lokeruser';
    protected $fillable = [
        'nama',
        'durasi',
        'magang_id',
        'serial',
        'bukti',
    ];

    public function loker()
    {
        return $this->belongsTo(Loker::class, 'magang_id');
    }
}
