<?php

namespace App\Http\Controllers;

use App\Models\Compagnies;
use App\Models\Paiement;
use App\Models\PaiementEnAttente;
use App\Models\Reservation;
use App\Models\Voyage;
use Illuminate\Http\Request;

class PaiementController extends Controller
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
            // return response()->json([
            // "data"=> "test",
            // "montant"=> $RetourPaiementEnJSON,
            // "paiement"=>$paiementinit
            // ]);

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
                    // compagnie
                    $paiement->save();

                    $creation_reservations = new Reservation();
                    $creation_reservations->voyages_id = $paiementinit->voyages_id;
                    $creation_reservations->utilisateurs_id = $paiementinit->utilisateur_id;
                    $creation_reservations->numero_place = $paiementinit->numero_place;
                    $creation_reservations->id_arret_voayage = $paiementinit->id_arret_voayage; 
                    $creation_reservations->paiements_id = $paiement->id;
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
                    $paiement->status = 1;
                    $paiement->id_arret_voayage = $paiementinit->id_arret_voayage;
                    $paiement->datePaiement =  $request->datePaiement;
                    $paiement->HeurePaiement =  $request->HeurePaiement;
                    $paiement->code =  $request->code;
                    $paiement->referencePaiement =  $request->referencePaiement;
                    $paiement->telephone =  $request->numTel;
                    $paiement->moyenPaiement =  $request->moyenPaiement;
                    $paiement->compagnie_id = $compagnie->compagnie_id;
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
