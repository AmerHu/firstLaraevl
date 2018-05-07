<?php

namespace App\Http\Controllers;

use App\Description;
use App\Offers;
use DB;
use File;
use Illuminate\Http\Request;

class OffersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $offers = Offers::orderBy('id')->paginate(3);
        return view('offers.index', compact('offers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $descriptions = Description::all();
        return view('offers.create',compact('descriptions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(), [
            'nameAR' => 'required|min:5',
            'nameEN' => 'required|min:5',
            'price' => 'required|min:1|numeric',
            'img' => 'required|min:5|mimes:jpeg,bmp,png',
            'require'=>'required',
            'active'=>'required',
            'desc_id' =>'required'
        ]);

        if ($request->hasFile('img')) {
            $file = request()->file('img');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/offers'), $fileName);
            $fileName = 'images/offers/'.$fileName;
            Offers::create([
                'name' => json_encode(['EN'=> request("nameEN"), 'AR' => request("nameAR")]),
                'price' => $request['price'],
                'desc_id' => $request['desc_id'],
                'img' => $fileName,
                'require' => $request['require'],
                'active' => $request['active'],
            ]);
        }

        $offer_id = DB::table('offers')->max('id');
        flash('Offer created .')->success();

        return redirect('/offers/show/'.$offer_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Offers $offers
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $offer = Offers::find($id);
        $extras = DB::table('extras')
            ->select('extras.id', 'extras.name')
            ->join('extra_offers','extra_id','=','extras.id')
            ->where('offer_id', '=', $id)
            ->get();

        $description = Description::where('id', $offer->desc_id)->pluck('name')->first();
        return view('offers.show', compact('offer','extras','description'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Offers $offers
     * @return \Illuminate\Http\Response
     */
    public function edit(Offers $offers, $id)
    {
        $offer = Offers::find($id);
        $descriptions = Description::all();
        $desc_id = Description::where('id', $offer->desc_id)->pluck('id')->first();
        $desc_name = Description::where('id',$desc_id)->pluck('name')->first();
        return view('offers.edit', compact('offer','desc_name','descriptions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Offers $offers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->hasFile('img')) {
            $image = DB::table('offers')->where('id', $id)->pluck('img')->first();
            File::delete($image);
            $file = $request->file('img');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/offers'), $fileName);
            $fileName = 'images/offers/'.$fileName;
            Offers::whereId($id)->update([

                'name' => json_encode(['EN'=> request("nameEN"), 'AR' => request("nameAR")]),
                'price' => $request['price'],
                'img' => $fileName,
                'require' => $request['require'],
                'desc_id' => $request['desc_id'],
            ]);
        } else {
            $image = DB::table('offers')->where('id', $id)->pluck('img')->first();
            Offers::whereId($id)->update([
                'name' => json_encode(['EN'=> request("nameEN"), 'AR' => request("nameAR")]),
                'price' => $request['price'],
                'img' => $image,
                'require' => $request['require'],
                'desc_id' => $request['desc_id'],
            ]);
    }
        return redirect('/offers/admin');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Offers $offers
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id,$active)
    {
        $description = DB::table('offers')->where('id', $id)->pluck('description')->first();
        $price = DB::table('offers')->where('id', $id)->pluck('price')->first();
        $image = DB::table('offers')->where('id', $id)->pluck('img')->first();
        $name = DB::table('offers')->where('id', $id)->pluck('name')->first();
        Offers::whereId($id)->update([
            'name' => json_encode(['EN'=> request("nameEN"), 'AR' => request("nameAR")]),
            'price' => $price,
            'img' => $image,
            'description' => $description,
            'active' => $active,
        ]);
        return redirect('/offers/admin');
    }
}
