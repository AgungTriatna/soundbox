<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
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
        try {
            $user = User::findOrFail($id);

            return response()->json(['user' => $user], 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something went wrong in UserController.show',
                'error' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    
    {
    //     $user = User::find($id);
    //     if (!$user) {
    //         return response()->json([
    //             'message' => 'User not found',
    //             'statusCode' => 404,
    //         ], 404);
    //     }

    //     $v = Validator::make($request->all(), [
    //         'name' => 'required|string',
    //         'email' => 'required|email',
    //         'password' => 'required|string'
    //         // 'role' => 'required|in:admin,user'
    //     ]);

    //     if ($v->fails()) {
    //         return response()->json([
    //             'message' => 'Invalid data',
    //             'statusCode' => 400,
    //         ], 400);
    //     }


    //     $user->update($request->all());
    //     return response()->json([
    //         'message' => 'Update user successful',
    //         'statusCode' => 200,
    //         'data' => $user,
    //     ], 200);

    {
        try {
            $user = User::findOrFail($id);

            // if ($request->hasFile('image')) {
            //     (new ImageService)->updateImage($user, $request, '/images/users/', 'update');
            // }

            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = $request->password;

            $user->save();

            return response()->json('User details updated', 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something went wrong in UserController.update',
                'error' => $e->getMessage()
            ], 400);
        }
    }
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
}
