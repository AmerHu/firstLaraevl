<?php

namespace App\Http\Controllers;

use App\CompoOffers;
use App\Description;
use App\Items;
use App\ItemsOffer;
use Illuminate\Http\Request;
use DB;
use File;

class CompoOffersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $compos = CompoOffers::all();
        return view("compo_offers.index", compact('compos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $descriptions = Description::all();
        $items = Items::all();
        return view("compo_offers.create",compact('descriptions','items'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(
            request(), [
            'nameEN' => 'required|min:5',
            'nameAR' => 'required|min:5',
            'price' => 'required|min:1|numeric',
            'img' => 'required|mimes:jpeg,bmp,png',
            'desc_id' =>'required',
        ]);

        if ($request->hasFile('img')) {
            $file = request()->file('img');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/compo'), $fileName);
            $fileName = 'images/compo/' . $fileName;

            CompoOffers::create([
                'name' => json_encode(['EN' => request("nameEN"), 'AR' => request("nameAR")]),
                'price' => request("price"),
                'img' => $fileName,
                'require' => $request['require'],
                'desc_id' => $request['desc_id'],
                'active' => true,
            ]);
        }
        $compo_id = DB::table('compo_offers')->max('id');
        $compos = $request->get('item_id');
        if (count($compos)> 0  ) {
            foreach ($compos as $compo) {
                $itemOffer = new ItemsOffer();
                $itemOffer->offer_id = $compo_id;
                $itemOffer->item_id = $compo;
                $itemOffer->save();
            }
        }

         flash('Compo Offer created .')->success();
        return redirect('/compo/show/'.$compo_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CompoOffers $compoOffers
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $compo = CompoOffers::find($id);

        $items = DB::table('items')
            ->select('items.id', 'items.name')
            ->join('items_offers', 'item_id', '=', 'items.id')
            ->where('offer_id', '=', $id)
            ->get();

        $description = Description::where('id', $compo->desc_id)->pluck('name')->first();
        return view('compo_offers.show', compact('compo', 'items','description'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CompoOffers $compoOffers
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $compo = CompoOffers::find($id);
        $descriptions = Description::all();
        $desc_id = Description::where('id', $compo->desc_id)->pluck('id')->first();
        $desc_name = Description::where('id',$desc_id)->pluck('name')->first();
        return view('compo_offers.edit', compact("compo",'descriptions','desc_name'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\CompoOffers $compoOffers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->hasFile('img')) {
            $image = DB::table('compo_offers')->where('id', $id)->pluck('img')->first();
            File::delete($image);
            $file = $request->file('img');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/compo'), $fileName);
            $fileName = 'images/compo/' . $fileName;
            CompoOffers::whereId($id)->update([
                'name' => json_encode(['EN' => request("nameEN"), 'AR' => request("nameAR")]),
                'price' => $request['price'],
                'img' => $fileName,
                'desc_id' => request('desc_id'),
            ]);
        } else {
            $image = DB::table('compo_offers')->where('id', $id)->pluck('img')->first();
            CompoOffers::whereId($id)->update([
                'name' => json_encode(['EN' => request("nameEN"), 'AR' => request("nameAR")]),
                'price' => $request['price'],
                'img' => $image,
                'desc_id' => request('desc_id'),
            ]);
        }

        return redirect('/compo/admin');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CompoOffers $compoOffers
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id, $active)
    {
        $price = DB::table('compo_offers')->where('id', $id)->pluck('price')->first();
        $desc_id = DB::table('compo_offers')->where('id', $id)->pluck('desc_id')->first();
        $name = DB::table('compo_offers')->where('id', $id)->pluck('name')->first();
        $image = DB::table('compo_offers')->where('id', $id)->pluck('img')->first();
        CompoOffers::whereId($id)->update([
            'name' => $name,
            'img' => $image,
            'price' => $price,
            'active' => $active,
            'desc_id' =>$desc_id,
        ]);
        return redirect('/compo/admin');
    }
}
