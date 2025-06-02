<?php
namespace App\Http\Controllers;

use App\Models\Car;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\ExtenceCategory;
use Illuminate\Support\Facades\Auth;

class CarController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $cars = Car::where('user_id', $user->id)->get();
        return Inertia::render('Cars', [
            'user'     => [
                'surname'    => $user->surname,
                'name'       => $user->name,
                'patronymic' => $user->patronymic,
            ],
            'email'    => $user->email,
            'carsInfo' => $cars,
            '',
        ]);
    }

    public function show($id)
    {
        $userId     = Auth::user()->id;
        $carInfo    = Car::with(['pattern', 'generation', 'mark', 'extence'])->where(['id' => $id])->get();
        $categories = ExtenceCategory::where(['user_id' => $userId, 'car_id' => $id])->get();

        return Inertia::render('Car', [
            'carInfo'    => $carInfo,
            'user_id'    => $userId,
            'categories' => $categories,
        ]);
    }

    public function destroy($id)
    {
        $car = Car::findOrFail($id);

        $car->delete();

        return redirect()->route('myCars')->with('sussess', 'Автомобиль успешно удален');
    }
}
