<?php

namespace App\Http\Controllers;

use App\Models\reservation;
use Illuminate\Http\Request;
use App\Models\Bus;
use App\Models\Voyage;


use App\Http\Controllers\Controller;

class ReservationController extends Controller
{    public function index(Request $request)
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

    public function liste_reservation()
    {
        $liste_reservation = reservation::all();
        return view('compagnie.reservation.index2', compact('liste_reservation'));
    }

}
