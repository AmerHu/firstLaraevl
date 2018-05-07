<?php

namespace App\Http\Controllers;

use App\Category;
use App\CategoryExtras;
use App\Extra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExtraController extends Controller
{

    public function index()
    {
        $extras = Extra::all();

        return view('extras.index', compact('extras'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('extras.create', compact('categories'));
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

        ]);
        Extra::create([
            'name' => json_encode(['EN' => request("nameEN"), 'AR' => request("nameAR")]),
            'price' => $request['price'],

        ]);

        flash('Extras created .')->success();
        return redirect('/extra/admin');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Extra $extra
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $extra = Extra::find($id);


        $categories = DB::table('categories')
            ->select('categories.id', 'categories.name')
            ->join('category_extras','category_id','=','categories.id')
            ->where('extra_id', '=', $id)
            ->get();


        return view('extras.show', compact('extra','categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Extra $extra
     * @return \Illuminate\Http\Response
     */
    public function edit(Extra $extra, $id)
    {
        $extra = Extra::find($id);
        return view('extras.edit', compact('extra'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Extra $extra
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate(request(), [
            'nameAR' => 'required|min:5',
            'nameEN' => 'required|min:5',
            'price' => 'required|min:1|numeric',

        ]);
        DB::table('extras')->where('id', $id)
            ->update([
                'name' => json_encode(['EN' => request("nameEN"), 'AR' => request("nameAR")]),
                'price' => $request['price'],

            ]);

        return redirect('/extra/admin');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Extra $extra
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id, $active)
    {
        $price = DB::table('extras')->where('id', $id)->pluck('price')->first();
        $name = DB::table('extras')->where('id', $id)->pluck('name')->first();
        Extra::whereId($id)->update([
            'name' => $name,
            'price' => $price,
            'active' => $active,
        ]);
        return redirect('/extra/admin');
    }
}