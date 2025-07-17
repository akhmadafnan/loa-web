<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoaRequest extends Model
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
        'status',
        'link_journal',
        'letter_number',
        'qr_code_path',
    ];

    public function journal()
    {
        return $this->belongsTo(Journal::class, 'journal_id');
    }
}
