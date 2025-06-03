<?php
namespace App\Http\Controllers;

use App\Models\ExtenceCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class CategoryController extends Controller
{
    public function index($id, $category)
    {
        $categories = ExtenceCategory::findOrFail($category);
        $extences = DB::table('extences')
            ->select('id', 'title', 'cost', 'created_at')
            ->where('category_id', $category)
            ->where('car_id', $id)
            ->get()
            ->map(function ($item) {
                $item->created_at = Carbon::parse($item->created_at)->format('H:i:s d-m-Y');
                return $item;
            });
        $monthNames = [
            'january', 'february', 'march', 'april', 'may', 'june',
            'july', 'august', 'september', 'october', 'november', 'december',
        ];

        $ChartData = [
            'title' => $categories->title,
            'data' => [],
        ];

        foreach ($monthNames as $index => $month) {
            $monthNumber = $index + 1;

            $result = DB::select(
                'SELECT SUM(cost) as total
                 FROM extences
                 WHERE MONTH(created_at) = :month
                   AND car_id = :car_id
                   AND category_id = :category_id',
                [
                    'month' => $monthNumber,
                    'car_id' => $id,
                    'category_id' => $category,
                ]
            );
            $ChartData['data'][$month] = $result[0]->total ?? 0;
        }

        return Inertia::render('Category', [
            'categories' => $categories,
            'extences' => $extences,
            'id' => $id,
            'category' => $category,
            'ChartData' => $ChartData,
        ]);
    }

    public function store(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
        ]);

        ExtenceCategory::create([
            'title' => $validated['title'],
            'user_id' => Auth::user()->id,
            'car_id' => $request->car_id,
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
