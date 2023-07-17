<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;


class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // protected view for reusable
    protected $view_users = 'settings/users/';

    public function index()
    {
        //
        $user = User::latest()->paginate(10);
        return view($this->view_users . 'index', ['user' => $user]);
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
        $validator = Validator::make($request->all(), [
            'name'      => ['required', 'string', 'max:255'],
            'email'     => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'  => ['required', 'min:6', 'confirmed']
        ]);

        //check validasi fail
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // create post data
        $data = User::create([
            'name'          => $request->name,
            'email'         => $request->email,
            'password'      => Hash::make($request->password)

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
        $data = User::find($id);
        return response()->json([
            'success'   => true,
            'message'   => 'Detail data',
            'data'      => $data,
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
        $data = User::find($id);
        //define validasi
        $validator = Validator::make($request->all(), [
            'name'          => ['required', 'string', 'max:255'],
            'email'         => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($id)],
            'password'      => ['nullable', 'min:6', 'confirmed']
        ]);

        //check validasi fail
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // update data data
        $data->update([
            'name'       => $request->name,
            'email'      => $request->email,
            'password'   => Hash::make($request->password)
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
        //delete Users by ID
        User::where('id', $id)->delete();

        //return response
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Dihapus!'
        ]);
    }
}
