<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

// import models
use App\Models\User;


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
        $user = DB::table('users')
                ->leftJoin('role_users', 'users.user_id', '=', 'role_users.user_id')
                ->leftJoin('roles', 'role_users.role_id', '=', 'roles.role_id')
                ->select('users.*', 'roles.role_name')
                ->orderBy('roles.role_name', 'asc')
                ->latest('users.created_at')
                ->paginate(10);

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
            'user_name'             => ['required', 'string', 'max:10'],
            'user_alias'            => ['required', 'string', 'max:255'],
            'user_mail'             => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'role_id'               => ['required', 'exists:roles,role_id'],
            'user_pass'             => ['required', 'min:8'],
            'password_confirmation' => ['required', 'same:user_pass']
        ]);

        //check validasi fail
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // create post data
        $data = User::create([
            'user_id'        => $this->generateUserId(),
            'user_alias'     => $request->user_alias,
            'user_name'      => $request->user_name,
            'user_mail'      => $request->user_mail,
            'user_pass'      => Hash::make($request->user_pass),
            'created_at'     => now(),
        ]);

        // assign role to user
        DB::table('role_users')->insert([
            'user_id'    => $data->user_id,
            'role_id'    => $request->role_id,
            'created_at' => now()
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
        // Get role_id from role_users table
        $role_user = DB::table('role_users')
            ->where('user_id', $user_id)
            ->value('role_id');

        // Get role data for the user
        $role = DB::table('roles')
                ->where('role_id', $role_user)
                ->select('role_id', 'role_name')
                ->first();


        return response()->json([
            'success'   => true,
            'message'   => 'Data berhasil diambil!',
            'data'      => [
                'user'  => $data,
                'role'  => [
                    'role_id'   => $role->role_id ?? null,
                    'role_name' => $role->role_name ?? null
                ]
            ],
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
            'user_name'             => ['required', 'string', 'max:10'],
            'user_alias'            => ['required', 'string', 'max:255'],
            'role_id'               => ['nullable', 'exists:roles,role_id'],
            'user_mail'             => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user_id, 'user_id')],
            'user_pass'             => ['nullable', 'string', 'min:8'],
            'password_confirmation' => ['same:user_pass']
        ]);

        // check validasi fail
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // update user data
        $user_data = [
            'user_name'      => $request->user_name,
            'user_alias'     => $request->user_alias,
            'user_mail'      => $request->user_mail,
        ];

        // Update password jika diberikan
        if ($request->filled('user_pass')&& !empty($request->user_pass)) {
            $user_data['user_pass'] = Hash::make($request->user_pass);
        }

        // Update role if provided
        if ($request->has('role_id')) {
            // Delete existing role assignment
            DB::table('role_users')
                ->where('user_id', $user_id)
                ->delete();
            // Assign new role
            DB::table('role_users')->insert([
                'user_id'    => $user_id,
                'role_id'    => $request->role_id,
                'updated_at' => now()
            ]);
        }

        // Update data
        $data->update($user_data);

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
            'message' => 'Data berhasil dihapus!'
        ]);
    }
}