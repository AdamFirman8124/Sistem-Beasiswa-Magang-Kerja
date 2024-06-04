<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LombaUser extends Model
{
    protected $table = 'data_lombauser';
    protected $fillable = [
        'nama',
        'juara',
        'serial',
        'bukti',
        'lomba_id',
    ];

    public function lomba()
    {
        return $this->belongsTo(Lomba::class);
    }
}
