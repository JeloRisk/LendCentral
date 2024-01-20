<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $with = [

        'categories'
    ];

    protected $fillable = [

        'item_id',
        "asset_tag",
        "quantity",
        'item_name',
        'cover_url',
        'status',

    ];

    public function borrowedBookss(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(BorrowedItem::class);
    }

    public function scopeItemMMSU($query)
    {
        return $query;
    }


    public function scopeReturned($query)
    {
        // return $query->whereNotNull('return_date');

        return $query->where("status", "=", "1");
        // MyModel::distinct()->get(['column_name']);

    }


    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }


}
