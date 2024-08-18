<?php

namespace App\Http\Controllers\settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

// import models
use App\Models\Navigation;

class NavigationsController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // protected view for reusable
    protected $view_navigations = 'settings/navigations/';

    public function index()
    {
        $menu = Navigation::whereNull('parent_id')->orderby('nav_no', 'asc')->paginate(5);
        return view($this->view_navigations . 'index', ['menu' => $menu]);
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
        // Custom error messages
        $messages = [
            'nav_title.required' => 'Nama menu wajib diisi!',
            'nav_url.required'   => 'URL wajib diisi!',
        ];

        // Define validation with custom message
        $validator = Validator::make($request->all(), [
            'nav_title'  => 'required',
            'nav_url'   => 'required'
        ], $messages);

        //check validasi fail
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // If parent_id is provided, generate the new ID as a child menu
        if ($request->parent_id) {
            // Get the parent ID
            $parentId = $request->parent_id;

            // Get the latest child ID for this parent
            $latestChild = Navigation::where('nav_id', 'like', $parentId . '%')
                ->whereRaw('LENGTH(nav_id) = ?', [strlen($parentId) + 2]) // Ensure it’s a direct child
                ->orderBy('nav_id', 'desc')
                ->first();

            // Generate new child ID
            if ($latestChild) {
                // Extract the last two digits
                $lastChildId = intval(substr($latestChild->nav_id, -2));

                // Increment by 1 and format to 2 digits
                $newChildId = str_pad($lastChildId + 1, 2, '0', STR_PAD_LEFT);
            } else {
                // If no child exists, start with '01'
                $newChildId = '01';
            }
            // Combine parent ID with the new child ID
            $nav_id = $parentId . $newChildId;
            // Sort for child menu is based on user input
            $sort = $request->nav_no ?? 0;
        } else {
            // If no parent_id is provided, generate new parent ID
            $latestParent = Navigation::whereNull('parent_id')
                ->orderBy('nav_id', 'desc')
                ->first();

            if ($latestParent) {
                // Increment last parent ID
                $nav_id = str_pad(intval($latestParent->nav_id) + 1, 5, '0', STR_PAD_LEFT);
            } else {
                // If no parent exists, start with '01001'
                $nav_id = '01001';
            }
            // Auto-increment sort value for parent menu
            $lastSort = Navigation::whereNull('parent_id')->max('nav_no');
            $sort = $lastSort ? $lastSort + 1 : 1;
        }

        // create post data
        $data = Navigation::create([
            'nav_id'        => $nav_id,
            'parent_id'     => $request->parent_id,
            'nav_title'     => $request->nav_title,
            'nav_url'       => $request->nav_url,
            'nav_icon'      => $request->nav_icon,
            'nav_no'        => $sort,
            'nav_desc'      => $request->nav_desc,
            'display_st'    => $request->display_st
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
     * @param  int  $nav_id
     * @return \Illuminate\Http\Response
     */
    public function show($nav_id)
    {
        // get detail data
        $data = Navigation::find($nav_id);
        // Fetch all parent navigation items (excluding the current navigation item)
        $parentItems = Navigation::where('nav_id', '!=', $nav_id)->get(['nav_id', 'nav_title']);
        return response()->json([
            'success'       => true,
            'message'       => 'Data berhasil diambil!',
            'data'          => $data,
            'parent_items'  => $parentItems
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $nav_id
     * @return \Illuminate\Http\Response
     */
    public function edit($nav_id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $nav_id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $nav_id)
    {
        // define id
        $data = Navigation::find($nav_id);

        // Custom error messages
        $messages = [
            'nav_title.required' => 'Nama menu wajib diisi!',
            'nav_url.required'   => 'URL wajib diisi!',
        ];

        //define validasi
        $validator = Validator::make($request->all(), [
            'nav_title'  => 'required',
            'nav_url'   => 'required'
        ], $messages);

        //check validasi fail
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Check menu as parent or child
        if ($data->parent_id === null && !empty($request->parent_id)) {
            // Case: Menu is currently a parent and is being changed to a child
            $parentId = $request->parent_id;

            // Get the latest child ID for the selected parent
            $latestChild = Navigation::where('nav_id', 'like', $parentId . '%')
                ->whereRaw('LENGTH(nav_id) = ?', [strlen($parentId) + 2]) // Ensure it’s a direct child
                ->orderBy('nav_id', 'desc')
                ->first();

            // Generate new child ID
            if ($latestChild) {
                $lastChildId = intval(substr($latestChild->nav_id, -2));
                $newChildId = str_pad($lastChildId + 1, 2, '0', STR_PAD_LEFT);
            } else {
                $newChildId = '01';
            }

            // Combine parent ID with the new child ID
            $newId = $parentId . $newChildId;

            // Update the data with the new child ID and new parent_id
            $data->update([
                'nav_id'        => $newId,
                'parent_id'     => $parentId,
                'nav_title'     => $request->nav_title,
                'nav_url'       => $request->nav_url,
                'nav_icon'      => $request->nav_icon,
                'nav_no'        => $request->nav_no,
                'nav_desc'      => $request->nav_desc,
                'display_st'    => $request->display_st
            ]);
        } elseif ($data->parent_id !== null && empty($request->parent_id)) {
            // Case: Menu is currently a child and is being changed to a parent

            // Update nav_no to the next available value for parent menus
            $latestParent = Navigation::whereNull('parent_id')
            ->orderBy('nav_no', 'desc')
            ->first();

            $nav_no = $latestParent ? $latestParent->nav_no + 1 : 1;

            // Generate new parent ID
            $latestParent = Navigation::whereNull('parent_id')
                ->orderBy('nav_id', 'desc')
                ->first();

            if ($latestParent) {
                $newId = str_pad(intval($latestParent->nav_id) + 1, 5, '0', STR_PAD_LEFT);
            } else {
                $newId = '01001';
            }

            $data->update([
                'nav_id'        => $newId,
                'parent_id'     => null,
                'nav_title'     => $request->nav_title,
                'nav_url'       => $request->nav_url,
                'nav_icon'      => $request->nav_icon,
                'nav_no'        => $nav_no,
                'nav_desc'      => $request->nav_desc,
                'display_st'    => $request->display_st
            ]);
        } else {
            // If there is no change in parent_id, only update other fields
            $data->update([
                'nav_title'     => $request->nav_title,
                'nav_url'       => $request->nav_url,
                'nav_icon'      => $request->nav_icon,
                'parent_id'     => $request->parent_id,
                'nav_no'        => $request->nav_no,
                'nav_desc'      => $request->nav_desc,
                'display_st'    => $request->display_st
            ]);
        }

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
     * @param  int  $nav_id
     * @return \Illuminate\Http\Response
     */
    public function destroy($nav_id)
    {
        //delete post by ID
        Navigation::where('nav_id', $nav_id)->delete();

        //return response
        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus!'
        ]);
    }

    // AJAX REQUESTS
    public function getNavigations(Request $request)
    {
        $search = $request->search;
        if ($search == '') {
            $navigation = Navigation::orderby('nav_no', 'asc')->select('nav_id', 'nav_title', 'parent_id')->where('parent_id')->limit(5)->get();
        } else {
            $navigation = Navigation::orderby('nav_no', 'asc')->select('nav_id', 'nav_title', 'parent_id')->where('nav_title', 'like', '%' . $search . '%')->limit(5)->get();
        }
        // create response
        $response = array();
        foreach ($navigation as $parent) {
            $response[] = array(
                "id"        => $parent->nav_id,
                "text"      => $parent->nav_title,
            );
        }
        return response()->json($response);
    }
}