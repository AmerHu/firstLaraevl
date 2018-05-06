<?php

namespace App\Http\Controllers;

use App\Category;
use App\Description;
use App\Extra;
use App\Item_desc;
use App\Items;
use App\SubItems;
use Illuminate\Http\Request;
use DB;
use File;

class ItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Items::all();
        return view('items.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $extras = Extra::all();
        $descriptions = Description::all();
        return view('items.create', compact('categories', 'descriptions', 'extras'));
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
            'nameAR' => 'required|min:5',
            'nameEN' => 'required|min:5',
            'price' => 'required|min:1|numeric',
            'about' => 'required|min:5',
            'img' => 'required|mimes:jpeg,bmp,png',
            'cate_id' => 'required',
        ]);

        if ($request->hasFile('img')) {
            $file = request()->file('img');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/items'), $fileName);
            $fileName = 'images/items/' . $fileName;
            Items::create([
                'name' => json_encode(['EN' => request("nameEN"), 'AR' => request("nameAR")]),
                'price' => $request['price'],
                'cate_id' => request('cate_id'),
                'about' => request('about'),
                'img' => $fileName,
                'active' => 0,
            ]);
        }

        $item_id = DB::table('items')->max('id');
        $descriptions = $request->get('desc_id');
        if (count($descriptions) > 0) {
            foreach ($descriptions as $desc) {
                $itemDesc = new Item_desc();
                $itemDesc->item_id = $item_id;
                $itemDesc->desc_id = $desc;
                $itemDesc->save();
            }
        }
        flash('item created .')->success();
        return redirect('/subitems/create/' . $item_id);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Items $items
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Items::find($id);

        $extras = DB::table('extras')
            ->select('extras.id', 'extras.name')
            ->join('sub_items', 'extra_id', '=', 'extras.id')
            ->where('item_id', '=', $id)
            ->get();

        $descriptions = DB::table('descriptions')
            ->select('descriptions.id', 'descriptions.name')
            ->join('item_descs', 'desc_id', '=', 'descriptions.id')
            ->where('item_id', '=', $id)
            ->get();

        $category = Category::where('id', $item->cate_id)->pluck('name')->first();

        return view('items.show', compact('category', 'item', 'extras', 'descriptions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Items $items
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $items = Items::find($id);
        $categories = Category::all();
        return view('items.edit', compact('items', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Items $items
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate(request(), [
            'nameAR' => 'required|min:5',
            'nameEN' => 'required|min:5',
            'about' => 'required|min:5',
            'price' => 'required|min:1|numeric',
            'cate_id' => 'required',
        ]);

        if ($request->hasFile('img')) {
            $image = DB::table('items')->where('id', $id)->pluck('img')->first();
            $filename = 'images/items/' . $image;
            File::delete($filename);
            $file = $request->file('img');

            $fileName = time() . '.' . $file->getClientOriginalExtension();

            $file->move(public_path('images/items'), $fileName);
            $fileName = 'images/items/' . $fileName;
            Items::whereId($id)->update([
                'name' => json_encode(['EN' => request("nameEN"), 'AR' => request("nameAR")]),
                'price' => $request['price'],
                'about' => $request['about'],
                'img' => $fileName,
                'cate_id' => $request['cate_id'],
            ]);
        } else {
            $image = DB::table('items')->where('id', $id)->pluck('img')->first();
            Items::whereId($id)->update([
                'name' => json_encode(['EN' => request("nameEN"), 'AR' => request("nameAR")]),
                'about' => $request['about'],
                'price' => $request['price'],
                'img' => $image,
                'cate_id' => $request['cate_id'],
            ]);
        }
        return redirect('/items/admin');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Items $items
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id, $active)
    {
        $cate_id = DB::table('items')->where('id', $id)->pluck('cate_id')->first();
        $about = DB::table('items')->where('id', $id)->pluck('about')->first();
        $price = DB::table('items')->where('id', $id)->pluck('price')->first();
        $image = DB::table('items')->where('id', $id)->pluck('img')->first();
        $name = DB::table('items')->where('id', $id)->pluck('name')->first();
        Items::whereId($id)->update([
            'name' => $name,
            'price' => $price,
            'img' => $image,
            'cate_id' => $cate_id,
            'active' => $active,
            'about' => $about,
        ]);
        return redirect('/items/admin');
    }
}
