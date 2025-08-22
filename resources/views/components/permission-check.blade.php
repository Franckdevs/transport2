@props(['permission' => null, 'role' => null, 'any' => false])

@php
    use App\Helpers\PermissionHelper;
    
    $canShow = false;
    
    if ($permission && $role) {
        // Si les deux sont spécifiés, l'utilisateur doit avoir la permission ET le rôle
        $canShow = PermissionHelper::can($permission) && PermissionHelper::hasRole($role);
    } elseif ($permission) {
        // Vérifier seulement la permission
        if (is_array($permission)) {
            $canShow = $any ? 
                collect($permission)->some(fn($perm) => PermissionHelper::can($perm)) :
                collect($permission)->every(fn($perm) => PermissionHelper::can($perm));
        } else {
            $canShow = PermissionHelper::can($permission);
        }
    } elseif ($role) {
        // Vérifier seulement le rôle
        if (is_array($role)) {
            $canShow = $any ? 
                PermissionHelper::hasAnyRole($role) :
                collect($role)->every(fn($r) => PermissionHelper::hasRole($r));
        } else {
            $canShow = PermissionHelper::hasRole($role);
        }
    }
@endphp

@if($canShow)
    {{ $slot }}
@endif
