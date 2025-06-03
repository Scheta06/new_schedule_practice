<?php
namespace App\Http\Controllers;

use App\Models\Extence;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ExtenceController extends Controller
{
    public function store(Request $request, $id, $category)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'cost' => 'required|numeric|min:0',
        ]);

        Extence::create([
            'title' => $validated['title'],
            'cost' => $validated['cost'],
            'car_id' => $id,
            'category_id' => $category,
        ]);

        return back()->with('success', 'Расход добавлен');
    }

    public function edit($id, $category, $extence)
    {
        $extenceInfo = Extence::where(['id' => $extence])->get();

        return Inertia::render('Edit/Extence', ['extenceInfo' => $extenceInfo]);
    }

    public function update(Request $request)
    {

    }

    public function destroy($carId, $categoryId, $extenceId)
    {
        $userCategory = Extence::findOrFail($extenceId);
        $userCategory->delete();

        return redirect()->route('CategoryCart', ['id' => $carId, 'category' => $categoryId])->with('success', 'Расход удален');
    }
}
