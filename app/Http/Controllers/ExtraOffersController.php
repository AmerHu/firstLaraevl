<?php

namespace App\Http\Controllers;

use App\Extra;
use App\ExtraOffers;
use App\Offers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExtraOffersController extends Controller
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
        $offer = Offers::find($id);
        $extra_id = DB::table('extra_offers')->where('offer_id', $id)->pluck('extra_id')->toArray();

        if ($extra_id == null) {
            $extras = Extra::all();
        } else {
            $extras = DB::table('extras')
                ->whereNotIn('id', function ($query)use ($id) {
                    $query->select('extra_id')
                        ->from('extra_offers')
                        ->where('extra_offers.offer_id',$id);
                })
                ->get();
        }
        $count =count($extras);
        if ($count == 0) {
            flash('Sorry! This no more Description.')->error();
            return view('extra_offer.create', compact('extras','count'));
        } else {
            return view('extra_offer.create', compact('extras', 'offer','count'));
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
        if ($request->extra_id > 0){
        $extras = $request->get('extra_id');
        foreach ($extras as $extra) {
            $extraOffer = new ExtraOffers();
            $extraOffer->offer_id = $request->get('offer_id');
            $extraOffer->extra_id = $extra;
            $extraOffer->save();
        }
        return redirect('/offers/show/' . $request->get('offer_id'));
    }else{
            return redirect('/offers/show/' . $request->get('offer_id'));
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ExtraOffers  $extraOffers
     * @return \Illuminate\Http\Response
     */
    public function show(ExtraOffers $extraOffers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ExtraOffers  $extraOffers
     * @return \Illuminate\Http\Response
     */
    public function edit(ExtraOffers $extraOffers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ExtraOffers  $extraOffers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ExtraOffers $extraOffers)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ExtraOffers  $extraOffers
     * @return \Illuminate\Http\Response
     */
    public function destroy($extra_id, $offer_id)
    {
        DB::table('extra_offers')
            ->where('extra_offers.offer_id', '=', $offer_id)
            ->where('extra_offers.extra_id', '=', $extra_id)
            ->delete();
        return back();
    }
}
