<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;

class PermissionHelper
{
    /**
     * Vérifier si l'utilisateur connecté a une permission spécifique
     */
    public static function can($permission)
    {
        if (!Auth::check()) {
            return false;
        }

        return Auth::user()->can($permission);
    }

    /**
     * Vérifier si l'utilisateur connecté a un rôle spécifique
     */
    public static function hasRole($role)
    {
        if (!Auth::check()) {
            return false;
        }

        return Auth::user()->hasRole($role);
    }

    /**
     * Vérifier si l'utilisateur connecté a au moins un des rôles spécifiés
     */
    public static function hasAnyRole($roles)
    {
        if (!Auth::check()) {
            return false;
        }

        return Auth::user()->hasAnyRole($roles);
    }

    /**
     * Obtenir toutes les permissions de l'utilisateur connecté
     */
    public static function getAllPermissions()
    {
        if (!Auth::check()) {
            return collect();
        }

        return Auth::user()->getAllPermissions();
    }

    /**
     * Vérifier si l'utilisateur peut voir le dashboard BETRO
     */
    public static function canViewBetroDashboard()
    {
        return self::can('view-dashboard-betro');
    }

    /**
     * Vérifier si l'utilisateur peut voir le dashboard Compagnie
     */
    public static function canViewCompagnieDashboard()
    {
        return self::can('view-dashboard-compagnie');
    }

    /**
     * Vérifier si l'utilisateur peut voir le dashboard Gare
     */
    public static function canViewGareDashboard()
    {
        return self::can('view-dashboard-gare');
    }

    /**
     * Vérifier si l'utilisateur peut gérer les utilisateurs
     */
    public static function canManageUsers()
    {
        return self::can('manage-users');
    }

    /**
     * Vérifier si l'utilisateur peut créer
     */
    public static function canCreate()
    {
        return self::can('create');
    }

    /**
     * Vérifier si l'utilisateur peut modifier
     */
    public static function canUpdate()
    {
        return self::can('update');
    }

    /**
     * Vérifier si l'utilisateur peut supprimer
     */
    public static function canDelete()
    {
        return self::can('delete');
    }

    /**
     * Vérifier si l'utilisateur peut exporter
     */
    public static function canExport()
    {
        return self::can('export');
    }
}
