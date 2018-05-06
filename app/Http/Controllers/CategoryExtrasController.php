<?php

namespace App\Http\Controllers;

use App\Category;
use App\CategoryExtras;
use App\Extra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryExtrasController extends Controller
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
        $extra = Extra::find($id);
        $category_id = DB::table('category_extras')->where('extra_id', $id)->pluck('category_id')->toArray();
        if ($category_id == null) {
            $categories = Category::all();
        } else {
            $categories  = DB::table('categories')
                ->whereNotIn('id', function ($query)use ($id) {
                    $query->select('category_id')
                        ->from('category_extras')
                        ->where('category_extras.extra_id',$id);
                })
                ->get();
        }
        $count =count($categories);
        if ($count == 0) {
            flash('Sorry! This no more Category.')->error();
            return view('categoryExtra.create', compact('extra','categories','count'));
        } else {
            return view('categoryExtra.create', compact( 'extra','categories','count'));
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
        $categories = $request->get('cate_id');
        if (count($categories)>0 ){
            foreach ($categories as $category) {
                $categoryExtra = new CategoryExtras();
                $categoryExtra->extra_id = $request->get('extra_id');
                $categoryExtra->category_id = $category;
                $categoryExtra->save();
            }
        }
        return redirect('/extra/show/' . $request->get('extra_id'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CategoryExtras  $categoryExtras
     * @return \Illuminate\Http\Response
     */
    public function show(CategoryExtras $categoryExtras)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CategoryExtras  $categoryExtras
     * @return \Illuminate\Http\Response
     */
    public function edit(CategoryExtras $categoryExtras)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CategoryExtras  $categoryExtras
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CategoryExtras $categoryExtras)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CategoryExtras  $categoryExtras
     * @return \Illuminate\Http\Response
     */
    public function destroy($cate_id,$extra_id)
    {
        DB::table('category_extras')
            ->where('extra_id', '=', $extra_id)
            ->where('category_id', '=', $cate_id)
            ->delete();
        return back();
    }
}
