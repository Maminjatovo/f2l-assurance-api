<?php

namespace App\Http\Controllers;

use App\Models\Contrat;
use App\Models\User;
use Illuminate\Http\Request;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class ContratController extends Controller
{

   /* public function __construct( Request $request)
    {
        if($request->bearerToken()) {
            $this->middleware('auth:api');
        }
    }*/

    public function index($id)
    {
        try {
            $user = User::findOrFail($id);
            $contrats = Contrat::where('user_id', $id)->with('documents')->get();
            return response()->json(['status' => 'success', 'contrats' => $contrats ,'user'=>$user]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }




    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $contrat = new Contrat();
            $contrat->createContrat($request->all());
            return response()->json(['status' => 'success', 'message' => 'Contrat créé avec succès']);
        }catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try{
            $contrat = new Contrat();
            $contrat->deleteContrat($id);
            return response()->json(['status' => 'success', 'message' => 'Contrat supprimé avec succès']);
        }
        catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function updateInfo(Request $request)
    {
        try{
            $contrat = new Contrat();
            $artist = $contrat->updateContrat($request->id, $request->all());
            return response()->json(['status' => 'success', 'message' => 'Contrat mis à jour avec succès'],200);
        }
        catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

}
