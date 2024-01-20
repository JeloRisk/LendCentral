<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Models\BorrowedItem;
use App\Models\PostHistory;
use App\Traits\SearchItemTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ItemController extends Controller
{
    use SearchItemTrait;

    public function home()
    {

        $searchQuery = request('search_query');
        if (!isset($searchQuery) || empty($searchQuery))
            return view('index', [
                'items' => Item::inRandomOrder()->take(35)->get(), 'categories' => Category::all(),
                'totalUnreturnedItems' => BorrowedItem::unreturned()->count(),
                "totalReturnedItems" => Item::returned()->count(),
                'itemMMSU' => Item::itemMMSU()->count(),
                'recentBorrowedItems' => PostHistory::orderBy('id', 'desc')->take(7)->get()

            ]);
    }

    public function search()
    {
        $searchQuery = request('search_query');

        session(['search_query' => $searchQuery]);
        if (!isset($searchQuery) || empty($searchQuery))
            return view('item.search', [
                'items' => Item::inRandomOrder()->take(35)->get(),
                'categories' => Category::all(),
                // 'totalBorrowedItems' => BorrowedItem::borrowed()->count(),
                'totalUnreturnedItems' => BorrowedItem::unreturned()->count(),
                'itemMMSU' => Item::itemMMSU()->count()
            ]);

        return view('item.search', ['items' => $this->searchBook($searchQuery),    'categories' => Category::all()]);
    }


    public function index()
    {
        $searchQuery = request('search_query');

        if (!isset($searchQuery) || empty($searchQuery)) {
            return view('item.index', [
                "items" => Item::orderBy("created_at", "desc")->simplePaginate(5),
                "categories" => Category::all()
            ]);
        } else {
            $items = Item::where('item_name', 'like', '%' . $searchQuery . '%')
                ->orWhere('asset_tag', 'like', '%' . $searchQuery . '%')
                ->orderBy("created_at", "desc")
                ->simplePaginate(10);

            return view("item.index", [
                "items" => $items,
                "categories" => Category::all(),
                "jquery" => $searchQuery
            ]);
        }
    }


    public function create()
    {
        return view("item.create", [
            "title" => "Add New", 'categories' => Category::all()
        ]);
    }




    public function store(Request $request)
    {
        $request->validate([
            'item_name' => 'required|string',
            'cover_url' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'asset_tag' => [
                'required',
                'string',
                'regex:/^[a-zA-Z]+[0-9]+$/',
                Rule::unique('items')->where(function ($query) use ($request) {
                    return $query->where('asset_tag', 'like', $request->asset_tag . '%');
                }),
            ],
            'quantity' => 'required|integer',
        ]);

        $base_asset_tag = $request->asset_tag;
        $quantity = $request->quantity;



        // Determine the next available asset_tag value
        $next_asset_tag = $base_asset_tag;
        $i = 1;
        while (Item::where('asset_tag', $next_asset_tag)->exists()) {
            $next_asset_tag = $base_asset_tag . ++$i;
        }


        // $imageName = time() . '.' . $request->image->extension();

        // $request->image->move(public_path('images'), $imageName);

        // Move the uploaded image to the public/images directory
        $cover_url = time() . '.' . $request->cover_url->extension();
        $request->cover_url->move(public_path('images'), $cover_url);

        // Create the items
        $items = [];
        for ($i = 0; $i < $quantity; $i++) {
            $item_asset_tag = $next_asset_tag;
            $next_asset_tag = $base_asset_tag . ++$i;
            $item = Item::create([
                'item_name' => $request->item_name,
                'cover_url' => "/images",
                'asset_tag' => $item_asset_tag,
                'quantity' => $quantity,
                // Add other fields accordingly
            ]);

            $items[] = $item;
        }

        // Associate categories
        if ($request->has('item_category')) {
            $categories = $request->input('item_category');
            foreach ($items as $item) {
                $item->categories()->attach($categories);
            }
        }

        return redirect('/item-list')->with("message", "New Item(s) were added successfully");
    }





    public function show(Item $item)
    {
        $borrowedHistory = BorrowedItem::where('item_id', $item->id)
            ->orderBy('id', 'asc')
            ->get();

        return view('item.detail', ['item' => $item,  'borrowedHistory' => $borrowedHistory]);
    }
}
