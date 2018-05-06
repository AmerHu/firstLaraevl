<?php

namespace App\Http\Controllers;

use App\CompoOffers;
use App\Items;
use App\ItemsOffer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ItemsOfferController extends Controller
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
        $compo = CompoOffers::find($id);
        $item_id = DB::table('items_offers')->where('offer_id', $id)->pluck('item_id')->toArray();

        if ($item_id == null) {
            $items = Items::all();
        } else {
            $items = DB::table('items')
                ->whereNotIn('id', function ($query)use ($id) {
                    $query->select('item_id')
                        ->from('items_offers')
                        ->where('items_offers.offer_id',$id);
                })
                ->get();
        }
        $count =count($items);
        if ($count == 0) {
            flash('Sorry! This no more Item.')->error();
            return view('compo_item.create', compact('compo','count'));
        } else {
            return view('compo_item.create', compact('compo', 'items','count'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $compos = $request->get('item_id');
        if (count($compos)> 0  ) {
            foreach ($compos as $compo) {
                $itemOffer = new ItemsOffer();
                $itemOffer->offer_id = $request->get('offer_id');
                $itemOffer->item_id = $compo;
                $itemOffer->save();
            }
        }
        return redirect('/compo/show/' . $request->get('offer_id'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ItemsOffer  $itemsOffer
     * @return \Illuminate\Http\Response
     */
    public function show(ItemsOffer $itemsOffer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ItemsOffer  $itemsOffer
     * @return \Illuminate\Http\Response
     */
    public function edit(ItemsOffer $itemsOffer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ItemsOffer  $itemsOffer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ItemsOffer $itemsOffer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ItemsOffer  $itemsOffer
     * @return \Illuminate\Http\Response
     */
    public function destroy($item_id, $offer_id)
    {
        DB::table('items_offers')
            ->where('items_offers.item_id', '=', $item_id)
            ->where('items_offers.offer_id', '=', $offer_id)
            ->delete();
        return back();
    }
}
