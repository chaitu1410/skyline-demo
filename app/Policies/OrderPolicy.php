<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Order;
use Illuminate\Support\Carbon;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderPolicy
{
    use HandlesAuthorization;

    public function __construct()
    {
        //
    }

    public function cancel(User $user, Order $order)
    {
        if ($order->status == config('constants.orderStatus.cancelled')) {
            return false;
        }
        return !$order->isDelivered;
    }

    public function return(User $user, Order $order)
    {
        if (!$order->isDelivered || $order->status == config('constants.orderStatus.returned')) {
            return false;
        }
        return Carbon::parse($order->delivered_at)->addDays(8) > Carbon::now();
    }

    public function update(User $user, Order $order)
    {
        return $user->id == $order->user->id;
    }

    public function view(User $user, Order $order)
    {
        return $user->id == $order->user->id;
    }
}
