<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Inertia\Inertia;
use function Laravel\Prompts\select;
use Illuminate\Support\Facades\Auth;

class CarController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $cars = Car::where('user_id', $user->id)->get();
        return Inertia::render('Cars', [
            'user' => [
                'surname' => $user->surname,
                'name' => $user->name,
                'patronymic' => $user->patronymic,
            ],
            'email' => $user->email,
            'carsInfo' => $cars,
        ]);
    }

    public function show($id) {
        $carInfo = Car::with(['pattern', 'generation', 'mark', 'extence'])->where(['id' => $id])->get();

        return Inertia::render('Car', [
            'carInfo' => $carInfo
        ]);
    }
}
