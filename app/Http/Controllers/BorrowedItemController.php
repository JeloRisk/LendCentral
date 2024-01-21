<?php

namespace App\Http\Controllers;

use App\Models\BorrowedItem;
use App\Http\Requests\StoreBorrowedItemRequest;
use App\Http\Requests\UpdateBorrowedItemRequest;
use App\Models\Item;
use App\Models\PostHistory;
use App\Traits\SearchItemTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use function Psy\debug;

class BorrowedItemController extends Controller
{
    use SearchItemTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        // $totalBorrowedItems = BorrowedItem::borrowed()->count();
        $totalUnreturnedItems = BorrowedItem::unreturned()->count();

        // return view('item.index', [
        //     'totalBorrowedItems' => $totalBorrowedItems,
        //     'totalUnreturnedItems' => $totalUnreturnedItems
        // ]);
        $searchQuery = request('search_query');
        if (!isset($searchQuery) || empty($searchQuery)) {
            return view('item.borrowing', [
                'items' => Item::inRandomOrder()->where('status', true)->take(50)->get(),
                // 'totalBorrowedItems' => $totalBorrowedItems,
                'totalUnreturnedItems' => $totalUnreturnedItems
            ]);
        }

        return view('item.borrowing', [
            'items' => $this->searchBook($searchQuery, true),
            'totalBorrowedItems' => $totalBorrowedItems,
            'totalUnreturnedItems' => $totalUnreturnedItems
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(StoreBorrowedItemRequest $request)
    // {
    //     $item = Item::find($request->item_id);
    //     $statuss = "Ongoing";

    //     // if (empty($item) || $item->status === false) {
    //     //     return redirect()->route('home.index');
    //     // }

    //     BorrowedItem::create([
    //         'item_id' => $request->item_id,
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'borrowed_date' => date('Y-m-d h:i:s'),
    //         'until_date' => $request->until_date,
    //         'remarks' => $statuss,
    //     ]);

    //     $item->status = false;
    //     $item->save();

    //     $request->session()->flash('book_borrowed', 'Lend');

    //     return redirect()->back();
    // }



    // public function store(\Illuminate\Http\Request $request)
    // {
    //     // Validate the request
    //     $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
    //         'item_id' => 'required|integer',
    //         'name' => 'required_without:email|string',
    //         'email' => 'required_without:name|string',
    //         'until_date' => 'required|date',
    //     ]);

    //     if ($validator->fails()) {
    //         return redirect()->route('item.show', ['item' => $request->item_id])
    //             ->with('modalMessage', ['status' => 'error', 'message' => 'Item borrowing failed']);
    //     }

    //     $item = Item::find($request->item_id);
    //     $status = "Ongoing"; // Assuming you meant 'status' instead of 'statuss'

    //     BorrowedItem::create([
    //         'item_id' => $request->item_id,
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'borrowed_date' => now(), // Use Carbon to get current date and time
    //         'until_date' => $request->until_date,
    //         'remarks' => $status,
    //     ]);

    //     $item->status = false;
    //     $item->save();

    //     return redirect()->route('item.show', ['item' => $request->item_id])
    //         ->with('modalMessage', ['status' => 'success', 'message' => 'Item borrowed successfully']);
    // }

    public function store(\Illuminate\Http\Request $request)
    {
        // Validate the request
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'item_id' => 'required|integer',
            'name' => 'required_without:email|string',
            'email' => 'required_without:name|string|email', // Adding the email validation rule
            'until_date' => 'required|date',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();

            // $reason = '';
            if ($errors->has('item_id')) {
                $reason = 'Item ID is required.';
            } elseif ($errors->has('name')) {
                $reason = 'Name is required.';
            } elseif ($errors->has('email')) {
                $reason = 'Email is invalid or required.';
            } elseif ($errors->has('until_date')) {
                $reason = 'Until date is required.';
            }

            return response()->json(['result' => 0, 'reason' => $reason], 422);
        } else {
            // $reason = '';
            $item = Item::find($request->item_id);
            $statuss = "Ongoing";

            BorrowedItem::create([
                'office_id' => 1,
                'item_id' => $request->item_id,
                'name' => $request->name,
                'email' => $request->email,
                'borrowed_date' => now(), // Use Laravel's Carbon to get the current timestamp
                'until_date' => $request->until_date,
                'remarks' => $statuss,
            ]);

            $item->status = false;
            $item->save();
            // PostHistory::create([
            //     'item_id' => 2,
            //     'user_id' => 7,
            //     'action' => 'Borrowed', // Set the action to Borrowed
            //     // 'remarks' => $statuss,
            // ]);
            PostHistory::create([
                'item_id' => $request->item_id,
                'user_id' => auth()->user()->id,
                'office_id' => 1,
                // action log must be in the format of name + action + item + asset tag.
                'action' => $request->name . ' borrowed ' . $item->item_name . '(' . $item->asset_tag . ')'
            ]);
            return response()->json(['result' => 1, 'reason' => 'Item borrowed successfully', 'item_id' => $item->id], 200);
        }
    }




    public function history()
    {
        // $totalBorrowedItems = BorrowedItem::borrowed()->count();
        $totalUnreturnedItems = BorrowedItem::unreturned()->count();
        $searchQuery = request('search_query');

        if (!isset($searchQuery) || empty($searchQuery))
            return view('item.history', [
                'books' => Item::has('borrowedBookss')->take(10)->get(),
                // 'totalBorrowedItems' => $totalBorrowedItems,
                'totalUnreturnedItems' => $totalUnreturnedItems
            ]);

        return view('item.history', ['books' => $this->searchBorrowedBook($searchQuery)]);
    }

    public function khistory()
    {
        $searchQuery = request('search_query');

        if (!isset($searchQuery) || empty($searchQuery))
            return view('item.history', [
                'books' => Item::has('borrowedBookss')->take(10)->get()
            ]);

        return view('item.home', ['items' => $this->searchBorrowedBook($searchQuery)]);
    }

    public function returning()
    {
        return view('item.returning');
    }

    /**
     * Update the specified resource in storage.
     */
    // public function updateToReturn(UpdateBorrowedItemRequest $request)
    // {
    //     $book = Item::where('asset_tag', $request->asset_tag)->first();

    //     if ($book === null) {
    //         return redirect()->route('item.returning')->withErrors(['errors' => 'Invalid asset_tag code']);
    //     }

    //     $borrowedBook = BorrowedItem::whereHas('item', function (Builder $query) use ($request) {
    //         $query->where('asset_tag', $request->asset_tag);
    //     })->where('name', $request->name)->where('return_date', null)->first();

    //     if ($borrowedBook === null) {
    //         return redirect()->route('item.returning')->withErrors(['errors' => 'No matching borrowed item found in database']);
    //     }

    //     $borrowedBook->return_date = date('Y-m-d');
    //     $book->status = true;

    //     $borrowedBook->save();
    //     $book->save();


    //     $request->session()->flash('book_returned', 'Returned');

    //     return redirect()->back();
    // }

    // public function updateBorrowedDetail(UpdateBorrowedItemRequest $request)
    // {
    //     $item = Item::where('asset_tag', $request->asset_tag)->first();

    //     if ($item === null) {
    //         return redirect()->route('item.returning')->withErrors(['errors' => 'Invalid asset_tag code']);
    //     }

    //     $borrowedItem = BorrowedItem::whereHas('item', function (Builder $query) use ($request) {
    //         $query->where('asset_tag', $request->asset_tag);
    //     })->where('return_date', null)->where('returner_name', null)->where('remarks', "Ongoing")->first();

    //     if ($borrowedItem === null) {
    //         return redirect()->route('item.returning')->withErrors(['errors' => 'No matching borrowed item found in database']);
    //     }
    //     $borrowedItem->returner_name = $request->returner_name;
    //     $borrowedItem->remarks = $request->remarks;
    //     $borrowedItem->return_date = date('Y-m-d h:i:s');
    //     $item->status = true;

    //     $borrowedItem->save();
    //     $item->save();


    //     $request->session()->flash('item_returned', 'Returned');

    //     return redirect()->back();
    // }



    // public function updateBorrowedDetail(UpdateBorrowedItemRequest $request)
    // {
    //     $item = Item::where('asset_tag', $request->asset_tag)->first();

    //     if ($item === null) {
    //         return redirect()->route('item.returning')->withErrors(['errors' => 'Invalid asset_tag code']);
    //     }

    //     $borrowedItem = BorrowedItem::whereHas('item', function (Builder $query) use ($request) {
    //         $query->where('asset_tag', $request->asset_tag);
    //     })->where('return_date', null)->where('returner_name', null)->where('remarks', "Ongoing")->first();

    //     if ($borrowedItem === null) {
    //         return redirect()->route('item.returning')->withErrors(['errors' => 'No matching borrowed item found in database']);
    //     }

    //     $borrowedItem->update([
    //         'returner_name' => $request->returner_name,
    //         'remarks' => $request->remarks,
    //         'return_date' => now(), // Use Laravel's now() function for the current timestamp
    //     ]);

    //     $item->update([
    //         'status' => true,
    //     ]);
    //     PostHistory::create([
    //         'item_id' => $item->id,
    //         'user_id' => auth()->user()->id,
    //         'office_id' => 1,
    //         // action log must be in the format of name + action + item + asset tag.
    //         'action' => $request->returner_name . ' borrowed ' . $item->item_name . '(' . $item->asset_tag . ')'
    //     ]);

    //     $request->session()->flash('item_returned', 'Returned');

    //     return redirect()->back();
    // }



    public function updateBorrowedDetail(\Illuminate\Http\Request $request)
    {
        // Validate the request
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'returner_name' => 'required|string',
            'remarks' => 'required|string'
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            $errors = $validator->errors();

            $reason = '';
            if ($errors->has('returner_name')) {
                $reason = 'Returner name is required.';
            } elseif ($errors->has('remarks')) {
                $reason = 'Remarks is required.';
            }

            // Return the error response
            return response()->json(['result' => 0, 'reason' => $reason], 422);
        }

        // Use a database transaction
        DB::beginTransaction();

        try {
            $item = Item::where('asset_tag', $request->asset_tag)->first();

            if ($item === null) {
                return response()->json(['result' => 0, 'reason' => 'Invalid asset_tag code'], 422);
            }

            $borrowedItem = BorrowedItem::whereHas('item', function (Builder $query) use ($request) {
                $query->where('asset_tag', $request->asset_tag);
            })->where('return_date', null)->where('returner_name', null)->where('remarks', "Ongoing")->first();

            if ($borrowedItem === null) {
                return response()->json(['result' => 0, 'reason' => 'No matching borrowed item found in the database'], 422);
            }

            // Check if return_date is null before updating
            if ($borrowedItem->return_date === null) {
                $borrowedItem->update([
                    'returner_name' => $request->returner_name,
                    'remarks' => $request->remarks,
                    'return_date' => now(),
                ]);
            }

            $item->update([
                'status' => true,
            ]);

            PostHistory::create([
                'item_id' => $item->id,
                'user_id' => auth()->user()->id,
                'office_id' => 1,
                'action' => $request->returner_name . ' returned ' . $item->item_name . '(' . $item->asset_tag . ')',
            ]);

            // Commit the transaction
            DB::commit();

            return response()->json(['result' => 1, 'reason' => 'Borrowed item returned successfully', 'item_id' => $item->id], 200);
        } catch (\Exception $e) {
            // Rollback the transaction on error
            DB::rollback();
            return response()->json(['result' => 0, 'reason' => 'An error occurred while processing the request'], 422);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BorrowedItem $borrowedBook)
    {
        //
    }
}
