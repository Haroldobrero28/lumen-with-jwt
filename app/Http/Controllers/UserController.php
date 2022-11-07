<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth:api');
    }

    public function getAllUser(): JsonResponse
    {

        return response()->json(User::all());
    }

    public function getUser($userId)
    {

        return response()->json(User::find($userId));
    }

    public function updateUser($userId, Request $request)
    {

        try {

            $this->validate($request,[
                'email' => 'required'
            ]);

            User::where('id', $userId)->update($request->only('email'));

            return response()->json(['response' => 'Successfully updated!']);

        } catch (Exception $e) {

            return response()->json([ 'response' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function createUser(Request $request)
    {

        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);

        try {

            $data =[
                'id' => Str::uuid(),
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
                'created_by' => $this->authUser->id,
                'updated_by' => $this->authUser->id,
            ];

            User::create($data);

            return response()->json(['response' => 'Successfully created'], 500);

        } catch (Exception $e){

            return response()->json(['response' => 'Error: '. $e->getMessage()], 500);
        }
    }

    public function deleteUser($userId)
    {

        try {

            $user = User::find($userId);
            $user->deleted_by = $this->authUser->id;
            $user->save();

            $user->delete();
            return response()->json(['response' => 'Successfully deleted'], 500);

        } catch (Exception $e) {

            return response()->json(['response' => 'Error: '. $e->getMessage()], 500);

        }


    }





}
