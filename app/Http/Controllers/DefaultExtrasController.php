<?php

namespace App\Http\Controllers;

use App\DefaultExtras;
use App\Extra;
use App\Items;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DefaultExtrasController extends Controller
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
        $default_id = DB::table('default_extras')->where('item_id', $id)->get()->pluck('extra_id');
        if ($default_id == null) {
            $defaults= Extra::all();
        } else {
            $defaults = DB::table('extras')
                ->whereNotIn('id',function ($query) use ($id) {
                    $query->select('default_id')
                        ->from('default_extras')
                        ->where('default_extras.item_id',$id);
                })
                ->get();
        }
        $count =count($defaults);
        if ($count == 0) {
            flash('Sorry! This no Default Extra added.')->error();
            return redirect('/items/show/'.$id);
        } else {
            return view('defaults.create', compact('defaults', 'item','count'));
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
        $defaults = $request->get('default_id');
        if (count($defaults)>0){
            foreach ($defaults as $default) {
                $defaultExtras = new DefaultExtras();
                $defaultExtras->item_id = $request->get('item_id');
                $defaultExtras->default_id = $default;
                $defaultExtras->save();
            }
            flash( 'This extra added .')->success();
            return redirect('/items/show/' . $request->get('item_id'));
        }else{
            flash('Sorry! This no Extra added.')->error();
            return redirect('/items/show/' . $request->get('item_id'));
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DefaultExtras  $defaultExtras
     * @return \Illuminate\Http\Response
     */
    public function show(DefaultExtras $defaultExtras)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DefaultExtras  $defaultExtras
     * @return \Illuminate\Http\Response
     */
    public function edit(DefaultExtras $defaultExtras)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DefaultExtras  $defaultExtras
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DefaultExtras $defaultExtras)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DefaultExtras  $defaultExtras
     * @return \Illuminate\Http\Response
     */
    public function destroy($default_id, $item_id)
    {
        DB::table('default_extras')
            ->where('default_extras.item_id', '=', $item_id)
            ->where('default_extras.default_id', '=', $default_id)
            ->delete();
        return back();

    }
}
