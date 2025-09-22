<?php

namespace App\Http\Controllers;

use App\Models\ArretVoyage;
use App\Models\Paiement;
use App\Models\PaiementEnAttente;
use App\Models\Utilisateur;
use App\Models\Voyage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

class PaiementEnAttenteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

private function generateRandomString($length = 10) {
$characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
$randomString = '';

for ($i = 0; $i < $length; $i++) {
$randomString .= $characters[rand(0, strlen($characters) - 1)];
}

return $randomString;
}


    public function InitiationPaiement(Request $request)
    {
           
        // Récupérer l'utilisateur connecté
        // $user = Auth::user();
        // Récupérer la taxe basée sur l'ID
    $request->validate([
    'token' => 'required|string', // correction de 'requried' -> 'required' et on précise le type
    'voyage_id' => 'nullable|integer', // on précise que c'est facultatif et que c'est un entier
    'id_arret_voayage' => 'required|integer|min:1',
    ]);

   $utilisateur = Utilisateur ::where('token', $request->token)->first();

    $voyage = Voyage::where('id', $request->voyage_id)->first();

            if (!$utilisateur) {
            return response()->json([
                'success' => false,
                'message' => 'Utilisateur non trouvé pour ce token.'
            ], 404);
        }

        $voyage = Voyage::where('id', $request->voyage_id)->first();
        if (!$voyage) {
            return response()->json([
                'success' => false,
                'message' => 'Voyage non trouvé pour cet ID.'
            ], 404);
        }

    $id_arret_voayage = $request->input('id_arret_voayage');
    $arret_voyages = ArretVoyage::find($id_arret_voayage);
    if (!$arret_voyages) {
        return response()->json([
            'message'=> 'Arret voyage non trouvé',
            ], 404);
    }
        // Récupérer l'installation associée à la taxe
        // $installation = Installation::where('user_id', $taxe->id_installation)->first();

        $codePaiement = $this->generateRandomString();

        $verifier = PaiementEnAttente::where('code', $codePaiement)->first();
        
        if ($verifier) {
            return response()->json([
                'success' => false,
                'message' => 'Cette demande de paiement existe déjà.'
            ], 409); // 409 = conflit
        }

         $data = [
            'code_paiement' => $codePaiement,
            //  'credential_id' => "llnal6ched", // code unique donnee pour mes acces a la plateforme
             'nom_usager' => $utilisateur->nom,
             'prenom_usager' => $utilisateur->prenom,
             'telephone' => $utilisateur->telephone,
             'email' => $utilisateur->email,
             'libelle_article' => "test fsfd zfdzdf efzee edfdezf",
             'quantite' => 1,
             'montant' => $arret_voyages->montant,
             'lib_order' => "test efzef edfzef efezf",
            'Url_Logo' =>  asset('photo_personnel/1758024064_logo_bus.png'),
            'pay_fees' => 1,
            'Url_Retour' => 'https://127.0.0.1:8000/login_connexion',
            'Url_Callback' => 'https://127.0.0.1:8000/api/retour_du_paiement',
            // 'Url_Retour' => 'https://127.0.0.1:8000/',
            // 'Url_Callback' => route('retour_du_paiement'),
        ];
    
        // $reponse = Http::post('https://rest-airtime.paysecurehub.com/api/payhub-ws/build-away', $data);
        $reponse = Http::withHeaders(['MerchantId' => 'llnal6ched', 'ApiKey' => 'shk_nDgSnvDpGa9ZEvtruZzxpO7gaSfP9qOJCfyh'])
                ->post('http://rest-airtime.paysecurehub.com/api/payhub-ws/build-away', $data);

        $ResJSON = $reponse->json();
            //     return response()->json([
            //    'success' => false,
            //    'message' => 'teste',
            //    'data'=> $ResJSON,
            //    'response'=> $reponse,
            //    'code'  =>$codePaiement,
            //    'montant'=>$voyage->montant,
            //    'body'=>$data
            //      ], 200); // 409 = conflit

        if ($reponse->status()===200) {
            if ($ResJSON['code']===200){
                // Redirection sur le hub de paiement
                if (!empty($ResJSON['url'])){
                     return response()->json([
                        "success"=> true,
                        "url"=> $ResJSON["url"],
                        ],200);
                    // return redirect()->away($ResJSON['url']);
                }else{
                    $mess = "Echec d'authentification pour acceder à la page demandée !";
                    // toas($mess,'success');
                    // return redirect()->back();
                    return response()->json([
                        "success"=> true,
                        "message"=> $mess
                        ],200);
                }
            }else{
            return response()->json([
            'success' => false,
            'message' => $ResJSON['message']
        ]);
            }
        }else{
            $mess = 'Une erreur inattendue s\'est produite, verifier que vous ' .
            'avez accès à internet, puis reéssayer. erreur ' . $reponse->status().', impossible de joindre l\'hôte !';
            // toast($mess,'error');
            return redirect()->back();
        }

        // dd($user, $taxe, $installation);
    }



    public function retour_du_paiement(Request $request){
    }

}


