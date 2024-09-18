<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Item::latest()->get();
        return $items;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $item = new Item;
        $item->name = $request->item['name'];
        $item->save();

        return $item;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $item = Item::find($id);
        if ($item) {
            return $item;
        }

        return 'item not found';
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $item = Item::find($id);
        if ($item) {
            $item->completed = $request->item['completed']? true:false;
            $item->completed_at = $request->item['completed']? now():null;
            $item->save();
            return $item;
        }

        return 'item not found';        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Item::find($id);
        if ($item) {
            $item->delete();
            return 'item deleted';        
        }

        return 'item not found';        
    }
}
