<?php

namespace App\Http\Controllers;

use App\Category;
use App\DefaultExtras;
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
        $defaults = Extra::all();
        $descriptions = Description::all();
        return view('items.create', compact('descriptions','defaults','categories', 'defaultExtra', 'extras'));
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
            'img' => 'required|mimes:jpeg,bmp,png',
            'cate_id' => 'required',
            'desc_id' => 'required',
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
                'desc_id' => request('desc_id'),
                'img' => $fileName,
                'active' => 0,
            ]);
        }

        $item_id = DB::table('items')->max('id');
        $descriptions = $request->get('default_id');
        if (count($descriptions) > 0) {
            foreach ($descriptions as $desc) {
                $default = new DefaultExtras();
                $default->item_id = $item_id;
                $default->default_id = $desc;
                $default->save();
            }
        }

        $item_id = DB::table('items')->max('id');
        $descriptions = $request->get('extra_id');
        if (count($descriptions) > 0) {
            foreach ($descriptions as $desc) {
                $sub_item = new SubItems();
                $sub_item->item_id = $item_id;
                $sub_item->extra_id = $desc;
                $sub_item->save();
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


        $defaults = DB::table('extras')
            ->select('extras.id', 'extras.name')
            ->join('default_extras', 'default_id', '=', 'extras.id')
            ->where('item_id', '=', $id)
            ->get();

        $category = Category::where('id', $item->cate_id)->pluck('name')->first();
        $description = Description::where('id', $item->desc_id)->pluck('name')->first();

        return view('items.show', compact('category', 'item', 'extras', 'defaults','description'));
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
        $descriptions = Description::all();
        $cate_id = Category::where('id', $items->cate_id)->pluck('id')->first();
        $desc_id = Description::where('id', $items->desc_id)->pluck('id')->first();
        $cate_name = Category::where('id',$cate_id)->pluck('name')->first();
        $desc_name = Description::where('id',$desc_id)->pluck('name')->first();
        return view('items.edit', compact('items', 'categories','descriptions','cate_name','desc_name'));
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
            'desc_id' => 'required',
            'price' => 'required|min:1|numeric',
            'cate_id' => 'required',
        ]);

        if ($request->hasFile('img')) {
            $image = DB::table('items')->where('id', $id)->pluck('img')->first();
            File::delete($image);
            $file = $request->file('img');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/items'), $fileName);
            $fileName = 'images/items/' . $fileName;
            Items::whereId($id)->update([
                'name' => json_encode(['EN' => request("nameEN"), 'AR' => request("nameAR")]),
                'price' => $request['price'],
                'img' => $fileName,
                'cate_id' => $request['cate_id'],
                'desc_id' => request('desc_id'),
            ]);
        } else {
            $image = DB::table('items')->where('id', $id)->pluck('img')->first();
            Items::whereId($id)->update([
                'name' => json_encode(['EN' => request("nameEN"), 'AR' => request("nameAR")]),
                'price' => $request['price'],
                'img' => $image,
                'cate_id' => $request['cate_id'],
                'desc_id' => request('desc_id'),
            ]);
        }
        return redirect('/items/show/'.$id);
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
        $price = DB::table('items')->where('id', $id)->pluck('price')->first();
        $image = DB::table('items')->where('id', $id)->pluck('img')->first();
        $name = DB::table('items')->where('id', $id)->pluck('name')->first();
        Items::whereId($id)->update([
            'name' => $name,
            'price' => $price,
            'img' => $image,
            'cate_id' => $cate_id,
            'active' => $active,
        ]);
        return redirect('/items/admin');
    }
}
