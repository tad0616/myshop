<?php

namespace App\Observers;

use App\Cart;
use Illuminate\Support\Facades\Auth;


class CartObserver
{
    /**
     * Handle the cart "creating" event.
     *
     * @param  \App\Cart  $cart
     * @return void
     */
    public function creating(Cart $cart)
    {
        if (Auth::check()) {
            $cart->user_id = Auth::id();
        }
    }

    /**
     * Handle the cart "updating" event.
     *
     * @param  \App\Cart  $cart
     * @return void
     */
    public function updating(Cart $cart)
    {
        if (Auth::check()) {
            $cart->user_id = Auth::id();
        }
    }

}
