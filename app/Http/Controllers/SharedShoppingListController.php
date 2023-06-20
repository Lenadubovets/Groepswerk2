<?php

namespace App\Http\Controllers;

use App\Models\SharedShoppingList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SharedShoppingListController extends Controller
{
    //Create A Shareable Link To Shopping List
    public function share(Request $request)
    {
        //Get Shopping List Items For Logged In User
        $ingredients = Auth::user()->ingredients()->wherePivot('list', 'shoppingList')->get();

        //Create Items Array
        $items = [];
        foreach ($ingredients as $ingredient) {
            $items[] = [
                'name' => $ingredient->name,
                'quantity' => $ingredient->pivot->quantity,
                //TODO: remove, update?
                'checked' => false,
            ];
        }

        //Create Shared Shopping List
        $shoppingList = Auth::user()->sharedShoppingLists()->create([
            'shareable_link' => Str::random(10),
            'items' => json_encode($items),
        ]);

        return response()->json([
            'link' => url('/sharedshoppinglist/' . $shoppingList->shareable_link),
        ]);
    }

    public function show($shareable_link)
    {
        //Find Shopping List
        $shoppingList = SharedShoppingList::where('shareable_link', $shareable_link)->firstOrFail();

        //Turn JSON into PHP Array
        $items = json_decode($shoppingList->items, true);

        //Pass Items to the View
        return view('sharedShoppingList.index', ['items' => $items, 'noHeader' => true]);
    }
}