<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CoinsController extends Controller
{
    public function getCoins(Request $request)
    {
        $token = $request->input('token');

        if (empty($token)) {
            abort(404, 'tokenya mana cuy');
            redirect()->back();
        }
        return view('coins', [
            'token' => $token
        ]);
    }
}
