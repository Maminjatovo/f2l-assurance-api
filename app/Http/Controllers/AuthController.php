<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
   /* public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','register']]);
    }*/


    public function checkToken(Request $request)
    {
        $token = $request->bearerToken();
        if ($token) {
            return response()->json(['token' => $token]);
        } else {
            return response()->json(['message' => 'Aucun jeton n\'est présent dans la requête.'], 401);
        }
    }

    public function login(Request $request)
    {
       try{
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $credentials = $request->only('email', 'password');

        $token = Auth::attempt($credentials);
        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Mot de passe ou email invalide',
            ], 401);
        }
        $user = Auth::user();
        $data= [
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'is_admin' => $user->is_admin,
        ];
        $generateToken = Auth::claims($data)->attempt($credentials);
        return response()->json([
                'status' => 'success',
                'user' => $user,
                'authorisation' => [
                    'token' => $generateToken,
                    'type' => 'bearer',
                ]
            ]);
       }catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        try {

                $request->validate([
                    'email' => 'required|string|email|max:255|unique:users',
                    'password' => 'required|string|min:6',
                    'first_name' => 'required|string|min:3',
                    'last_name' => 'required|string|max:255'
                ], [
                    'email.required' => 'Le champ email est requis.',
                    'email.email' => 'L\'email doit être une adresse email valide.',
                    'email.unique' => 'L\'adresse email est déjà utilisée.',
                    'password.required' => 'Le champ mot de passe est requis.',
                    'password.min' => 'Le mot de passe doit avoir au moins :min caractères.',
                    'first_name.required' => 'Le champ prénom est requis.',
                    'first_name.min' => 'Le nom doit contenir au moins :min caractères.',
                    'last_name.required' => 'Le champ nom est requis.',
                    'last_name.min' => 'Le prénom doit avoir au moins :min caractères.'
                ]);

            $user = User::create([
                'is_admin' => $request->is_admin,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'registration_number' => $request->registration_number,
                'phone' => $request->phone,
                'is_valid' => $request->is_valid
            ]);

            $token = Auth::login($user);

            return response()->json([
                'status' => 'success',
                'message' => 'User created successfully',
                'user' => $user,
                'authorisation' => [
                    'token' => $token,
                    'type' => 'bearer',
                ]
            ]);

        } catch (\Illuminate\Validation\ValidationException $exception) {
            $firstError = $exception->validator->getMessageBag()->first();
            return response()->json(['error' => $firstError], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function logout()
    {
        try{
            Auth::logout();
            return response()->json([
                'status' => 'success',
                'message' => 'Successfully logged out',
            ]);
        }
        catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

    }

    public function refresh()
    {
        try{
            return response()->json([
                'status' => 'success',
                'user' => Auth::user(),
                'authorisation' => [
                    'token' => Auth::refresh(),
                    'type' => 'bearer',
                ]
            ]);
        }
        catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
