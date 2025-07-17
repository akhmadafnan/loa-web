<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Journal extends Model
{
    protected $fillable = ['name_journals', 'e_issn', 'p_issn', 'website_url', 'kode_jurnal', 'ttd', 'editor_name', 'logo', 'penerbit_id'];

    public function loaRequests()
    {
        return $this->hasMany(LoaRequest::class);
    }

    public function penerbit()
    {
        return $this->belongsTo(Penerbit::class);
    }
}
