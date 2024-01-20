<?php

namespace App\Traits;

use App\Models\Item;
use Illuminate\Database\Eloquent\Builder;

trait SearchItemTrait
{
    private function sanitize(string $str)
    {
        return htmlspecialchars(strip_tags(trim($str)));
    }

    public function searchBook(string $searchQuery, bool $checkStatus = false): \Illuminate\Database\Eloquent\Collection
    {
        if (empty($searchQuery)) return Item::inRandomOrder()->take(35)->get();

        $needle = $this->sanitize($searchQuery);

 
        $items = Item::where('item_name', 'LIKE', "%$needle%")
            ->get();

        return $items;
    }


}
