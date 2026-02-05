<?php

namespace Database\Seeders;

use App\Models\Answer;
use App\Models\Category;
use App\Models\Difficulty;
use App\Models\Question;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all()->pluck('id', 'name');
        $difficulties = Difficulty::all()->pluck('id', 'name');

        $questions = [
            [
                'text' => 'In welchem Jahr wurde der FC St. Pauli offiziell gegründet?',
                'category' => 'Verein',
                'difficulty' => 'leicht',
                'answers' => [
                    ['text' => '1910', 'is_correct' => true],
                    ['text' => '1899', 'is_correct' => false],
                    ['text' => '1907', 'is_correct' => false],
                    ['text' => '1920', 'is_correct' => false],
                ],
            ],
            [
                'text' => 'Wie heißt das Stadion des FC St. Pauli?',
                'category' => 'Stadion',
                'difficulty' => 'sehr leicht',
                'answers' => [
                    ['text' => 'Millerntor-Stadion', 'is_correct' => true],
                    ['text' => 'Volksparkstadion', 'is_correct' => false],
                    ['text' => 'Weserstadion', 'is_correct' => false],
                    ['text' => 'St. Pauli Arena', 'is_correct' => false],
                ],
            ],
            [
                'text' => 'Welches Symbol ist untrennbar mit dem FC St. Pauli verbunden?',
                'category' => 'Verein',
                'difficulty' => 'sehr leicht',
                'answers' => [
                    ['text' => 'Totenkopf', 'is_correct' => true],
                    ['text' => 'Anker', 'is_correct' => false],
                    ['text' => 'Löwe', 'is_correct' => false],
                    ['text' => 'Adler', 'is_correct' => false],
                ],
            ],
            [
                'text' => 'Wer war der Trainer beim legendären Sieg gegen den FC Bayern München als "Weltpokalsiegerbesieger"?',
                'category' => 'Trainer',
                'difficulty' => 'schwer',
                'answers' => [
                    ['text' => 'Dietmar Demuth', 'is_correct' => true],
                    ['text' => 'Holger Stanislawski', 'is_correct' => false],
                    ['text' => 'Ewald Lienen', 'is_correct' => false],
                    ['text' => 'Jos Luhukay', 'is_correct' => false],
                ],
            ],
            [
                'text' => 'In welchem Hamburger Stadtteil liegt das Millerntor-Stadion?',
                'category' => 'Stadtteil',
                'difficulty' => 'sehr leicht',
                'answers' => [
                    ['text' => 'St. Pauli', 'is_correct' => true],
                    ['text' => 'Altona', 'is_correct' => false],
                    ['text' => 'Eimsbüttel', 'is_correct' => false],
                    ['text' => 'Sternschanze', 'is_correct' => false],
                ],
            ],
            [
                'text' => 'Wie lautet der Spitzname der Mannschaft?',
                'category' => 'Verein',
                'difficulty' => 'leicht',
                'answers' => [
                    ['text' => 'Kiezkicker', 'is_correct' => true],
                    ['text' => 'Rothosen', 'is_correct' => false],
                    ['text' => 'Wölfe', 'is_correct' => false],
                    ['text' => 'Knappen', 'is_correct' => false],
                ],
            ],
            [
                'text' => 'Welches Lied wird traditionell beim Einlaufen der Mannschaften gespielt?',
                'category' => 'Stadion',
                'difficulty' => 'mittel',
                'answers' => [
                    ['text' => 'Hells Bells (AC/DC)', 'is_correct' => true],
                    ['text' => 'Song 2 (Blur)', 'is_correct' => false],
                    ['text' => 'You\'ll Never Walk Alone', 'is_correct' => false],
                    ['text' => 'Auf der Reeperbahn nachts um halb eins', 'is_correct' => false],
                ],
            ],
            [
                'text' => 'Wer ist Rekordtorschütze des FC St. Pauli in der 2. Bundesliga?',
                'category' => 'Spieler',
                'difficulty' => 'schwer',
                'answers' => [
                    ['text' => 'Franz Gerber', 'is_correct' => true],
                    ['text' => 'Marius Ebbers', 'is_correct' => false],
                    ['text' => 'Fabian Boll', 'is_correct' => false],
                    ['text' => 'Ivan Klasnic', 'is_correct' => false],
                ],
            ],
            [
                'text' => 'Gegen welchen Verein gelang 2002 der berühmte 2:1 Sieg als "Weltpokalsiegerbesieger"?',
                'category' => 'Historie',
                'difficulty' => 'leicht',
                'answers' => [
                    ['text' => 'FC Bayern München', 'is_correct' => true],
                    ['text' => 'Real Madrid', 'is_correct' => false],
                    ['text' => 'Borussia Dortmund', 'is_correct' => false],
                    ['text' => 'Hamburger SV', 'is_correct' => false],
                ],
            ],
            [
                'text' => 'Wie viele Zuschauer fasst das Millerntor-Stadion etwa?',
                'category' => 'Stadion',
                'difficulty' => 'mittel',
                'answers' => [
                    ['text' => 'ca. 29.500', 'is_correct' => true],
                    ['text' => 'ca. 45.000', 'is_correct' => false],
                    ['text' => 'ca. 15.000', 'is_correct' => false],
                    ['text' => 'ca. 57.000', 'is_correct' => false],
                ],
            ],
            [
                'text' => 'Welcher ehemalige St. Pauli Spieler wurde später Sportdirektor und Trainer des Vereins?',
                'category' => 'Funktionäre',
                'difficulty' => 'mittel',
                'answers' => [
                    ['text' => 'Holger Stanislawski', 'is_correct' => true],
                    ['text' => 'Thomas Meggle', 'is_correct' => true],
                    ['text' => 'Andreas Rettig', 'is_correct' => false],
                    ['text' => 'Ewald Lienen', 'is_correct' => false],
                ],
            ],
            [
                'text' => 'Was passiert traditionell nach einem Tor für St. Pauli im Stadion?',
                'category' => 'Stadion',
                'difficulty' => 'mittel',
                'answers' => [
                    ['text' => 'Song 2 von Blur wird gespielt', 'is_correct' => true],
                    ['text' => 'Eine Kanone wird abgefeuert', 'is_correct' => false],
                    ['text' => 'Die Fans singen die Nationalhymne', 'is_correct' => false],
                    ['text' => 'Es gibt Freibier für alle', 'is_correct' => false],
                ],
            ],
            [
                'text' => 'Wer war lange Zeit Präsident des FC St. Pauli und ist auch als Theatermacher bekannt?',
                'category' => 'Funktionäre',
                'difficulty' => 'leicht',
                'answers' => [
                    ['text' => 'Corny Littmann', 'is_correct' => true],
                    ['text' => 'Oke Göttlich', 'is_correct' => false],
                    ['text' => 'Stefan Orth', 'is_correct' => false],
                    ['text' => 'Andreas Rettig', 'is_correct' => false],
                ],
            ],
            [
                'text' => 'In welcher Liga spielte der FC St. Pauli in der Saison 2023/2024?',
                'category' => 'Historie',
                'difficulty' => 'leicht',
                'answers' => [
                    ['text' => '2. Bundesliga', 'is_correct' => true],
                    ['text' => '1. Bundesliga', 'is_correct' => false],
                    ['text' => '3. Liga', 'is_correct' => false],
                    ['text' => 'Regionalliga Nord', 'is_correct' => false],
                ],
            ],
            [
                'text' => 'Welcher Spieler ist für seine lange Treue bekannt und trug die Rückennummer 17?',
                'category' => 'Spieler',
                'difficulty' => 'mittel',
                'answers' => [
                    ['text' => 'Fabian Boll', 'is_correct' => true],
                    ['text' => 'Jan-Philipp Kalla', 'is_correct' => false],
                    ['text' => 'Sören Gonther', 'is_correct' => false],
                    ['text' => 'Johannes Flum', 'is_correct' => false],
                ],
            ],
            [
                'text' => 'Welcher dieser Begriffe beschreibt eine Ultra-Gruppierung des FC St. Pauli?',
                'category' => 'Verein',
                'difficulty' => 'mittel',
                'answers' => [
                    ['text' => 'Ultrà Sankt Pauli (USP)', 'is_correct' => true],
                    ['text' => 'Schickeria', 'is_correct' => false],
                    ['text' => 'The Unity', 'is_correct' => false],
                    ['text' => 'Chosen Few', 'is_correct' => false],
                ],
            ],
            [
                'text' => 'Gegen wen bestreitet der FC St. Pauli das Hamburger Stadtderby?',
                'category' => 'Verein',
                'difficulty' => 'sehr leicht',
                'answers' => [
                    ['text' => 'Hamburger SV', 'is_correct' => true],
                    ['text' => 'Altona 93', 'is_correct' => false],
                    ['text' => 'SC Victoria Hamburg', 'is_correct' => false],
                    ['text' => 'FC Schalke 04', 'is_correct' => false],
                ],
            ],
            [
                'text' => 'Wie heißt die Fan-Kurve im Süden des Stadions?',
                'category' => 'Stadion',
                'difficulty' => 'mittel',
                'answers' => [
                    ['text' => 'Südkurve', 'is_correct' => true],
                    ['text' => 'Gegengerade', 'is_correct' => false],
                    ['text' => 'Haupttribüne', 'is_correct' => false],
                    ['text' => 'Nordtribüne', 'is_correct' => false],
                ],
            ],
            [
                'text' => 'Welcher ehemalige Trainer ist für seine "Zettelwirtschaft" und emotionale Art bekannt?',
                'category' => 'Trainer',
                'difficulty' => 'mittel',
                'answers' => [
                    ['text' => 'Ewald Lienen', 'is_correct' => true],
                    ['text' => 'Olaf Janßen', 'is_correct' => false],
                    ['text' => 'Markus Kauczinski', 'is_correct' => false],
                    ['text' => 'Timo Schultz', 'is_correct' => false],
                ],
            ],
            [
                'text' => 'In welchem Jahr gelang der Aufstieg in die 1. Bundesliga unter Trainer Fabian Hürzeler?',
                'category' => 'Historie',
                'difficulty' => 'leicht',
                'answers' => [
                    ['text' => '2024', 'is_correct' => true],
                    ['text' => '2010', 'is_correct' => false],
                    ['text' => '2001', 'is_correct' => false],
                    ['text' => '1988', 'is_correct' => false],
                ],
            ],
        ];

        foreach ($questions as $qData) {
            $question = Question::create([
                'text' => $qData['text'],
                'category_id' => $categories[$qData['category']],
                'difficulty_id' => $difficulties[$qData['difficulty']],
                'approved' => true,
            ]);

            foreach ($qData['answers'] as $aData) {
                Answer::create([
                    'question_id' => $question->id,
                    'text' => $aData['text'],
                    'is_correct' => $aData['is_correct'],
                ]);
            }
        }
    }
}
