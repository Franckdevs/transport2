<?php

namespace App\Http\Controllers;

use App\Models\Arret;
use App\Models\ArretVoyage;
use App\Models\Itineraire;
use App\Models\Paiement;
use App\Models\TarificationMontantVoyage;
use App\Models\Voyage;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PaiementTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Paiement::query();

            // Appliquer les filtres de date si fournis
            if ($request->filled('start_date')) {
                $query->whereDate('created_at', '>=', $request->start_date);
            }
            
            if ($request->filled('end_date')) {
                $endDate = \Carbon\Carbon::parse($request->end_date)->addDay();
                $query->whereDate('created_at', '<=', $endDate);
            }

            // Appliquer le filtre par statut si fourni
            if ($request->filled('status')) {
                if ($request->status === 'paye') {
                    $query->where('status', 1);
                } elseif ($request->status === 'echoue') {
                    $query->where('status', '!=', 1);
                }
            }

            return datatables()
                ->eloquent($query->orderBy('created_at', 'desc'))
                ->addIndexColumn()
                ->addColumn('montant_format', function($row) {
                    return number_format($row->montant, 0, ',', ' ') . ' FCFA';
                })
                ->addColumn('date_format', function($row) {
                    return $row->created_at->format('d/m/Y H:i');
                })
                ->addColumn('status_format', function($row) {
                    if ($row->status == 1) {
                        return '<span class="badge bg-success">Payé</span>';
                    } else {
                        return '<span class="badge bg-danger">Échoué</span>';
                    }
                })
                ->rawColumns(['montant_format', 'date_format', 'status_format'])
                ->make(true);
        }

        // Récupérer les données sans pagination pour la vue initiale
        $query = Paiement::query();
        
        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }
        
        if ($request->filled('end_date')) {
            $endDate = \Carbon\Carbon::parse($request->end_date)->addDay();
            $query->whereDate('created_at', '<=', $endDate);
        }

        // Appliquer le filtre par statut si fourni
        if ($request->filled('status')) {
            if ($request->status === 'paye') {
                $query->where('status', 1);
            } elseif ($request->status === 'echoue') {
                $query->where('status', '!=', 1);
            }
        }
        
        $paiements = $query->orderBy('created_at', 'desc')->get();
        
        return view('betro.paiement.index', compact('paiements'));
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
  public function show($id)
{
    $paiement = Paiement::with([
        'utilisateur',
        'voyage.compagnie.gares',
        'voyage.itineraire',
        'arretvoyage.arret',
        'reservation'
    ])->findOrFail($id);

    $voyage = Voyage::where('id', $paiement->voyages_id)->first();

    $itineraire = Itineraire::with(['gare' , 'gare.ville'])->where('id', $voyage->itineraire_id)->first();

    // $arretvoyage = ArretVoyage::where('id', $paiement->id_arret_voayage)->first();

    $arret = Arret::where('id', $paiement->id_arret_voayage)->first();
    
    // Charger les gares de la compagnie si elle existe
    $garesCompagnie = [];
    if ($paiement->voyage && $paiement->voyage->compagnie) {
        $garesCompagnie = $paiement->voyage->compagnie->gares->load('ville');
    }

    $arret_debut_arrive = TarificationMontantVoyage::with(['villeDepart' , 'villeArrivee'])->where('id', $arret->id_tarrification_voyage)->first();

    // dd($arret ,$arretvoyage , $itineraire , $arret_debut_arrive);
//   dd($paiement);
    return view('betro.paiement.show', compact('paiement', 'arret', 'itineraire', 'arret_debut_arrive', 'garesCompagnie'));
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
}
