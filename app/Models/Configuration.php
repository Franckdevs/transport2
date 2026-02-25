<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Configuration extends Model
{
    protected $fillable = [
        'cle',
        'valeur',
        'type',
        'description',
        'est_actif',
        'groupe'
    ];

    protected $casts = [
        'est_actif' => 'boolean',
        'valeur' => 'array',
    ];

    /**
     * Récupère une configuration par sa clé
     *
     * @param string $cle
     * @param mixed $valeurParDefaut
     * @return mixed
     */
    public static function getConfig($cle, $valeurParDefaut = null)
    {
        return Cache::rememberForever('config_' . $cle, function () use ($cle, $valeurParDefaut) {
            $config = static::where('cle', $cle)->where('est_actif', true)->first();
            
            if (!$config) {
                return $valeurParDefaut;
            }

            // Convertir la valeur selon le type
            return match($config->type) {
                'integer' => (int) $config->valeur,
                'float' => (float) $config->valeur,
                'boolean' => (bool) $config->valeur,
                'json' => json_decode($config->valeur, true),
                default => $config->valeur,
            };
        });
    }

    /**
     * Définit une valeur de configuration
     *
     * @param string $cle
     * @param mixed $valeur
     * @param string $type
     * @param string|null $description
     * @param string $groupe
     * @return Configuration
     */
    public static function setConfig($cle, $valeur, $type = 'string', $description = null, $groupe = 'general')
    {
        // Supprimer le cache pour cette clé
        Cache::forget('config_' . $cle);

        $config = static::updateOrCreate(
            ['cle' => $cle],
            [
                'valeur' => is_array($valeur) ? json_encode($valeur) : $valeur,
                'type' => $type,
                'description' => $description,
                'groupe' => $groupe,
                'est_actif' => true
            ]
        );

        return $config;
    }

    /**
     * Désactive une configuration
     *
     * @param string $cle
     * @return bool
     */
    public static function disableConfig($cle)
    {
        Cache::forget('config_' . $cle);
        return static::where('cle', $cle)->update(['est_actif' => false]);
    }

    /**
     * Récupère toutes les configurations d'un groupe
     *
     * @param string $groupe
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getGroupe($groupe)
    {
        return static::where('groupe', $groupe)
            ->where('est_actif', true)
            ->pluck('valeur', 'cle')
            ->toArray();
    }
}
