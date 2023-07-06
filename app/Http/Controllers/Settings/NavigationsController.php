<?php

namespace App\Http\Controllers\settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Navigation;
use Illuminate\Support\Facades\Validator;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class NavigationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu = Navigation::whereNull('parent_id')->paginate(5);
        // $menu = Navigation::with('children')->get()
        // dd($menu->toArray());
        // dump($menu->toArray());
        // die;
        return view('settings.navigations.index', ['menu' => $menu]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // genertae custom id
        $id = IdGenerator::generate(['table' => 'navigations', 'length' => 5, 'prefix' => '01']);
        //define validasi
        $validator = Validator::make($request->all(), [
            'name'  => 'required',
            'url'   => 'required'
        ]);

        //check validasi fail
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // create post data
        $data = Navigation::create([
            'id'        => $id,
            'parent_id' => $request->parent_id,
            'name'      => $request->name,
            'url'       => $request->url,
            'icon'      => $request->icon

        ]);

        // return response
        return response()->json([
            'success'   => true,
            'message'   => 'Data berhasil disimpan!',
            'data'      => $data
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // get detail data
        $data = Navigation::find($id);
        // Fetch all parent navigation items (excluding the current navigation item)
        $parentItems = Navigation::where('id', '!=', $id)->get(['id', 'name']);
        return response()->json([
            'success'   => true,
            'message'   => 'Detail data',
            'data'      => $data,
            'parent_items' => $parentItems
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // define id
        $data = Navigation::find($id);
        //define validasi
        $validator = Validator::make($request->all(), [
            'name'  => 'required',
            'url'   => 'required'
        ]);

        //check validasi fail
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // update data data
        $data->update([
            'name'      => $request->name,
            'url'       => $request->url,
            'icon'      => $request->icon,
            'parent_id' => $request->parent_id
        ]);

        // return response
        return response()->json([
            'success'   => true,
            'message'   => 'Data berhasil disimpan!',
            'data'      => $data
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //delete post by ID
        Navigation::where('id', $id)->delete();

        //return response
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Dihapus!'
        ]);
    }

    // AJAX REQUESTS
    public function getNavigations(Request $request)
    {
        $search = $request->search;
        if ($search == '') {
            $navigation = Navigation::orderby('name', 'asc')->select('id', 'name', 'parent_id')->where('parent_id')->limit(5)->get();
        } else {
            $navigation = Navigation::orderby('name', 'asc')->select('id', 'name', 'parent_id')->where('name', 'like', '%' . $search . '%')->limit(5)->get();
        }
        // create respons
        $response = array();
        foreach ($navigation as $parent) {
            $response[] = array(
                "id"        => $parent->id,
                "text"      => $parent->name,
            );
        }
        return response()->json($response);
    }
}
