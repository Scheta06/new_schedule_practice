<?php
namespace App\Http\Controllers;

use App\Models\Extence;
use App\Models\ExtenceCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class CategoryController extends Controller
{
    public function index($id, $category)
    {
        $categories = ExtenceCategory::findOrFail($category);

        $extences = Extence::where('category_id', $category)
            ->where('car_id', $id)
            ->get()
            ->map(function ($item) {
                return [
                    'id'         => $item->id,
                    'title'      => $item->title,
                    'cost'       => $item->cost,
                    'created_at' => $item->created_at->format('H:i:s d-m-Y'),
                ];
            });

        $monthNames = [
            'january', 'february', 'march', 'april', 'may', 'june',
            'july', 'august', 'september', 'october', 'november', 'december',
        ];

        $ChartData = [
            'title' => $categories->title,
            'data'  => [],
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
                    'month'       => $monthNumber,
                    'car_id'      => $id,
                    'category_id' => $category,
                ]
            );
            $ChartData['data'][$month] = $result[0]->total ?? 0;
        }

        return Inertia::render('Category', [
            'categories' => $categories,
            'extences'   => $extences,
            'ChartData'  => $ChartData,
            'id'         => $id,
            'category'   => $category,
        ]);
    }

    public function sortDate($id, $category, Request $request)
    {
        $amountSort = $request->input('amount_sort');
        $dateSort   = $request->input('date_sort');

        $query = Extence::where('car_id', $id)
            ->where('category', $category);

        if ($amountSort && in_array($amountSort, ['asc', 'desc'])) {
            $query->orderBy('amount', $amountSort);
        }

        if ($dateSort && in_array($dateSort, ['asc', 'desc'])) {
            $query->orderBy('created_at', $dateSort);
        }

        $results = $query->get();

        return Inertia::render('Category', [
            'results' => $results,
            'filters' => [
                'amount_sort' => $amountSort,
                'date_sort'   => $dateSort,
            ],
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
