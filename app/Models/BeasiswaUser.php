<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BeasiswaUser extends Model
{
    protected $table = 'data_beasiswauser';
    protected $fillable = [
        'nama',
        'beasiswa_id',
        'serial',
        'bukti',
    ];

    public function beasiswa()
    {
        return $this->belongsTo(Beasiswa::class);
    }
}
