<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable([
    'user_id',
    'category_id',
    'description',
    'amount',
    'type',
    'date',
])]

class Transaction extends Model
{
    protected function casts(): array
    {
        return 
        [
            'amount' => 'decimal:2',
            'date' => 'date',
            'type' => 'string',

        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }


}
