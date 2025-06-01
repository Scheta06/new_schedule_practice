<?php
namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\ExtenceCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

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

    public function storeCategory(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
        ]);

        ExtenceCategory::create([
            'title'   => $validated['title'],
            'user_id' => Auth::user()->id,
            'car_id'  => $request->car_id,
        ]);

        return redirect()->route('myCars')->with('success', 'Категория создана');
    }

    public function update(Request $request, $id)
    {

    }

    public function destroy($id)
    {
        $car = Car::findOrFail($id);

        $car->delete();

        return redirect()->route('myCars')->with('sussess', 'Автомобиль успешно удален');
    }
}
