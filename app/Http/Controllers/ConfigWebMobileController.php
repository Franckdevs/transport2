<?php

namespace App\Http\Controllers;

use App\Models\ConfigWebMobile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ConfigWebMobileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $configWebMobile = ConfigWebMobile::first();
        if (!$configWebMobile) {
            $configWebMobile = new ConfigWebMobile();
        }
        return view('betro.config_web_mobile.config', compact('configWebMobile'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return redirect()->route('config_web_mobile.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image_acceuil_mobile' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:102400',
            'sous_image_acceuil_mobile' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:102400',
            'image_acceuil_web' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:102400',
            'sous_image_acceuil_web' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:102400',
            'image_connexion_web' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:102400',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->except(['_token', '_method']);

        // Gestion des uploads d'images
        $imageFields = [
            'image_acceuil_mobile',
            'sous_image_acceuil_mobile',
            'image_acceuil_web',
            'sous_image_acceuil_web',
            'image_connexion_web'
        ];

        foreach ($imageFields as $field) {
            if ($request->hasFile($field)) {
                $image = $request->file($field);
                $imageName = time() . '_' . $field . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('config_web_mobile'), $imageName);
                $data[$field] = $imageName;
            }
        }

        ConfigWebMobile::updateOrCreate(['id' => 1], $data);

        return redirect()->route('config_web_mobile.index')
            ->with('success', 'Configuration enregistrée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ConfigWebMobile $configWebMobile)
    {
        return redirect()->route('config_web_mobile.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ConfigWebMobile $configWebMobile)
    {
        return redirect()->route('config_web_mobile.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ConfigWebMobile $configWebMobile)
    {
        $validator = Validator::make($request->all(), [
            'image_acceuil_mobile' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:102400',
            'sous_image_acceuil_mobile' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:102400',
            'image_acceuil_web' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:102400',
            'sous_image_acceuil_web' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:102400',
            'image_connexion_web' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:102400',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->except(['_token', '_method']);

        // Gestion des uploads d'images
        $imageFields = [
            'image_acceuil_mobile',
            'sous_image_acceuil_mobile',
            'image_acceuil_web',
            'sous_image_acceuil_web',
            'image_connexion_web'
        ];

        foreach ($imageFields as $field) {
            if ($request->hasFile($field)) {
                // Supprimer l'ancienne image si elle existe
                if ($configWebMobile->$field) {
                    $oldImagePath = public_path('config_web_mobile/' . $configWebMobile->$field);
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }

                $image = $request->file($field);
                $imageName = time() . '_' . $field . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('config_web_mobile'), $imageName);
                $data[$field] = $imageName;
            }
        }

        ConfigWebMobile::updateOrCreate(['id' => 1], $data);

        return redirect()->route('config_web_mobile.index')
            ->with('success', 'Configuration mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ConfigWebMobile $configWebMobile)
    {
        // Supprimer les images associées
        $imageFields = [
            'image_acceuil_mobile',
            'sous_image_acceuil_mobile',
            'image_acceuil_web',
            'sous_image_acceuil_web',
            'image_connexion_web'
        ];

        foreach ($imageFields as $field) {
            if ($configWebMobile->$field) {
                $imagePath = public_path('config_web_mobile/' . $configWebMobile->$field);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
        }

        $configWebMobile->delete();

        return redirect()->route('config_web_mobile.index')
            ->with('success', 'Configuration supprimée avec succès.');
    }

    /**
     * API pour récupérer l'image accueil mobile
     */
    public function getImageAccueilMobile()
    {
        $config = ConfigWebMobile::first();
        if (!$config || !$config->image_acceuil_mobile) {
            return response()->json(['message' => 'Image non trouvée'], 404);
        }
        
        return response()->json([
            'image_url' => asset('config_web_mobile/' . $config->image_acceuil_mobile),
            'image_name' => $config->image_acceuil_mobile
        ]);
    }

    /**
     * API pour récupérer la sous image accueil mobile
     */
    public function getSousImageAccueilMobile()
    {
        $config = ConfigWebMobile::first();
        if (!$config || !$config->sous_image_acceuil_mobile) {
            return response()->json(['message' => 'Image non trouvée'], 404);
        }
        
        return response()->json([
            'image_url' => asset('config_web_mobile/' . $config->sous_image_acceuil_mobile),
            'image_name' => $config->sous_image_acceuil_mobile
        ]);
    }

    /**
     * API pour récupérer l'image accueil web
     */
    public function getImageAccueilWeb()
    {
        $config = ConfigWebMobile::first();
        if (!$config || !$config->image_acceuil_web) {
            return response()->json(['message' => 'Image non trouvée'], 404);
        }
        
        return response()->json([
            'image_url' => asset('config_web_mobile/' . $config->image_acceuil_web),
            'image_name' => $config->image_acceuil_web
        ]);
    }

    /**
     * API pour récupérer la sous image accueil web
     */
    public function getSousImageAccueilWeb()
    {
        $config = ConfigWebMobile::first();
        if (!$config || !$config->sous_image_acceuil_web) {
            return response()->json(['message' => 'Image non trouvée'], 404);
        }
        
        return response()->json([
            'image_url' => asset('config_web_mobile/' . $config->sous_image_acceuil_web),
            'image_name' => $config->sous_image_acceuil_web
        ]);
    }

    /**
     * API pour récupérer l'image connexion web
     */
    public function getImageConnexionWeb()
    {
        $config = ConfigWebMobile::first();
        if (!$config || !$config->image_connexion_web) {
            return response()->json(['message' => 'Image non trouvée'], 404);
        }
        
        return response()->json([
            'image_url' => asset('config_web_mobile/' . $config->image_connexion_web),
            'image_name' => $config->image_connexion_web
        ]);
    }

    /**
     * API pour récupérer toute la configuration
     */
    public function getAllConfig()
    {
        $config = ConfigWebMobile::first();
        
        if (!$config) {
            return response()->json(['message' => 'Aucune configuration trouvée'], 404);
        }

        return response()->json([
            'image_acceuil_mobile' => $config->image_acceuil_mobile ? asset('config_web_mobile/' . $config->image_acceuil_mobile) : null,
            'sous_image_acceuil_mobile' => $config->sous_image_acceuil_mobile ? asset('config_web_mobile/' . $config->sous_image_acceuil_mobile) : null,
            'image_acceuil_web' => $config->image_acceuil_web ? asset('config_web_mobile/' . $config->image_acceuil_web) : null,
            'sous_image_acceuil_web' => $config->sous_image_acceuil_web ? asset('config_web_mobile/' . $config->sous_image_acceuil_web) : null,
            'image_connexion_web' => $config->image_connexion_web ? asset('config_web_mobile/' . $config->image_connexion_web) : null,
            'status' => $config->status,
            'created_at' => $config->created_at,
            'updated_at' => $config->updated_at
        ]);
    }

    /**
     * API pour récupérer la configuration active
     */
    public function getActiveConfig()
    {
        $config = ConfigWebMobile::where('status', '1')->first();
        
        if (!$config) {
            return response()->json([
                'message' => 'Aucune configuration active trouvée'
            ], 404);
        }

        return response()->json($config);
    }

    /**
     * Activer/Désactiver une configuration
     */
    public function toggleStatus(ConfigWebMobile $configWebMobile)
    {
        $newStatus = $configWebMobile->status == '1' ? '2' : '1';
        $configWebMobile->update(['status' => $newStatus]);

        return redirect()->back()
            ->with('success', 'Statut de la configuration mis à jour avec succès.');
    }
}
