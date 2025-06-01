<?php
namespace App\Http\Controllers;

use App\Models\Extence;
use App\Models\ExtenceCategory;
use Illuminate\Http\Request;
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
        ]);
    }

    public function edit() {

    }

    public function update(Request $request) {

    }

    public function store(Request $request, $id, $category)
    {
        $data = $request->validate([
            'title' => 'string|required',
            'cost'  => 'float|required',
        ]);

        Extence::create([
            'title'       => $data['title'],
            'cost'        => $data['cost'],
            'car_id'      => $id,
            'category_id' => $category,
        ]);

        return redirect()->route('CategoryCart', ['id' => $id, 'category' => $category])->with('success', 'Расход добавлен');
    }

    public function destoy($id, $category)
    {
        $userCategory = ExtenceCategory::findOrFail($category);

        $userCategory->delete();

        return redirect()->route('CategoryCart', ['id' => $id, 'category' => $category])->with('success', 'Категория удалена');
    }
}
