<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NewCarController extends Controller
{
    public function index() {
        $user = Auth::user();
        return Inertia::render('NewCar', [
            'user_id' => $user->id
        ]);
    }
}
