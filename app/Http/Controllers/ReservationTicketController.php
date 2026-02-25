<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationTicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index(Request $request)
{
    // $query = Reservation::with([
    //     'voyage.itineraire.arrets',  // 🔁 itinéraire + arrêts
    //     'voyage.gare',               // Gare de départ
    //     'utilisateur'                // Client
    // ])->orderBy('id', 'desc');
    $query = Reservation::with([
        'voyage.itineraire.arrets',  // 🔁 itinéraire + arrêts
        'voyage.gare',               // Gare de départ
        'utilisateur',               // Client
        'arret'
    ])->orderBy('id', 'desc');

    // 🔎 Filtre par date de départ du voyage
    if ($request->filled('start_date')) {
        $query->whereHas('voyage', function ($q) use ($request) {
            $q->whereDate('date_depart', '>=', $request->start_date);
        });
    }

    if ($request->filled('end_date')) {
        $query->whereHas('voyage', function ($q) use ($request) {
            $q->whereDate('date_depart', '<=', $request->end_date);
        });
    }

    $reservations = $query->get();
    
    // Calculer le montant total des réservations
    $totalMontant = 0;
    foreach ($reservations as $reservation) {
        if ($reservation->paiement) {
            $totalMontant += $reservation->paiement->montant;
        }
    }

    return view('betro.reservation_ticket.index', [
        'reservations' => $reservations,
        'totalMontant' => $totalMontant
    ]);
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

    // public function generateTicket($reservationId)
    // {
    //     $reservation = Reservation::with(['voyage.itineraire.arrets', 'voyage.gare', 'utilisateur'])->findOrFail($reservationId);
    //     // Générer le PDF du ticket
    //     $pdf = \PDF::loadView('betro.reservation_ticket.ticket', compact('reservation'));
    //     // Télécharger le PDF
    //     return $pdf->download('ticket_reservation_' . $reservation->id . '.pdf');
    // }

    

}
