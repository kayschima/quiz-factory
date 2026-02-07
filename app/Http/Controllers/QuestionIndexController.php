<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Question;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class QuestionIndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): Response
    {
        $categoryId = $request->query('category');
        $approved = $request->query('approved');

        $questions = Question::query()
            ->when($categoryId, function ($query, $categoryId) {
                return $query->where('category_id', $categoryId);
            })
            ->when($approved !== null && $approved !== 'all', function ($query) use ($approved) {
                return $query->where('approved', $approved === 'true' || $approved === '1');
            })
            ->when($approved === null, function ($query) {
                // Standardmäßig nur zugelassene Fragen zeigen, wenn kein Filter gesetzt ist?
                // Der User möchte "unterscheiden", also vermutlich alle sehen können.
                // Wenn wir auf die Seite kommen, zeigen wir vielleicht alle?
                // Bisher wurden nur 'approved' => true gezeigt.
                // Ich belasse es bei 'true' als Default, wenn nichts angegeben ist,
                // oder ich ändere es auf 'all' wenn der User alle sehen will.
                // "Baue über der Tabelle bitte auch noch einen Filter ein, der zwischen Fragen unterscheidet, die zugelassen (approved) sind oder nicht."
                // Ich denke, 'all' sollte der neue Standard sein oder 'approved'.
                // Da die Seite "Zugelassene Fragen" hieß (laut Index.vue H1), ist 'approved' ein guter Default.
                return $query->where('approved', true);
            })
            ->with('category')
            ->latest()
            ->orderBy('questions.text')
            ->paginate(10)
            ->withQueryString();

        return Inertia::render('Questions/Index', [
            'questions' => $questions,
            'categories' => Category::all(),
            'filters' => [
                'category' => $categoryId,
                'approved' => $approved ?? 'true',
            ],
        ]);
    }
}
