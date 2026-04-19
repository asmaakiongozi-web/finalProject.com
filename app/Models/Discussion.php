<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Discussion extends Model
{
    protected $fillable = [
        'title',
        'content',
        'category',
        'user_id',
        'author_label',
        'views',
    ];

    public function replies(): HasMany
    {
        return $this->hasMany(DiscussionReply::class);
    }
}
