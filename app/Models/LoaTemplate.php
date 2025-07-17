<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoaTemplate extends Model
{
    protected $fillable = [
        'id_article',
        'volume',
        'number',
        'month',
        'year',
        'article_title',
        'article_author',
        'journal_id',
        'registration_number',
    ];

    public function journal()
    {
        return $this->belongsTo(Journal::class);
    }
}
