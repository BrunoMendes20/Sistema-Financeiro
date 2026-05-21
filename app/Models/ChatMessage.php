<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable([
    'user_id',
    'role',
    'content',
    'created_at',
])]

class ChatMessage extends Model
{
    public $timestamps = false;


    protected function casts(): array
    {
        return [
            'role' => 'string',
            'created_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


}
