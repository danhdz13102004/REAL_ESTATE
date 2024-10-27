<?php

namespace App\Policies;

use App\Models\Listing;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ListingPolicy
{



    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Listing $listing): bool
    {
        
        return $user->id == $listing->user_id || $user->is_admin;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Listing $listing): bool
    {
        return $user->id == $listing->user_id || $user->id_admin;
    }

    public function restore(User $user, Listing $listing): bool
    {
        return $user->id == $listing->user_id || $user->id_admin;
    }

    public function offers(User $user, Listing $listing): bool
    {
        return $user->id == $listing->user_id || $user->id_admin;
    }

    public function addoffer(User $user, Listing $listing): bool
    {
        return $user->id != $listing->id;
    }


}
