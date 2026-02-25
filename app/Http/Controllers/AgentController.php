<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\AgentAccountMail;
use App\Models\Arret;
use App\Models\Compagnies;
use App\Models\Paiement;
use App\Models\TarificationMontantVoyage;
use App\Models\Utilisateur;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AgentController extends Controller
{
    /**
     * Display a listing of the agents.
     */
// public function index(Request $request)
// {
//     $query = Agent::query();
    
//     if ($request->has('date_debut') && $request->date_debut) {
//         $query->whereDate('created_at', '>=', $request->date_debut);
//     }
    
//     if ($request->has('date_fin') && $request->date_fin) {
//         $query->whereDate('created_at', '<=', $request->date_fin);
//     }
    
//     $agents = $query->get();
    
//     return view('compagnie.agents.index', compact('agents'));
// }

public function index(Request $request)
{
      $user = Auth::user();
      if($user->info_user->gare){
       $query = Agent::with(['compagnie', 'gares'])->where('gare_id', $user->info_user->gare->id);
      }if($user->info_user->compagnie){
       $query = Agent::with(['compagnie', 'gares'])->where('compagnie_id', $user->info_user->compagnie->id);
      }
    // dd($user->info_user->gare , $user->info_user->compagnie);
    // $query = Agent::with(['compagnie', 'gares']);
    
    if ($request->filled('date_debut')) {
        $query->whereDate('created_at', '>=', $request->date_debut);
    }

    if ($request->filled('date_fin')) {
        $query->whereDate('created_at', '<=', $request->date_fin);
    }
    if($request->filled('role_personnel')) {
        $query->where('role_personnel', $request->role_personnel);
    }
    if($request->filled('status')) {
        $query->where('status', $request->status);
    }
    $agents = $query->get();
// dd($agents);
    return view('compagnie.agents.index', compact('agents'));
}

    /**
     * Show the form for creating a new agent.
     */
    public function create()
    {
        return view('compagnie.agents.create');
    }

    /**
     * Store a newly created agent in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:agents',
            // 'role_personnel' => 'required|string',
            'role_personnel' => 'required|in:controleur,manager,directeur,comptable,assistant_admin,chauffeur,receveur,chef_gare,planificateur,agent_vente,caissier,service_client,technicien,mecanicien,electricien,informaticien,gardien,vigile,chef_securite,nettoyeur',
        ],[
            'nom.required' => 'Le nom est obligatoire.',
            'prenom.required' => 'Le prénom est obligatoire.',
            'email.required' => 'L’email est obligatoire.',
            'email.email' => 'L’email doit être valide.',
            'email.unique' => 'Cet email est déjà utilisé.',
            'role_personnel.required' => 'Le rôle de l’agent est obligatoire.',
            'role_personnel.in' => 'Le rôle sélectionné est invalide.',
        ]);

        // Génération d'un mot de passe aléatoire de 4 caractères
        $password = strtoupper(Str::random(4));
    
        $validated['password'] = Hash::make($password);
        $validated['token'] = Str::random(60);
        $validated['status'] = 'actif';
        if($user->info_user->compagnie){
            $validated['compagnie_id'] = $user->info_user->compagnie->id;
        }
        if($user->info_user->gare){
            $validated['gare_id'] = $user->info_user->gare->id;
            $validated['compagnie_id'] = $user->info_user->gare->compagnie->id;
        }
        // dd($validated , $user->info_user->compagnie , $user->info_user->gare , $user );
        $agent = Agent::create($validated);
        $recupere_compagnie = Compagnies::where('id', $agent->compagnie_id)->first();
        // dd($agent , $password , $recupere_compagnie);
        // Envoi de l'email de création de compte
        if($agent->role_personnel == 'controleur'){
            Mail::to($agent->email)->send(
                new AgentAccountMail(
                    $agent,
                    $password,
                    $recupere_compagnie,
                    'Création de votre compte', 
                    'emails.agents.created'
                )
            );
        }

        return redirect()->route('agents.index')
        ->with('success', 'Agent créé avec succès. Un email a été envoyé avec les informations de connexion.');
    }

    /**
     * Display the specified agent.
     */
    public function show(Agent $agent)
    {
        // $liste_des_reservaion_valider_par_cette_agent = Reservation::with('paiement,arret.tarification.villeDepart,arret.tarification.villeArrivee')->where('agents_id', $agent->id)->get();
        $liste_des_reservaion_valider_par_cette_agent = Reservation::with([
    'paiement',
    'arret.tarification.villeDepart',
    'arret.tarification.villeArrivee'
])->where('agents_id', $agent->id)->get();
        // dd($agent ,$liste_des_reservaion_valider_par_cette_agent );
        return view('compagnie.agents.show', compact('agent', 'liste_des_reservaion_valider_par_cette_agent'));
    }

    /**
     * Show the form for editing the specified agent.
     */
    public function edit(Agent $agent)
    {
        return view('compagnie.agents.edit', compact('agent'));
    }

    /**
     * Update the specified agent in storage.
     */
    public function update(Request $request, Agent $agent)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:agents,email,' . $agent->id,
            'password' => 'nullable|string|min:2|confirmed',
            'role_personnel' => 'required|in:controleur,manager,directeur,comptable,assistant_admin,chauffeur,receveur,chef_gare,planificateur,agent_vente,caissier,service_client,technicien,mecanicien,electricien,informaticien,gardien,vigile,chef_securite,nettoyeur',
            'status' => 'required|in:actif,desactif',
        ],[
            'nom.required'      => 'Le nom est obligatoire.',
            'prenom.required'   => 'Le prénom est obligatoire.',
            'email.required'    => 'L’adresse email est obligatoire.',
            'email.email'       => 'Veuillez entrer une adresse email valide.',
            'email.unique'      => 'Cette adresse email est déjà utilisée.',
            'password.min'      => 'Le mot de passe doit contenir au moins 2 caractères.',
            'password.confirmed'=> 'La confirmation du mot de passe ne correspond pas.',  
        ]);

        $recupere_compagnie = Compagnies::where('id', $agent->compagnie_id)->first();

        $statusChanged = $agent->status !== $validated['status'];
        $password = null;

        // Si le statut change ou si un nouveau mot de passe est fourni
        if ($statusChanged || !empty($validated['password'])) {
            if (!empty($validated['password'])) {
                $password = $validated['password'];
                $validated['password'] = Hash::make($validated['password']);
            } elseif ($statusChanged && $validated['status'] === 'actif') {
                // Génération d'un nouveau mot de passe si le compte est réactivé
                $password = strtoupper(Str::random(4));
                $validated['password'] = Hash::make($password);
            }
        } else {
            unset($validated['password']);
        }

          if($user->info_user->compagnie){
            $validated['compagnie_id'] = $user->info_user->compagnie->id;
        }
        if($user->info_user->gare){
            $validated['gare_id'] = $user->info_user->gare->id;
            $validated['compagnie_id'] = $user->info_user->gare->compagnie->id;
        }

        $agent->update($validated);

        // Envoi d'email si le statut a changé ou si un nouveau mot de passe a été défini
        if ($statusChanged || isset($password)) {
            $subject = $statusChanged 
                ? ($agent->status === 'actif' ? 'Activation de votre compte agent' : 'Désactivation de votre compte agent')
                : 'Mise à jour de votre mot de passe';
            
            $template = 'emails.agents.status-changed';
            
            Mail::to($agent->email)->send(
                new AgentAccountMail(
                    // $agent,
                    // $password,
                    // $subject,
                    // $template,
                    // $recupere_compagnie
                    $agent,
                    $request->password,
                    $recupere_compagnie,
                    'Mise ajoute de votre mot de passe', 
                    'emails.agents.status-changed'
                )
            );
        }

        $message = 'Agent mis à jour avec succès.';
        if ($statusChanged || isset($password)) {
            $message .= ' Un email a été envoyé .';
        }

        return redirect()->route('agents.index')
                         ->with('success', $message);
    }

    /**
     * Remove the specified agent from storage.
     */
    public function destroy(Agent $agent)
    {
        $agent->delete();
        return redirect()->route('agents.index')
                         ->with('success', 'Agent supprimé avec succès.');
    }


// Dans app/Http/Controllers/AgentController.php
// Ajoutez cette méthode à la fin de la classe, avant la dernière accolade
// Dans AgentController.php
public function toggleStatus(Agent $agent)
{
    $agent->update([
        'status' => $agent->status === 'actif' ? 'inactif' : 'actif'
    ]);

    return back()->with('success', 'Statut du personnel mis à jour avec succès');
}


public function scanner_ticket(Request $request)
{
    // ✅ Validation correcte
    $validated = $request->validate([
        'token' => 'required',
        'id_reservation' => 'required',
    ]);
    // ✅ Récupération de l’agent via le token
    $agent = Agent::where('token', $validated['token'])->first();
    
    if (!$agent) {
        return response()->json([
            'success' => false,
            'message' => 'Agent introuvable.'
        ], 404);
    }
    
    // ✅ Récupération de la réservation
    $reservation = Reservation::with(['gares','utilisateur','paiement'])->where('id', $validated['id_reservation'])->first();
    $arret = Arret::where('id', $reservation->id_arret_voayage)->first();
    $tarrification = TarificationMontantVoyage::with(['villeDepart','villeArrivee','compagnie','classe'])->where('id' ,$arret->id_tarrification_voyage)->first();
    // ✅ Vérification si déjà scanné
    if ($reservation->status == 1) {
        return response()->json([
            'success' => false,
            'message' => 'Ticket déjà scanné.',
        ], 200);
    }
    
    $reservation->update([
        'status' => 1,
        'agents_id' => $agent->id
        //   'status' => 2,
        // 'agents_id' => $agent->id
    ]);

    return response()->json([
        'success' => true,
        'message' => 'Ticket scanné avec succès.',
        'reservation' => $reservation,
        'tarrification' => $tarrification
    ], 200);
}

public function scanner_ticket_avec_code(Request $request)
{
    // ✅ Validation correcte
    $validated = $request->validate([
        'token' => 'required',
        'numero_reservation' => 'required',
    ]);
    // ✅ Récupération de l’agent via le token
    $agent = Agent::where('token', $validated['token'])->first();
    
    if (!$agent) {
        return response()->json([
            'success' => false,
            'message' => 'Agent introuvable.'
        ], 404);
    }

    
    
    // ✅ Récupération de la réservation
    $reservation = Reservation::with(['gares','utilisateur','paiement'])->where('numero_reservation', $validated['numero_reservation'])->first();
    if(!$reservation){
        return response()->json([
            'success' => false,
            'message' => 'Ce numero de reservation n\'existe pas.'
        ], 200);
    }
    $arret = Arret::where('id', $reservation->id_arret_voayage)->first();
    $tarrification = TarificationMontantVoyage::with(['villeDepart','villeArrivee','compagnie','classe'])->where('id' ,$arret->id_tarrification_voyage)->first();
    // ✅ Vérification si déjà scanné
    if ($reservation->status == 1) {
        return response()->json([
            'success' => false,
            'message' => 'Ticket déjà scanné ou validé.',
        ], 200);
    }
    
    $reservation->update([
        // 'status' => 1,
        // 'agents_id' => $agent->id
        'status' => 1,
        'agents_id' => $agent->id
    ]);

    return response()->json([
        'success' => true,
        'message' => 'Ticket scanné avec succès.',
        'reservation' => $reservation,
        'tarrification' => $tarrification
    ], 200);
}


public function login(Request $request)
{
    // Validation
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    // Vérifier si l’agent existe
    $agent = Agent::with(['compagnie','gares'])->where('email', $request->email)->first();

    if (!$agent) {
        return response()->json([
            'success' => false,
            'message' => 'Information incorrecte'
        ], 200);
    }

    // Vérifier le mot de passe
    if (!Hash::check($request->password, $agent->password)) {
        return response()->json([
            'success' => false,
            'message' => 'Information incorrecte'
        ], 200);
    }

    // Succès
        return response()->json([
            'success' => true,
            'message' => 'Connexion réussie',
            'agent' => $agent
        ], 200);
}

public function connexion_rapide_qrcode ($token){
    $agent = Agent::with(['compagnie','gares'])->where("token",$token)->first();

     if (!$agent) {
        return response()->json([
            'success' => false,
            'message' => 'QR code invalide ou non reconnu par Detro'
        ], 200);
    }

    return response()->json([
        'success' => true,
        'message' => 'Connexion réussie',
        'agent' => $agent
    ], 200);
}

public function verifier_token_user_existe(Request $request)
{
    $request->validate([
        'token' => 'required',
    ]);
    $agent = Agent::where('token', $request->token)->first();

    if (!$agent) {
        return response()->json([
            'exists' => false,
            'message' => 'Token invalide'
        ], 200);
    }

    return response()->json([
        'exists' => true,
        'agent' => $agent
    ], 200);
}


// public function liste_deja_reservation_effectuer($token)
// {

//     // ✅ Récupération de l’agent via le token
//     $agent = Agent::where('token', $token)->first();
    
//     if (!$agent) {
//         return response()->json([
//             'success' => false,
//             'message' => 'Agent introuvable.'
//         ], 404);
//     }

//     // ✅ Récupération de la réservation
//     $reservation = Reservation::with(['gares','utilisateur','paiement'])->where('agents_id', $agent->id)->get();

//     $arret = Arret::where('id', $reservation->id_arret_voayage)->first();
//     $tarrification = TarificationMontantVoyage::with(['villeDepart','villeArrivee','compagnie','classe'])->where('id' ,$arret->id_tarrification_voyage)->first();
  

//     return response()->json([
//         'success' => true,
//         'message' => 'Ticket scanné avec succès.',
//         'reservation' => $reservation,
//         'tarrification' => $tarrification
//     ], 200);
// }

public function liste_deja_reservation_effectuer($token)
{
    // ✅ Récupération de l’agent via le token
    $agent = Agent::where('token', $token)->first();
    // return response()->json([
    // 'liste_deja_reservation_effectuer'=>"test",
    // 'token'=>$token,
    // 'agent'=>$agent
    // ]);

    if (!$agent) {
        return response()->json([
            'success' => false,
            'message' => 'Agent introuvable.'
        ], 404);
    }

    // ✅ Récupération de TOUTES les réservations de l’agent
    $reservations = Reservation::with([
        'gares',
        'utilisateur',
        'paiement',
        'arret.tarification.villeDepart',
        'arret.tarification.villeArrivee',
        'arret.tarification.compagnie',
        'arret.tarification.classe',
    ])->where('agents_id', $agent->id)->where('status',1)->orderBy('created_at', 'desc')->get();

    return response()->json([
        'success' => true,
        'message' => 'Liste des réservations récupérée avec succès.',
        'total' => $reservations->count(),
        'reservations' => $reservations
    ], 200);
}


// public function statistique(Request $request){

//     $request->validate([
//         'token' => 'required',
//         'date_debut' => 'required',
//         'date_fin' => 'required',
//     ]);

//     $agent = Agent::where('token', $request->token)->first();
//     if(!$agent){
//         return response()->json([
//             'success' => false,
//             'message' => 'Agent introuvable.'
//         ], 404);
//     }
//     $reservations = Reservation::where('agents_id', $agent->id)->where('status',1)->orderBy('created_at', 'desc')->get();

//     $tulisaeur =Utilisateur::where('id', $agent->utilisateurs_id)->get();

//     $paiement = Paiement::where('id', $agent->compagnies_id)->where('status',1)->orderBy('created_at', 'desc')->get();
// }

// public function statistique(Request $request)
// {
//     $request->validate([
//         'token' => 'required',
//     ]);

//     // 🔎 Récupération de l’agent
//     $agent = Agent::where('token', $request->token)->first();
//     if (!$agent) {
//         return response()->json([
//             'success' => false,
//             'message' => 'Agent introuvable.'
//         ], 404);
//     }

//     $reservation = Reservation::where('agents_id', $agent->id)->where('status',1)->orderBy('created_at', 'desc')->get();
//     $nombreReservation = $reservation->count();

//     $paiement = Paiement::where('id', $agent->paiements_id)->get();
  
//     $nombrePaiement = $paiement->count();

//     return response()->json([
//     'nombreReservation'=>$nombreReservation,
//     'nombrePaiement'=>$nombrePaiement,
//     'paiement'=>$paiement
//     ]);
// }

public function statistique(Request $request)
{
    $request->validate([
        'token' => 'required',
    ]);

    // 🔎 Récupération de l’agent
    $agent = Agent::where('token', $request->token)->first();

    if (!$agent) {
        return response()->json([
            'success' => false,
            'message' => 'Personnel introuvable.'
        ], 404);
    }

    // 📊 Nombre de réservations validées
    $nombreReservations = Reservation::where('agents_id', $agent->id)
        ->where('status', 1)
        ->get();

        
        // 💳 Paiement associé à l’agent
        // $paiement = Paiement::where('id',$nombreReservations->paiements_id)->get();
        // récupérer tous les paiements liés aux réservations
$paiementIds = $nombreReservations->pluck('paiements_id');

$paiement = Paiement::whereIn('id', $paiementIds)->get();
        $nombreReservation = $nombreReservations->count();

    return response()->json([
        'success'            => true,
        'nombreReservation' => $nombreReservation,
        'nombrePaiement'    => $paiement->count(),
        'montant_total'=>$paiement->sum('montant'),
        //'$agent->paiements_id'=>$nombreReservations,
    ]);
}



public function liste_des_client($token)
{
    // 🔎 Récupération de l’agent via le token
    $agent = Agent::where('token', $token)->first();
    if (!$agent) {
        return response()->json([
            'success' => false,
            'message' => 'Personnel introuvable.'
        ], 404);
    }
    
    // 📊 Liste des clients avec nombre de réservations
    $clients = Reservation::select('utilisateurs_id', DB::raw('COUNT(*) as total_reservations'))
        ->where('agents_id', $agent->id)
        ->where('status', 1)
        ->groupBy('utilisateurs_id')
        ->with('utilisateur')
        ->orderByDesc('total_reservations')
        ->get();

    return response()->json([
        'success' => true,
        'data' => $clients
    ]);
}

public function modifierMotDePasseAgent(Request $request)
{
    $request->validate([
        'token'=>'required',
        'password' => 'required',
    ]);

    $agent = Agent::where('token',$request->token)->first();
    if(!$agent){
        return response()->json([
            'success' => false,
            'message' => 'Personnel introuvable.'
        ], 404);
    }

    $agent->password = Hash::make($request->password);
    $agent->save();

    return response()->json([
        'success' => true,
        'message' => 'Mot de passe modifié avec succès',
    ], 200);
}

public function trouver_agent_via_token($token)
{
    $agent = Agent::where('token', $token)->first();

    if (!$agent) {
        return response()->json([
            'success' => false,
            'message' => 'Personnel introuvable ou token invalide',
        ], 404);
    }

    return response()->json([
        'success' => true,
        'data' => $agent,
    ], 200);
}



}
