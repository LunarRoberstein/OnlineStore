<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class MyAccountController extends Controller
{
    public function orders()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $viewData = [];
        $viewData["title"] = "My Orders - Bulan's Store";
        $viewData["subtitle"] = "My Orders";

        $viewData["orders"] = Order::where(
            'user_id',
            $user->getId()
        )->get();

        return view('myaccount.orders')
            ->with("viewData", $viewData);

        dd(view()->exists('myaccount.orders'));
    }
}
