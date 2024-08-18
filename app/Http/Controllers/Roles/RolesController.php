<?php

namespace App\Http\Controllers\roles;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// import models
use App\Models\Role;

class RolesController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    // AJAX REQUESTS
    public function getRoles(Request $request)
    {
        $search = $request->search;
        if ($search == '') {
            $roles = Role::orderby('role_name', 'asc')->select('role_id', 'role_name')->limit(5)->get();
        } else {
            $roles = Role::orderby('role_name', 'asc')->select('role_id', 'role_name')->where('role_name', 'like', '%' . $search . '%')->limit(5)->get();
        }
        // create response
        $response = array();
        foreach ($roles as $data) {
            $response[] = array(
                "id"        => $data->role_id,
                "text"      => $data->role_name
            );
        }
        return response()->json($response);
    }
}