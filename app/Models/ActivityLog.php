<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    protected $fillable = [
        'model_type',
        'loa_request_id',
        'action',
        'description'
    ];
}
