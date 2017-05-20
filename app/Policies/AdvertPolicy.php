<?php

namespace App\Policies;

use App\User;
use App\Advert;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdvertPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        return true;
    }

    /**
     * Determine whether the user can view the advert.
     *
     * @param  \App\User  $user
     * @param  \App\Advert  $advert
     * @return mixed
     */
    public function view(User $user, Advert $advert)
    {
        //
    }

    /**
     * Determine whether the user can create adverts.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the advert.
     *
     * @param  \App\User  $user
     * @param  \App\Advert  $advert
     * @return mixed
     */
    public function update(User $user, Advert $advert)
    {
        return $user->id === $advert->user_id;
    }

    /**
     * Determine whether the user can delete the advert.
     *
     * @param  \App\User  $user
     * @param  \App\Advert  $advert
     * @return mixed
     */
    public function delete(User $user, Advert $advert)
    {
        //
    }
}
