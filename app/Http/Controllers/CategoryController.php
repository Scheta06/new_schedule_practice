<?php
namespace App\Http\Controllers;

use App\Models\Extence;
use App\Models\ExtenceCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class CategoryController extends Controller
{
    public function index(Request $request, $id, $category)
    {
        $categories = ExtenceCategory::findOrFail($category);
        $extences   = Extence::where(['category_id' => $category, 'car_id' => $id])->get();
        return Inertia::render('Category', [
            'categories' => $categories,
            'extences'   => $extences,
            'id'         => $id,
            'category'   => $category,
        ]);
    }

    public function store(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
        ]);

        ExtenceCategory::create([
            'title'   => $validated['title'],
            'user_id' => Auth::user()->id,
            'car_id'  => $request->car_id,
        ]);

        return redirect()->route('carCart', ['id' => $request->car_id])->with('success', 'Категория создана');
    }

    public function destroy($carId, $categoryId)
    {
        $category = ExtenceCategory::findOrFail($categoryId);

        $category->delete();

        return redirect()->route('carCart', ['id' => $carId])->with('success', 'Категория удалена');
    }
}
