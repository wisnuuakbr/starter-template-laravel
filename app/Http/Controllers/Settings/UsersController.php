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
        $user = User::latest()->paginate(10);
        return view($this->view_users . 'index', ['user' => $user]);
    }

    //  Generate the ID for Users
    private function generateUserId()
    {
        // Get last user_id from db
        $lastUser = User::orderBy('user_id', 'desc')->first();

        // If user == empty create id from '01001'
        if (!$lastUser) {
            return '01001';
        }

        // Get last id, increment +1
        $lastId = intval($lastUser->user_id);
        $newId = str_pad($lastId + 1, 5, '0', STR_PAD_LEFT);

        return $newId;
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
            'user_name' => ['required', 'string', 'max:10'],
            'user_full_name' => ['required', 'string', 'max:255'],
            'user_mail' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'user_pass' => ['required', 'min:8'],
            'password_confirmation' => ['required', 'same:user_pass']
        ]);

        //check validasi fail
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // create post data
        $data = User::create([
            'user_id'        => $this->generateUserId(),
            'user_name'      => $request->user_name,
            'user_full_name' => $request->user_full_name,
            'user_mail'      => $request->user_mail,
            'user_pass'      => Hash::make($request->user_pass)

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
     * @param  int  $user_id
     * @return \Illuminate\Http\Response
     */
    public function show($user_id)
    {
        // get detail data
        $data = User::find($user_id);
        return response()->json([
            'success'   => true,
            'message'   => 'Detail data',
            'data'      => $data,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $user_id
     * @return \Illuminate\Http\Response
     */
    public function edit($user_id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $user_id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $user_id)
    {
        // define id
        $data = User::findOrFail($user_id);
        //define validasi
        $validator = Validator::make($request->all(), [
            'user_name' => ['required', 'string', 'max:10'],
            'user_full_name' => ['required', 'string', 'max:255'],
            'user_mail' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user_id, 'user_id')],
            'user_pass' => ['nullable', 'string', 'min:8'],
            'password_confirmation' => ['same:user_pass']
        ]);

        //check validasi fail
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // update field data
        $updateData = [
            'user_name'      => $request->user_name,
            'user_full_name' => $request->user_full_name,
            'user_mail'      => $request->user_mail,
        ];

        // Update password jika diberikan
        if ($request->filled('user_pass')&& !empty($request->user_pass)) {
            $updateData['user_pass'] = Hash::make($request->user_pass);
        }

        // Update data
        $data->update($updateData);

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
     * @param  int  $user_id
     * @return \Illuminate\Http\Response
     */
    public function destroy($user_id)
    {
        //delete Users by ID
        User::where('user_id', $user_id)->delete();

        //return response
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Dihapus!'
        ]);
    }
}