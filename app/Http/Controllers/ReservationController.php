<?php

namespace App\Http\Controllers;

use App\Models\reservation;
use Illuminate\Http\Request;
use App\Models\Bus;
use App\Models\Voyage;


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
        return view('compagnie.reservation.index', compact('buses', 'selectedBus', 'voyages', 'selectedVoyage', 'reservations'));
    }

// public function liste_reservation()
// {
//     $liste_reservation = Reservation::with(['voyage', 'utilisateur'])->get();
//     return view('compagnie.reservation.index2', compact('liste_reservation'));
// }

public function liste_reservation(Request $request)
{
    $query = Reservation::with(['voyage', 'utilisateur' ,'arretvoyage','paiement']);
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
    $liste_reservation = $query->get();
    // Calcul du coût total (somme des montants des voyages réservés)
    // $total_montant = $liste_reservation->sum(function($reservation) {
    //     return $reservation->voyage->montant ?? 0;
    // });
     $total_montant = $liste_reservation->sum(function($reservation) {
        return $reservation->paiement->montant ?? 0;
    });
    return view('compagnie.reservation.index2', compact('liste_reservation' ,'total_montant'));
}

public function voir_detail_reservation(Request $request , $id){

    // $detail_reservatiion = Reservation::findOrFail($id);
    $detail_reservation = Reservation::with(['voyage', 'utilisateur','arretvoyage' ,'paiement'])->findOrFail($id);
    return view('compagnie.reservation.show', compact('detail_reservation'));
}


}
