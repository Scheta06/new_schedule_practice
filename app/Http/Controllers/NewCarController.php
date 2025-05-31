<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Generation;
use App\Models\Mark;
use App\Models\Pattern;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class NewCarController extends Controller
{
    public function index()
    {
        return Inertia::render('NewCar', [
            'user_id' => Auth::id(),
            'marks' => Mark::all(),
            'patterns' => [],
            'generations' => [],
        ]);
    }

    public function getPatterns(Request $request)
    {
        return Pattern::where('mark_id', $request->mark_id)->get();
    }

    public function getGenerations(Request $request)
    {
        return Generation::where('pattern_id', $request->pattern_id)->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|lowercase',
            'user_id' => 'required|integer',
            'mark_id' => 'required|integer',
            'pattern_id' => 'required|integer',
            'generation_id' => 'required|integer',
        ]);

        Car::create($data);

        return redirect()->route('myCars')->with('success', 'Автомобиль успешно создан');
    }
}