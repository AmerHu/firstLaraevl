<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use DB;
use File;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        $categories = Category::all();
        return view("categories.index", compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("categories.create");
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
            'img' => 'required|mimes:jpeg,bmp,png',
        ]);

        if ($request->hasFile('img')) {
            $file = request()->file('img');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/categories'), $fileName);
            $fileName ='images/categories/'. $fileName;
            Category::create([
                'name' => json_encode(['EN'=> request("nameEN"), 'AR' => request("nameAR")]),
                'img' => $fileName,
            ]);
        }
        $desc_id = DB::table('categories')->max('id');
        flash('Category created .')->success();
        return back()->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category $category
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::find($id);
        return view('categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return view('categories.edit', compact("category"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Category $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->hasFile('img')) {
            $image = DB::table('categories')->where('id', $id)->pluck('img')->first();
            File::delete($image);

            $file = $request->file('img');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/categories'), $fileName);
            $fileName= 'images/categories/'.$fileName;
            Category::whereId($id)->update([

                'name' => json_encode(['EN'=> request("nameEN"), 'AR' => request("nameAR")]),
                'img' => $fileName,
            ]);
        } else {
            $image = DB::table('categories')->where('id', $id)->pluck('img')->first();
            Category::whereId($id)->update([
                'name' => json_encode(['EN'=> request("nameEN"), 'AR' => request("nameAR")]),
                'img' => $image,
            ]);
        }
        return redirect('/category/admin');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id ,$active)
    {
        $name = DB::table('categories')->where('id', $id)->pluck('name')->first();
        $image = DB::table('categories')->where('id', $id)->pluck('img')->first();
        Category::whereId($id)->update([
            'name' => $name,
            'img' => $image,
            'active' => $active,
        ]);
        return redirect('/category/admin');
    }
}