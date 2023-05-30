<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Item::orderBy('created_at', 'DESC')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newItem = new Item;
        $newItem->name = $request->item['name'];
        $newItem->save();

        return $newItem;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //1. $exitingItem is assigned the result of querying the Item model with the given $id.
        $exitingItem = Item::find($id);

        //2. The code checks if $exitingItem exists
        if($exitingItem){
            //2.1  Updates the completed field of the $exitingItem by negating its current value
            $exitingItem->completed =  !$exitingItem->completed;
            //2.2 updates the completed_at field based on the value of $request->item['completed'].
            //2.3 If it's true, it sets the current timestamp using Carbon::now(). Otherwise, it sets the field to null.
            $exitingItem->completed_at = $request->item['completed']?  Carbon::now() :null;
            //2.4 The name field of $exitingItem is updated with the value from $request->item['name'].
            $exitingItem->name =$request->item['name'];

            $exitingItem->save();

            // Finally, the updated $exitingItem is returned as the response.
            return $exitingItem;

        }
        return "Item not found";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $exitingItem = Item::find($id);
        if($exitingItem){
            $exitingItem->delete();
            return "Item successfully deleted";
        }
        return "Item not found";
    }
}
