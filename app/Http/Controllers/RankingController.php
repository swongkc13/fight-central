<?php

namespace App\Http\Controllers;

use App\Services\OctagonApi;
use Inertia\Inertia;

class RankingController extends Controller
{
    public function index(OctagonApi $octagonApi)
    {
        $rankings = $octagonApi->rankings();

        foreach ($rankings as &$category) {
            $championId = $category['champion']['id'] ?? null;

            if ($championId) {
                $championData = $octagonApi->fighter($championId);
                $category['champion']['imgUrl'] = $championData['imgUrl'] ?? null;
            }
        }

        return Inertia::render('rankings/Index', [
            'rankings' => $rankings,
        ]);
    }

    public function show(OctagonApi $octagonApi, string $id)
    {
        $rankings = $octagonApi->rankings();

        $category = collect($rankings)
            ->first(fn($r) => strtolower($r['id']) === strtolower($id));

        if (!$category) {
            abort(404, 'Ranking category not found');
        }

        foreach ($category['fighters'] as &$fighter) {
            $fighterData = $octagonApi->fighter($fighter['id']);
            $fighter['imgUrl'] = $fighterData['imgUrl'] ?? null;
        }

        if (!isset($category['champion']['imgUrl'])) {
            $championData = $octagonApi->fighter($category['champion']['id']);
            $category['champion']['imgUrl'] = $championData['imgUrl'] ?? null;
        }

        return Inertia::render('rankings/Show', [
            'category' => $category,
        ]);
    }
}