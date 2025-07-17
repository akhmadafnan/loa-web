<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penerbit extends Model
{
    protected $fillable = [
        'nama',
        'alamat',
        'no_hp',
        'logo'
    ];

    public function journals()
    {
        return $this->hasMany(Journal::class);
    }
}
