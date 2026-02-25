<?php

namespace App\Http\Controllers;

use App\Models\reservation;
use Illuminate\Http\Request;
use App\Models\Bus;
use App\Models\Voyage;
use Illuminate\Support\Facades\Auth;


use App\Http\Controllers\Controller;

class ReservationController extends Controller
{
     public function index(Request $request)
    {
        $buses = Bus::all();
        $selectedBus = null;
        $voyages = collect();
        $selectedVoyage = null;
        $reservations = collect();

        if ($request->bus_id) {
            $selectedBus = Bus::find($request->bus_id);
            $voyages = Voyage::where('buses_id', $selectedBus->id)->get();
        }

        // if ($request->voyage_id) {
        //     $selectedVoyage = Voyage::find($request->voyage_id);
        //     $reservations = Reservation::where('voyage_id', $selectedVoyage->id)->pluck('seat_number')->toArray();
        // }
        // dd($)
        return view('compagnie.reservation.index', compact('buses', 'selectedBus', 'voyages', 'selectedVoyage', 'reservations'));
    }

// public function liste_reservation()
// {
//     $liste_reservation = Reservation::with(['voyage', 'utilisateur'])->get();
//     return view('compagnie.reservation.index2', compact('liste_reservation'));
// }

public function liste_reservation(Request $request)
{
    // $reservation = Reservation::with('voyage','voyage.itineraire','voyage.itineraire.arrets','voyage.itineraire.arrets.tarification','voyage.itineraire.arrets.tarification.villeDepart','voyage.itineraire.arrets.tarification.villeArrivee')->get();
    // dd($reservation);
    //compagnie ou gare 
    $user = Auth::user();
    $info_user = $user->info_user;
    $compagnie = $info_user->compagnie;
    $gare = $info_user->gare;
    // dd($compagnie , $gare);
    if($gare != null){
        $query = Reservation::with('voyage','voyage.itineraire','voyage.itineraire.arrets','voyage.itineraire.arrets.tarification','voyage.itineraire.arrets.tarification.villeDepart','voyage.itineraire.arrets.tarification.villeArrivee')->where('gare_id',$gare->id);
    }elseif($compagnie != null){
        $query = Reservation::with('voyage','voyage.itineraire','voyage.itineraire.arrets','voyage.itineraire.arrets.tarification','voyage.itineraire.arrets.tarification.villeDepart','voyage.itineraire.arrets.tarification.villeArrivee')->where('compagnies_id',$compagnie->id); 
    }else{
        // $query = Reservation::with(['voyage', 'utilisateur' ,'arretvoyage','paiement']); 

    }
    // Filtre par date départ du voyage
    if ($request->date_debut) {
        $query->whereHas('voyage', function($q) use ($request) {
            $q->whereDate('date_depart', '>=', $request->date_debut);
        });
    }
    if ($request->date_fin) {
        $query->whereHas('voyage', function($q) use ($request) {
            $q->whereDate('date_depart', '<=', $request->date_fin);
        });
    }

    // Filtre par ville de départ
    if ($request->ville_depart_id) {
        $query->whereHas('voyage', function($q) use ($request) {
            $q->whereHas('itineraire', function($subQ) use ($request) {
                $subQ->where('ville_id', $request->ville_depart_id);
            });
        });
    }

    // Filtre par statut de la réservation
    if ($request->statut) {
        $query->where('status', $request->statut);
    }

    $liste_reservation = $query->get();

     $total_montant = $liste_reservation->sum(function($reservation) {
        return $reservation->paiement->montant ?? 0;
    });
    
    // Récupérer toutes les villes pour le filtre
    $villes = \App\Models\Ville::orderBy('nom_ville')->get();

    // dd($liste_reservation);
    return view('compagnie.reservation.index2', compact('liste_reservation' ,'total_montant', 'villes'));
}

public function voir_detail_reservation(Request $request , $id){

    // $detail_reservatiion = Reservation::findOrFail($id);
    $detail_reservation = Reservation::with(['voyage', 'utilisateur','arretvoyage' ,'paiement'])->findOrFail($id);
    return view('compagnie.reservation.show', compact('detail_reservation'));
}


}
