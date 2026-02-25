<?php

namespace App\Http\Controllers;

use App\Models\Chauffeur;
use App\Models\Compagnies;
use App\Models\Connexion;
use App\Http\Requests\StoreConnexionRequest;
use App\Http\Requests\UpdateConnexionRequest;
use App\Models\Bus;
use App\Models\ConfigWebMobile;
use App\Models\gare;
use App\Models\Itineraire;
use App\Models\Paiement;
use App\Models\Reservation;
use App\Models\Utilisateur;
use App\Models\User;
use App\Models\Voyage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ConnexionController extends Controller
{
    public function acceuil()
    { 
        $config = ConfigWebMobile::first();
        $imageAcceuilWeb = $config?->image_acceuil_web;
        $sousImageAcceuilWeb = $config?->sous_image_acceuil_web;
        return view('acceuil.acceuil', compact('config', 'imageAcceuilWeb', 'sousImageAcceuilWeb'));
    }
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
    public function store(StoreConnexionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Connexion $connexion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Connexion $connexion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateConnexionRequest $request, Connexion $connexion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Connexion $connexion)
    {
        //
    }

    //   public function login(Request $request)
    // {
    //     $credentials = $request->validate([
    //         'email' => ['required', 'email'],
    //         'password' => ['required'],
    //     ]);

    //     if (Auth::attempt($credentials)) {
    //         return view('betro.index' , compact('email'));
    //     }
    // }

public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ],[
        'email.required' => 'L\'email est requis.',
        'email.email' => 'L\'email doit être valide.',
        'password.required' => 'Le mot de passe est requis.',
    ]);

    $remember = $request->has('remember'); // Vérifie si la case "Se souvenir de moi" est cochée

    $user = User::where('email', $credentials['email'])->first();
    
    // Vérifier si l'utilisateur existe
    if (!$user) {
        return back()
            ->withErrors(['email' => 'Aucun compte trouvé avec cette adresse email.'])
            ->withInput($request->only('email', 'remember'))
            ->onlyInput('email');
    }
    
    if ($user && empty($user->password)) {
        return back()
            ->with('password_pending', "Votre compte n'est pas encore activé. Veuillez finaliser la création via le lien reçu par email.")
            ->withErrors(['email' => 'Compte à finaliser avant connexion.'])
            ->withInput($request->only('email', 'remember'))
            ->onlyInput('email');
    }
    // Vérifier si l'utilisateur a un info_user (certains utilisateurs comme le super admin n'en ont pas)
    // $compagnie = null;
    // $gare = null;
    
    if ($user->info_user) {
        $compagnie = $user->info_user->compagnie;
        $gare = $user->info_user->gare;
        
        // Vérifications pour les utilisateurs avec profil (compagnie/gare)
        if($compagnie){
            if($compagnie->status != 1){
                return back()
                ->with('compagnie_pending', "Votre compte n'est pas encore activé. Veuillez contacter l'administrateur.")
                ->withErrors(['email' => 'Votre compte a été désactivé ou refusé. Veuillez contacter l\'administrateur.'])
                ->withInput($request->only('email', 'remember'))
                ->onlyInput('email');
            }
        }elseif($gare){
            if($gare->status != 1){
                return back()
                ->with('compagnie_pending', "Votre compte n'est pas encore activé. Veuillez contacter l'administrateur.")
                ->withErrors(['email' => 'Votre compte a été désactivé ou refusé. Veuillez contacter l\'administrateur.'])
                ->withInput($request->only('email', 'remember'))
                ->onlyInput('email');
            }
        }
    }
    // Si l'utilisateur n'a pas d'info_user, c'est probablement un super admin ou utilisateur système
    if (Auth::attempt($credentials, $remember)) {
        $request->session()->regenerate(); // Protection contre la fixation de session

        $user = Auth::user();
        // dd($user->getRoleNames()); // Affiche une collection avec les rôles de l'utilisateur  // <-- Affiche la valeur du rôle et stoppe l'exécution
        // Redirection selon le rôle de l'utilisateur
        if ($user->hasRole('super-admin-betro')) {
            return redirect()->route('dashboard')
                ->with('success', 'Connexion réussie. Bienvenue ' . $user->nom . ' ' . $user->prenom);
        } elseif ($user->hasRole('super-admin-compagnie')) {
            return redirect()->route('dashboardcompagnie_name')
                ->with('success', 'Connexion réussie. Bienvenue ' . $user->nom . ' ' . $user->prenom);
        }elseif($user->hasRole('super-admin-gare')){
            return redirect()->route('dashboardcompagnie_name')
                ->with('success', 'Connexion réussie. Bienvenue ' . $user->nom . ' ' . $user->prenom);
        }
    }
    // Si échec de connexion, retour avec message d'erreur
    return back()->withErrors([
        'email' => 'Les identifiants sont incorrects.',
    ])->onlyInput('email');
}


    // if ($user->role = 'super-admin-betro') {
    //     // return redirect()->route('dashboardbetro'); // ou la vue que tu veux afficher
    //     return redirect()->route('dashboard') // ou la vue que tu veux afficher
    //     ->with('success', 'Connexion réussie. Bienvenue ' . $user->nom . ' ' . $user->prenom);
    //     }else{
    //     return redirect()->route('dashboardcompagnie_name')
    //     ->with('success', 'Mot de passe modifié avec succès ✅');
    //     }

    public function dashboardbetro(Request $request)
    {
        // Récupération des paramètres de filtre
        $dateDebut = $request->input('date_debut', now()->startOfMonth()->format('Y-m-d'));
        $dateFin = $request->input('date_fin', now()->format('Y-m-d'));
        $compagnieId = $request->input('compagnie_id');

        // Récupération de la liste des compagnies pour le select
        $compagnies = Compagnies::orderBy('nom_complet_compagnies')->get();

        // Construction des requêtes avec filtres
        $queryCompagnie = Compagnies::query();
        $queryGare = gare::query();
        $queryItineraire = Itineraire::query();
        $queryVoyage = Voyage::query();
        $queryReservation = Reservation::query();

        // Application des filtres de date et de compagnie
        $queryCompagnie->whereDate('created_at', '>=', $dateDebut)
            ->whereDate('created_at', '<=', $dateFin);
            
        $queryGare->whereDate('created_at', '>=', $dateDebut)
            ->whereDate('created_at', '<=', $dateFin);
            
        $queryItineraire->whereDate('created_at', '>=', $dateDebut)
            ->whereDate('created_at', '<=', $dateFin);
            
        // Filtrage des voyages par date et compagnie
        $queryVoyage->where(function($query) use ($dateDebut, $dateFin) {
            $query->where('disponible_toujours', 1)
                  ->orWhere(function($subQuery) use ($dateDebut, $dateFin) {
                      $subQuery->where('disponible_toujours', 0)
                               ->whereDate('date_depart', '>=', $dateDebut)
                               ->whereDate('date_depart', '<=', $dateFin);
                  });
        });
            
        if ($compagnieId) {
            $queryVoyage->where('compagnie_id', $compagnieId);
            $queryCompagnie->where('id', $compagnieId);  // Filtre aussi le compteur des compagnies
            $queryItineraire->where('compagnie_id', $compagnieId);
            $queryGare->where('compagnie_id', $compagnieId);  // Filtre les gares par compagnie
        }

        // Filtrage des réservations par date et compagnie
        $queryReservation->whereDate('created_at', '>=', $dateDebut)
            ->whereDate('created_at', '<=', $dateFin);
            
        if ($compagnieId) {
            $queryReservation->where('compagnies_id', $compagnieId);
        }

        // Exécution des requêtes
        $nombres_compagnie = $queryCompagnie->count();
        $nombre_de_gare = $queryGare->count();
        $itineraie_de_gare = $queryItineraire->count();
        $voyages_de_gare = $queryVoyage->count();
        $reservation_de_gare = $queryReservation->count();
        
        // Calcul du total des paiements avec les mêmes filtres
        $queryPaiement = Paiement::query()
            ->whereDate('created_at', '>=', $dateDebut)
            ->whereDate('created_at', '<=', $dateFin)
            ->where('status', 1);
            
        if ($compagnieId) {
            $queryPaiement->where('compagnie_id', $compagnieId);
            
            // Mise à jour du nombre de compagnies à 1 puisqu'on en a sélectionné une
            $nombres_compagnie = 1;
        }
        
        $total_paiements = $queryPaiement->sum('montant');
            
        // Récupération des paiements avec filtrage par date et compagnie
        $queryPaiements = \App\Models\Paiement::with(['reservation', 'voyage', 'utilisateur', 'compagnie'])
            ->whereDate('created_at', '>=', $dateDebut)
            ->whereDate('created_at', '<=', $dateFin)
            ->where('status', 1);
            
            
        if ($compagnieId) {
            $queryPaiements->where('compagnie_id', $compagnieId);
        }
            
        $paiements = $queryPaiements
            ->orderBy('created_at', 'desc')
            ->get();
            
        // Calcul du total des paiements
        $total_paiements = $paiements->sum('montant');

        // Préparation des données pour le graphique
        $debut = \Carbon\Carbon::parse($dateDebut);
        $fin = \Carbon\Carbon::parse($dateFin);
        $jours = $debut->diffInDays($fin) + 1;
        
        // Décider du regroupement des données en fonction de la période
        $groupBy = 'day';
        $dateFormat = 'd M';
        
        if ($jours > 90) {
            $groupBy = 'month';
            $dateFormat = 'M Y';
        } elseif ($jours > 30) {
            $groupBy = 'week';
            $dateFormat = 'W\o Y';
        }
        
        // Initialisation des tableaux de données
        $reservationsData = [];
        $paiementsData = [];
        $categories = [];
        
        // Fonction pour formater les dates selon le regroupement
        $formatDate = function($date) use ($groupBy) {
            $date = \Carbon\Carbon::parse($date);
            if ($groupBy === 'month') {
                return $date->startOfMonth()->format('Y-m-d');
            } elseif ($groupBy === 'week') {
                return $date->startOfWeek()->format('Y-m-d');
            }
            return $date->format('Y-m-d');
        };
        
        // Récupération des réservations groupées
        $reservationsQuery = \App\Models\Reservation::select(
            \DB::raw('DATE(created_at) as date'),
            \DB::raw('COUNT(*) as count')
        )
        ->whereDate('created_at', '>=', $dateDebut)
        ->whereDate('created_at', '<=', $dateFin);
        
        // Récupération des paiements groupés
        $paiementsQuery = \App\Models\Paiement::select(
            \DB::raw('DATE(created_at) as date'),
            \DB::raw('COALESCE(SUM(montant), 0) as total')
        )
        ->whereDate('created_at', '>=', $dateDebut)
        ->whereDate('created_at', '<=', $dateFin)
        ->where('status', 1);
        
        // Application du filtre par compagnie
        if ($compagnieId) {
            $reservationsQuery->where('compagnies_id', $compagnieId);
            $paiementsQuery->where('compagnie_id', $compagnieId);
        }
        
        // Grouper les résultats par date
        $reservationsQuery->groupBy(\DB::raw('DATE(created_at)'));
        $paiementsQuery->groupBy(\DB::raw('DATE(created_at)'));
        
        $reservations = $reservationsQuery->get()->keyBy(function($item) {
            return $item->date;
        });
        
        $paiements = $paiementsQuery->get()->keyBy(function($item) {
            return $item->date;
        });
        
        // Remplir les tableaux de données
        $currentDate = $debut->copy();
        
        // Réinitialiser les tableaux de données
        $categories = [];
        $reservationsData = [];
        $paiementsData = [];
        
        // Créer un tableau pour stocker les données par date
        $reservationsByDate = [];
        $paiementsByDate = [];
        
        // Remplir les tableaux avec les données des requêtes
        foreach ($reservations as $date => $item) {
            $dateKey = $groupBy === 'month' 
                ? \Carbon\Carbon::parse($date)->startOfMonth()->format('Y-m-d')
                : ($groupBy === 'week' 
                    ? \Carbon\Carbon::parse($date)->startOfWeek()->format('Y-m-d')
                    : $date);
            
            if (!isset($reservationsByDate[$dateKey])) {
                $reservationsByDate[$dateKey] = 0;
            }
            $reservationsByDate[$dateKey] += $item->count;
        }
        
        foreach ($paiements as $date => $item) {
            $dateKey = $groupBy === 'month' 
                ? \Carbon\Carbon::parse($date)->startOfMonth()->format('Y-m-d')
                : ($groupBy === 'week' 
                    ? \Carbon\Carbon::parse($date)->startOfWeek()->format('Y-m-d')
                    : $date);
            
            if (!isset($paiementsByDate[$dateKey])) {
                $paiementsByDate[$dateKey] = 0;
            }
            $paiementsByDate[$dateKey] += $item->total;
        }
        
        // Parcourir la période et construire les tableaux pour le graphique
        while ($currentDate->lte($fin)) {
            $dateKey = $currentDate->format('Y-m-d');
            $formattedDate = $currentDate->format($dateFormat);
            
            // Ajouter la date formatée aux catégories si elle n'existe pas déjà
            if (!in_array($formattedDate, $categories)) {
                $categories[] = $formattedDate;
                
                // Ajouter les données pour cette date
                $reservationsData[] = $reservationsByDate[$dateKey] ?? 0;
                $paiementsData[] = $paiementsByDate[$dateKey] ?? 0;
            }
            
            // Passer à la période suivante
            if ($groupBy === 'month') {
                $currentDate = $currentDate->addMonth()->startOfMonth();
            } elseif ($groupBy === 'week') {
                $currentDate = $currentDate->addWeek()->startOfWeek();
            } else {
                $currentDate->addDay();
            }
        }

        return view('betro.index', compact(
            'nombres_compagnie',
            'nombre_de_gare',
            'itineraie_de_gare',
            'voyages_de_gare',
            'reservation_de_gare',
            'total_paiements',
            'dateDebut',
            'dateFin',
            'compagnies',
            'compagnieId',
            'categories',
            'reservationsData',
            'paiementsData'
        ));
    }

    

    public function dashboardcompagnie(Request $request)
    {
        // Initialisation des variables
        $dateDebut = $request->input('date_debut', now()->startOfMonth()->format('Y-m-d'));
        $dateFin = $request->input('date_fin', now()->format('Y-m-d'));
        $user = Auth::user();
        $info_user = $user->info_user;
        $compagnie = $info_user->compagnie ?? null;
        $gare = $info_user->gare ?? null;
        $somme = 0;
        $message = "Compagnie";
        $liste_gare = collect();
        $liste_bus_cars = collect();
        $chauffeurs = collect();
        $itinierai = 0;
        $voyages = 0;
        $compagnieId = null;
        $reservations = collect();
        $chartData = [
            'labels' => [],
            'reservations' => [],
            'ca' => [],
            'total_reservations' => 0,
            'reservations_confirmees' => 0,
            'reservations_annulees' => 0
        ];

        // Récupération des informations de la compagnie ou de la gare
        $compagnie = $compagnie ?? Compagnies::where('info_user_id', $user->id)->first();
        $gare = $gare ?? gare::where('info_user_id', $user->id)->first();
        
        if($gare){
            // Utilisation de sum() directement sur la requête pour optimiser les performances
           
            $somme = Paiement::where('gares_id', $gare->id)
                ->whereDate('created_at', '>=', $dateDebut)
                ->whereDate('created_at', '<=', $dateFin)
                ->where('status', 1)
                ->sum('montant') ?? 0;

    //         $nombrePaiements = Paiement::where('gares_id', $gare->id)
    // ->whereDate('created_at', '>=', $dateDebut)
    // ->whereDate('created_at', '<=', $dateFin)->get();
  
    //     dd($somme , $nombrePaiements->montant);
//     $listePaiements = Paiement::where('gares_id', $gare->id)
//     ->whereDate('created_at', '>=', $dateDebut)
//     ->whereDate('created_at', '<=', $dateFin)
//     ->get();

// $montants = [];

// foreach ($listePaiements as $paiement) {
//     $montants[] = $paiement->montant;
// }

// dd($montants); // ← affiche un tableau de tous les montants


            $message = "Gares";
            $compagnieId = $gare->compagnie_id;

        } else if ($compagnie) {
            // Utilisation de sum() directement sur la requête pour optimiser les performances
            $somme = Paiement::where('compagnie_id', $compagnie->id)
                ->whereDate('created_at', '>=', $dateDebut)
                ->whereDate('created_at', '<=', $dateFin)
                ->where('status', 1)
                ->sum('montant') ?? 0;
            $compagnieId = $compagnie->id;
        } else {
            return redirect()->back()->with('error', 'Aucune compagnie trouvée pour cet utilisateur');
        }


        if($compagnie) {
            $compagnieId = $compagnie->id;
            
            // Récupération des statistiques pour une compagnie
            $liste_gare = Gare::whereDate('created_at', '>=', $dateDebut)
                             ->whereDate('created_at', '<=', $dateFin)
                             ->where('compagnie_id', $compagnieId)
                             ->get();

            $liste_bus_cars = Bus::whereDate('created_at', '>=', $dateDebut)
                             ->whereDate('created_at', '<=', $dateFin)
                             ->where('compagnies_id', $compagnieId)
                             ->get();

            $chauffeurs = Chauffeur::whereDate('created_at', '>=', $dateDebut)
                             ->whereDate('created_at', '<=', $dateFin)
                             ->where('compagnies_id', $compagnieId)
                             ->get();

            $itinierai = Itineraire::whereDate('created_at', '>=', $dateDebut)
                             ->whereDate('created_at', '<=', $dateFin)
                             ->where('compagnie_id', $compagnieId)
                             ->count();
            
            $voyages = Voyage::where('compagnie_id', $compagnieId)
                             ->where(function($query) use ($dateDebut, $dateFin) {
                                 $query->where('disponible_toujours', 1)
                                       ->orWhere(function($subQuery) use ($dateDebut, $dateFin) {
                                           $subQuery->where('disponible_toujours', 0)
                                                    ->whereDate('date_depart', '>=', $dateDebut)
                                                    ->whereDate('date_depart', '<=', $dateFin);
                                       });
                             })
                             ->count();
            //$voyages_test = Voyage::where('compagnie_id', $compagnieId)->count();  
            // dd($compagnieId , $voyages ,$voyages_test);
            // Récupération des réservations avec les données nécessaires
            $reservations = \App\Models\Reservation::with(['paiement', 'voyage'])
                ->where('compagnies_id', $compagnieId)
                ->whereDate('created_at', '>=', $dateDebut)
                ->whereDate('created_at', '<=', $dateFin)
                ->get();

        } elseif($gare) {
            $compagnieId = $gare->compagnie_id;
            $itinierai = Itineraire::whereDate('created_at', '>=', $dateDebut)
                             ->whereDate('created_at', '<=', $dateFin)
                             ->where('gare_id', $gare->id)
                             ->count();

            // $voyages = Voyage::whereDate('date_depart', '>=', $dateDebut)
            //                  ->whereDate('date_depart', '<=', $dateFin)
            //                  ->where('gare_id', $gare->id)
            //                  ->count();
             $voyages = Voyage::where('compagnie_id', $compagnieId)
             ->where('gare_id', $gare->id)
                             ->where(function($query) use ($dateDebut, $dateFin) {
                                 $query->where('disponible_toujours', 1)
                                       ->orWhere(function($subQuery) use ($dateDebut, $dateFin) {
                                           $subQuery->where('disponible_toujours', 0)
                                                    ->whereDate('date_depart', '>=', $dateDebut)
                                                    ->whereDate('date_depart', '<=', $dateFin);
                                       });
                             })
                             ->count();

            // dd($voyages);

            // Récupération des réservations avec les données nécessaires
            $reservations = \App\Models\Reservation::with(['paiement', 'voyage'])
                ->where('gare_id', $gare->id)
                ->whereDate('created_at', '>=', $dateDebut)
                ->whereDate('created_at', '<=', $dateFin)
                ->get();

            // Récupération des gares pour la compagnie de la gare
            $liste_gare = Gare::where('compagnie_id', $compagnieId)->get();
            $liste_bus_cars = Bus::where('compagnies_id', $compagnieId)->get();
            $chauffeurs = Chauffeur::where('compagnies_id', $compagnieId)->get();

            
        }
        

        // Préparation des données pour les graphiques
        $dates = [];
        $reservationsParJour = [];
        $caParJour = [];

        // Initialiser les tableaux avec des valeurs par défaut pour chaque jour
        $currentDate = new \DateTime($dateDebut);
        $endDate = new \DateTime($dateFin);
        
        while ($currentDate <= $endDate) {
            $dateStr = $currentDate->format('Y-m-d');
            $dates[] = $currentDate->format('d M');
            $reservationsParJour[$dateStr] = 0;
            $caParJour[$dateStr] = 0;
            $currentDate->modify('+1 day');
        }

        // Compter les réservations et le CA par jour
        foreach ($reservations as $reservation) {
            $date = \Carbon\Carbon::parse($reservation->created_at)->format('Y-m-d');
            $reservationsParJour[$date]++;
            
            if ($reservation->paiement) {
                $caParJour[$date] = ($caParJour[$date] ?? 0) + $reservation->paiement->montant;
            }
        }

        // Préparer les données pour le graphique
        $chartData = [
            'labels' => $dates,
            'reservations' => array_values($reservationsParJour),
            'ca' => array_values($caParJour),
            'total_reservations' => $reservations->count(),
            'total_ca' => array_sum($caParJour),
            'reservations_confirmees' => $reservations->where('status', '1')->count(),
            'reservations_annulees' => $reservations->where('status', '0')->count()
        ];

        return view('compagnie.index', [
            'nombregars' => $liste_gare->count() ?? 0,
            'nombres_bus' => $liste_bus_cars->count() ?? 0,
            'nombres_chauffeur' => $chauffeurs->count() ?? 0,
            'nombres_itineraire' => $itinierai ?? 0,
            'nombres_voyage' => $voyages ?? 0,
            'dateDebut' => $dateDebut,
            'dateFin' => $dateFin,
            'somme' => $somme,
            'message' => $message,
            'reservations' => $reservations,
            'chartData' => $chartData
        ]);
    }

    

    public function premierePage()
    {
    return view('login');
    }

    public function logins()
    {
        $config = ConfigWebMobile::first();
        $imageConnexionWeb = $config?->image_connexion_web;
        return view('login', compact('imageConnexionWeb'));
    }

public function logout(Request $request)
{
    // Déconnecte l'utilisateur
    Auth::logout();
    
    // Invalide la session
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    
    // Supprime tous les cookies de session (y compris laravel_session et XSRF-TOKEN)
    foreach ($request->cookies->keys() as $cookieName) {
        cookie()->forget($cookieName);
    }

    // Retour avec headers pour interdire le cache
    return redirect('/login')->with('success', 'Déconnexion réussie.')
        ->header('Cache-Control', 'no-cache, no-store, max-age=0, must-revalidate')
        ->header('Pragma', 'no-cache')
        ->header('Expires', 'Sat, 01 Jan 1990 00:00:00 GMT');
}



// public function compagnie()
// {
//     return view('betro.compagnie.index');
// }


}
