<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

   /* public function __construct()
    {
        $this->middleware('auth:api');
    }*/

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $users = User::with('contrats')->get();
            return response()->json(['status' => 'success', 'users' => $users]);
        }
        catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getContrat($id)
    {
        try{
            $users = User::with('contrats')->get();
            return response()->json(['status' => 'success', 'users' => $users]);
        }
        catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function findAllClients()
    {
        try {
            $clients = User::where('is_admin', 0)->get();

            return response()->json(['status' => 'success', 'clients' => $clients]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getDetailsClient($id)
    {
        try {
            $clients = User::where('is_admin', 0)
                        ->where('id', $id)
                        ->get();
            return response()->json(['status' => 'success', 'clients' => $clients]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function searchUser(Request $request)
    {
        try {
            $param = $request->input('key');
            $offset = $request->input('offset');
            $limit = $request->input('limit');
            $users = User::with('contrats');

                if ($param) {
                    $users->where(function ($query) use ($param) {
                        $query->where('email', 'like', "%$param%")
                        ->orWhere('first_name', 'like', "%$param%")
                        ->orWhere('registration_number', 'like', "%$param%")
                        ->orWhere('last_name', 'like', "%$param%");
                    })->orWhereHas('contrats', function ($query) use ($param) {
                        $query->where('title', 'like', "%$param%");
                    });

                }
            $users->orderBy('id', 'desc');
            $userCount = $users->count();
            $users = $users->skip($offset)->take($limit)->get();
            return response()->json(['status' => 'success', 'users' => $users, 'userCount' => $userCount]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            $user = User::findOrFail($id);
            return response()->json(['status' => 'success', 'user' => $user]);
        }
        catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateInfo(Request $request)
    {
        try {
            $user = User::findOrFail($request->id);
            $user->fill($request->only(['first_name',
            'last_name','email','is_admin','registration_number','phone','is_valid'
            ]));
            $user->save();

            return response()->json(['status' => 'success', 'message' => 'Utilisateur mis a jour avec succès', 'user' => $user]);
        } catch (\Illuminate\Validation\ValidationException $exception) {
            $firstError = $exception->validator->getMessageBag()->first();
            return response()->json(['error' => $firstError], 422);
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateEmail(Request $request, $id)
    {
        try {
            $request->validate([
                'email' => 'required|string|email|max:255|unique:users,email,'.$id,
                'password' => 'required|string|min:6',
            ]);

            $user = User::findOrFail($id);
            if (Hash::check($request->password, $user->password)) {
                $user->email = $request->email;
                $user->save();

                return response()->json(['status' => 'success', 'message' => 'Email updated successfully', 'user' => $user]);
            } else {
                return response()->json(['error' => 'Incorrect password'], 401);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request, $id)
    {
        try {
            $request->validate([
                'old_password' => 'required|string|min:6',
                'new_password' => 'required|string|min:6',
            ]);
            $user = User::findOrFail($id);
            if (Hash::check($request->old_password, $user->password)) {
                $user->password = Hash::make($request->new_password);
                $user->save();
                return response()->json(['status' => 'success', 'message' => 'Password updated successfully']);
            } else {
                return response()->json(['error' => 'Incorrect old password'], 401);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $user = User::findOrFail($id);
            $user->delete();
            return response()->json(['status' => 'success', 'message' => 'Utilisateur supprimé avec succès']);
        }
        catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

    }

     /**
     * Restore the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        try {
            $user = User::withTrashed()->findOrFail($id);
            // Vérifier si l'utilisateur est effectivement supprimé
            if ($user->trashed()) {
                $user->restore();
                return response()->json(['status' => 'success', 'message' => 'User restored successfully']);
            } else {
                return response()->json(['error' => 'User not found or not deleted'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
