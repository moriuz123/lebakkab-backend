<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ProfilOpd;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProfilOpdPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_profil::opd') || $user->can('view_any_profil_opd');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, ProfilOpd $profilOpd): bool
    {
        return $user->can('view_profil::opd') || $user->can('view_profil_opd');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        $canCreate = $user->can('create_profil::opd') || $user->can('create_profil_opd');
        
        if (!$canCreate) {
            return false;
        }

        // Jika bukan super_admin dan sudah punya OPD, cek apakah sudah ada profilnya
        if (!$user->hasRole('super_admin') && $user->opd_id) {
            return ProfilOpd::where('opd_id', $user->opd_id)->doesntExist();
        }

        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, ProfilOpd $profilOpd): bool
    {
        return $user->can('update_profil::opd') || $user->can('update_profil_opd');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ProfilOpd $profilOpd): bool
    {
        return $user->can('delete_profil::opd') || $user->can('delete_profil_opd');
    }

    /**
     * Determine whether the user can bulk delete.
     */
    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_profil::opd') || $user->can('delete_any_profil_opd');
    }

    /**
     * Determine whether the user can permanently delete.
     */
    public function forceDelete(User $user, ProfilOpd $profilOpd): bool
    {
        return $user->can('force_delete_profil::opd') || $user->can('force_delete_profil_opd');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->can('force_delete_any_profil::opd') || $user->can('force_delete_any_profil_opd');
    }

    /**
     * Determine whether the user can restore.
     */
    public function restore(User $user, ProfilOpd $profilOpd): bool
    {
        return $user->can('restore_profil::opd') || $user->can('restore_profil_opd');
    }

    /**
     * Determine whether the user can bulk restore.
     */
    public function restoreAny(User $user): bool
    {
        return $user->can('restore_any_profil::opd') || $user->can('restore_any_profil_opd');
    }

    /**
     * Determine whether the user can replicate.
     */
    public function replicate(User $user, ProfilOpd $profilOpd): bool
    {
        return $user->can('replicate_profil::opd') || $user->can('replicate_profil_opd');
    }

    /**
     * Determine whether the user can reorder.
     */
    public function reorder(User $user): bool
    {
        return $user->can('reorder_profil::opd') || $user->can('reorder_profil_opd');
    }
}
