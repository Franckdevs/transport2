<?php

namespace App\Http\Controllers;

use App\Models\Compagnies;
use App\Models\Paiement;
use App\Models\PaiementEnAttente;
use App\Models\Reservation;
use App\Models\Voyage;
use Illuminate\Http\Request;
use app\Helpers\GlobalHelper;
use Illuminate\Support\Str;

class PaiementController extends Controller
{
    //page du status paiement 
    public function status_paiement($code){
        $paiement = Paiement::with('utilisateur','compagnie','reservation')->where('code_paiement',$code)->first();
        
        // Si le paiement n'existe pas ou si le code est null, afficher la page d'erreur
        if (!$paiement || $paiement->code === null) {
            return view('erreur_paiement');
        }
        
        $status_code_paiement = $paiement->code;
        return view('felicitation_paiement' , compact('status_code_paiement','paiement') );
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

public static function generateNumeroReservation()
{
    do {
        //$numero = 'RES-' . date('Ymd-His') . '-' . strtoupper(Str::random(8));
        $numero = 'RES-' . strtoupper(Str::random(5));
    } while (Reservation::where('numero_reservation', $numero)->exists());

    return $numero;
   
}


    public function callback(Request $request)
    {
        (string) $RetourPaiementEnJSON = json_encode($request->input());
        (string) $Chaine = "Debut callback paiement, recu: " . $RetourPaiementEnJSON;
        try {
            (int) $Code = $request->code;
            (int) $Montant = $request->montant;
            (string) $codePaiement = $request->codePaiement;
            // Recupère le paiement en attente avec le statut '2'
            $paiementinit = PaiementEnAttente::where('codePaiement', $codePaiement)
            ->first();
            
            if(!$paiementinit){
                return response()->json([
                    'success' => false,
                    'message' => 'Aucune demande de paiement en attente trouvée pour ce code.'
                ], 404);
            }
            
            $trouvervoyage = Voyage::where('id', $paiementinit->voyages_id)->first();
            if(!$trouvervoyage){
                return response()->json([
                    'success' => false,
                    'message' => 'Aucun voyage trouvé pour ce paiement.'
                ], 404);
            }

            $compagnie = Compagnies::where('id', $trouvervoyage->compagnie_id)->first();
            if(!$compagnie){
                return response()->json([
                    'success' => false,
                    'message' => 'Aucune compagnie trouvée pour ce paiement.'
                ], 404);
            }
            // return response()->json([
            //          "data"=> $RetourPaiementEnJSON,
            //          "code"=> $Code,
            //          "montant"=> $Montant,
            //          "paiement"=>$paiementinit,
            //         //  "creation" => $creation_reservations,
            //          "trouvervoyage"=>$trouvervoyage,
            //         "compagnie"=>$compagnie
            //          ]);

            if (!empty($paiementinit->id)) {
                if ($Code == 200) {
                    $paiement = new Paiement();
                    $paiement->code_paiement = $codePaiement;
                    $paiement->utilisateur_id = $paiementinit->utilisateur_id;
                    $paiement->voyages_id = $paiementinit->voyages_id;
                    $paiement->numero_place = $paiementinit->numero_place;
                    $paiement->montant = $paiementinit->montant;
                    $paiement->status = 1;
                    $paiement->id_arret_voayage = $paiementinit->id_arret_voayage;
                    $paiement->datePaiement =  $request->datePaiement;
                    $paiement->HeurePaiement =  $request->HeurePaiement;
                    $paiement->code =  $request->code;
                    $paiement->referencePaiement =  $request->referencePaiement;
                    $paiement->telephone =  $request->numTel;
                    $paiement->moyenPaiement =  $request->moyenPaiement;
                    $paiement->compagnie_id = $compagnie->id;
                    $paiement->gares_id = $paiementinit->gares_id;
                    $paiement->nom_complet = $paiementinit->nom_complet;
                    $paiement->telephone_proprietaire = $paiementinit->telephone_proprietaire;

                    // compagnie
                    $paiement->save();
                    
                    $creation_reservations = new Reservation();
                    $creation_reservations->voyages_id = $paiement->voyages_id;
                    $creation_reservations->utilisateurs_id = $paiement->utilisateur_id;
                    $creation_reservations->numero_place = $paiement->numero_place;
                    $creation_reservations->id_arret_voayage = $paiement->id_arret_voayage; 
                    $creation_reservations->paiements_id = $paiement->id;
                    $creation_reservations->compagnies_id = $compagnie->id;
                    $creation_reservations->nom_complet = $paiement->nom_complet;
                    $creation_reservations->gare_id = $paiement->gares_id;
                    $creation_reservations->telephone_proprietaire = $paiement->telephone_proprietaire;
                    $creation_reservations->numero_reservation = $this->generateNumeroReservation();
                    // return response()->json(["message" => "Paiement traité avec succès"]);
                    $creation_reservations->status  = 2;
            //         return response()->json([
            // "data"=> "test",
            // "montant"=> $RetourPaiementEnJSON,
            // "paiement"=>$paiementinit,
            // "trouvervoyage"=>$trouvervoyage,
            // "reservation_created"=>true,
            // "reservation"=>$creation_reservations,
            // 'numero_reservation'=>$creation_reservations->numero_reservation
            // ]);
                    $creation_reservations->save();	

                    return response()->json([
                     "data"=> $RetourPaiementEnJSON,
                     "code"=> $Code,
                     "montant"=> $Montant,
                     "paiementinit"=>$paiementinit,
                     "creation" => $creation_reservations,
                     "paiement"=>$paiement,
                     "compagnie"=>$compagnie,
                     ]);    

                } else {
                    if ($Code != 200) {
                    $paiement = new Paiement();
                   $paiement->code_paiement = $codePaiement;
                    $paiement->utilisateur_id = $paiementinit->utilisateur_id;
                    $paiement->voyages_id = $paiementinit->voyages_id;
                    $paiement->numero_place = $paiementinit->numero_place;
                    $paiement->montant = $paiementinit->montant;
                    $paiement->status = 2;
                    $paiement->id_arret_voayage = $paiementinit->id_arret_voayage;
                    $paiement->datePaiement =  $request->datePaiement;
                    $paiement->HeurePaiement =  $request->HeurePaiement;
                    $paiement->code =  $request->code;
                    $paiement->compagnie_id = $compagnie->id;
                    $paiement->referencePaiement =  $request->referencePaiement;
                    $paiement->telephone =  $request->numTel;
                    $paiement->moyenPaiement =  $request->moyenPaiement;
                    $paiement->nom_complet = $paiementinit->nom_complet;
                    $paiement->telephone_proprietaire = $paiementinit->telephone_proprietaire;
                    // $paiement->compagnie_id = $compagnie->compagnie_id;
                    $paiement->gares_id = $paiementinit->gares_id;
                    $paiement->save();
                    // return response()->json([
                    //  "data"=> $RetourPaiementEnJSON,
                    //  "code"=> $Code,
                    //  "montant"=> $Montant,
                    //  "paiement"=>$paiementinit
                    //  ]);
                     }
                }
            } 
            
            //  return response()->json([
            // 'success' => true,
            // 'message' => 'Opération réussie',
            // 'data' => $RetourPaiementEnJSON, // variable contenant les données à renvoyer
            // 'paiement'=>$paiementinit
            // ]);

        } catch (\Throwable $e) {
            $Chaine .= "\n/// Une erreur s'est produite. DETAIL_ERR: " . $e->getMessage();
            $module = " Module Paiement";
            $action =  $Chaine;
            // Logs::saveLog($module, $action);
        }

        return 'Ok';
    }




    
    // public function callbacks(Request $request)
    // {
    //     (string) $RetourPaiementEnJSON = json_encode($request->input());
    //     (string) $Chaine = "Debut callback paiement, recu: " . $RetourPaiementEnJSON;
    //     try {
    //         (int) $Code = $request->code;
    //         (int) $Montant = $request->montant;
    //         (string) $codePaiement = $request->codePaiement;

    //         // Recupère le paiement en attente avec le statut '2'
    //         $paiementinit = PaiementInitial::where('code_paiement', $codePaiement)
    //             ->where('status', 2)
    //             ->first();

    //         if (!empty($paiementinit->id)) {
    //             if ($Code == 200) {
    //                 $paiement = new Paiement();
    //                 $paiement->code_paiement = $codePaiement;
    //                 $paiement->reference = $request->referencePaiement;
    //                 $paiement->moyen_paiement = $request->moyenPaiement;
    //                 $paiement->date_paiement_initial = $request->datePaiement;
    //                 $paiement->heure_paiement_initial =  $request->HeurePaiement;
    //                 $paiement->montant_total = $Montant;
    //                 $paiement->contact_paiement =  $request->numTel;
    //                 $paiement->client_id =  $paiementinit->client_id;
    //                 $paiement->correspondance_id =  $paiementinit->correspondance_id;
    //                 $paiement->type_paiement_id =  $paiementinit->type_paiement_id;
    //                 $paiement->status =  ($Code == 200 ? 1 : 2);
    //                 $paiement->save();
    //                 $paiementinit->reference = $request->referencePaiement;
    //                 $paiementinit->moyen_paiement = $request->moyenPaiement;
    //                 $paiementinit->date_paiement_initial = $request->datePaiement;
    //                 $paiementinit->heure_paiement_initial =  $request->HeurePaiement;
    //                 $paiementinit->contact_paiement =  $request->numTel;
    //                 $paiementinit->status =  ($Code == 200 ? 1 : 2);

    //                 /// mise des tableaux
    //                 $typePaiemnent = $paiement->type_paiement_id ?? $paiementinit->type_paiement_id;
    //                 if (!empty($typePaiemnent)) {
    //                     switch ($typePaiemnent) {
    //                         case 1:
    //                             // paiement de labelisations
    //                             $labelle = Labelle::find($paiement->correspondance_id ?? $paiementinit->correspondance_id);
    //                             if (!empty($labelle)) {
    //                                 $labelle->date_obtention = Carbon::now()->format('d-m-Y');       // 02-09-2025
    //                                 $labelle->date_expiration = Carbon::now()->addYear()->format('d-m-Y'); // 02-09-2026
    //                                 $labelle->status = 1;
    //                                 $labelle->save();
    //                                 $module = "Module Paiement Labelle";
    //                                 $action = "Paiement effectué avec succès - client labellisé";
    //                                 Logs::saveLog($module, $action);
    //                             } else {
    //                                 $Chaine .= "\n//// Labelle non trouvé pour le paiement.";
    //                                 $module = " Module Paiement Labelle";
    //                                 $action = 'a erreur s\'est produite  : ' . $Chaine;
    //                                 Logs::saveLog($module, $action);
    //                             }

    //                             break;
    //                         case 2:
    //                             // Paiement de conformites
    //                             $conformite = Conformite::find($paiement->correspondance_id ?? $paiementinit->correspondance_id);
    //                             if (!empty($conformite)) {
    //                                 $conformite->status = 1;
    //                                 $conformite->save();
    //                                 $module = "Module Paiement conformite";
    //                                 $action = "Paiement effectué avec succès - client demande de conformite";
    //                                 Logs::saveLog($module, $action);
    //                             } else {
    //                                 $Chaine .= "\n//// conformite non trouvé pour le paiement.";
    //                                 $module = " Module Paiement conformite";
    //                                 $action = 'a erreur s\'est produite  : ' . $Chaine;
    //                                 Logs::saveLog($module, $action);
    //                             }

    //                             break;

    //                         default:
    //                             $paiement->moyen_paiement = 'Inconnu';
    //                             $Chaine .= "\n//// Type de paiement introuvable ";
    //                             $module = " Module callback ";
    //                             $action = 'a erreur s\'est produite  : ' . $Chaine;
    //                             Logs::saveLog($module, $action);
    //                             break;
    //                     }

    //                     $module = " Module Paiement";
    //                     $action = 'a Effectuer un paiement succes sur le hub : ';
    //                     Logs::saveLog($module, $action);
    //                 } else {
    //                     $module = " Module Paiement";
    //                     $action = 'a erreur type paiement non defini  : ';
    //                     Logs::saveLog($module, $action);
    //                 }
    //             } else {
    //                 $paiementinit->status = 3; //
    //                 $paiementinit->reference = $request->referencePaiement ?? '';
    //                 $module = " Module Paiement";
    //                 $action = ' paiement echoue sur le hub : ';
    //                 Logs::saveLog($module, $action);
    //             }
    //             $paiementinit->save();
    //         } else {
    //             $Chaine .= "\n//// verification code paiement:#" . $codePaiement . "# introuvable ou déjà notifié dans 'paiement_en_attentes'";
    //             $module = " Module Paiement";
    //             $action =  $Chaine;
    //             Logs::saveLog($module, $action);
    //         }
    //     } catch (\Throwable $e) {
    //         $Chaine .= "\n/// Une erreur s'est produite. DETAIL_ERR: " . $e->getMessage();
    //         $module = " Module Paiement";
    //         $action =  $Chaine;
    //         Logs::saveLog($module, $action);
    //     }

    //     return 'Ok';
    // }
}
