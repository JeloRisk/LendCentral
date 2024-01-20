<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PostHistory;

class PostHistoryController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request and perform necessary checks
        // ...

        // Create a new history record
        PostHistory::create([
            'item_id' => $request->item_id,
            'user_id' => auth()->user()->id, // Assuming you're using authentication
            'action' => 'Borrowed', // Set the appropriate action
        ]);

        // Return a response indicating success
        return response()->json(['message' => 'History record created successfully'], 201);
    }

    // You can add other methods related to history here
}
