<?php

namespace App\Http\Controllers;

use App\Description;
use App\Item_desc;
use App\Items;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Flash;

class ItemDescController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $item = Items::find($id);
        $desc_id = DB::table('item_descs')->where('item_id', $id)->pluck('desc_id')->toArray();

        if ($desc_id == null) {
            $descriptions = Description::all();
        } else {
            $descriptions = DB::table('descriptions')
                ->whereNotIn('id', function ($query)use ($id) {
                    $query->select('desc_id')
                        ->from('item_descs')
                    ->where('item_descs.item_id',$id);
                })
                ->get();
        }
            $count =count($descriptions);
        if ($count == 0) {
            flash('Sorry! This no more Description.')->error();
            return view('desc_item.create', compact('descriptions','count'));
        } else {
            return view('desc_item.create', compact('descriptions', 'item','count'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public
    function store(Request $request)
    {
        $descriptions = $request->get('extra_id');
        if (count($descriptions )>0){
            foreach ($descriptions as $desc) {
                $itemDesc = new Item_desc();
                $itemDesc->item_id = $request->get('item_id');
                $itemDesc->desc_id = $desc;
                $itemDesc->save();
            }   flash( 'This Description added .')->success();
        }else{
            flash('Sorry! This no Description added.')->error();
        }
        return redirect('/items/show/' . $request->get('item_id'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Item_desc $item_desc
     * @return \Illuminate\Http\Response
     */
    public
    function show(Item_desc $item_desc)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Item_desc $item_desc
     * @return \Illuminate\Http\Response
     */
    public
    function edit(Item_desc $item_desc)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Item_desc $item_desc
     * @return \Illuminate\Http\Response
     */
    public
    function update(Request $request, Item_desc $item_desc)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Item_desc $item_desc
     * @return \Illuminate\Http\Response
     */
    public
    function destroy($item_id, $desc_id)
    {
        DB::table('item_descs')
            ->where('item_descs.item_id', '=', $item_id)
            ->where('item_descs.desc_id', '=', $desc_id)
            ->delete();
        return back();
    }
}
