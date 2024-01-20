<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BorrowedItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'office_id',
        // 'user_id',
        'name',
        'email',
        "asset_tag",
        'borrowed_date',
        'until_date',
        'return_date',
        // 'borrowed',
        'remarks',

        'status',
        'returner_name',
    ];

    public function item(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Item::class);
    }

    public function scopeUnreturned($query)
    {
        return $query->whereNull('return_date');
    }
    public function scopeReturned($query)
    {
        // return $query->whereNotNull('return_date');

        return $query->where("status", "=", "1");
        // MyModel::distinct()->get(['column_name']);

    }


    // public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    // {
    //     return $this->belongsTo(User::class);
    // }
}
