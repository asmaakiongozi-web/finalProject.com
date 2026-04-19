<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Resource extends Model
{
    protected $fillable = [
        'title',
        'description',
        'content',
        'category',
        'type',
        'file_path',
        'posted_by',
        'posted_by_type',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'posted_by');
    }
}
