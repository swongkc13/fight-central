<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Inertia\Inertia;

class RankingController extends Controller
{
    public function index()
    {
        $rankings = Http::get('https://api.octagon-api.com/rankings')->json();

        foreach ($rankings as &$category) {
            $championId = $category['champion']['id'] ?? null;
            if ($championId) {
                $championData = Http::get("https://api.octagon-api.com/fighter/{$championId}")->json();
                $category['champion']['imgUrl'] = $championData['imgUrl'] ?? null;
            }
        }

        return Inertia::render('rankings/Index', [
            'rankings' => $rankings
        ]);
    }

    public function show($id)
    {
        $rankings = Http::get('https://api.octagon-api.com/rankings')->json();

        $category = collect($rankings)
            ->first(fn($r) => strtolower($r['id']) === strtolower($id));

        if (!$category) {
            abort(404, 'Ranking category not found');
        }

        // Fetch images for all fighters in this category
        foreach ($category['fighters'] as &$fighter) {
            $fighterData = Http::get("https://api.octagon-api.com/fighter/{$fighter['id']}")->json();
            $fighter['imgUrl'] = $fighterData['imgUrl'] ?? null;
        }

        // Also fetch champion image if missing
        if (!isset($category['champion']['imgUrl'])) {
            $championData = Http::get("https://api.octagon-api.com/fighter/{$category['champion']['id']}")->json();
            $category['champion']['imgUrl'] = $championData['imgUrl'] ?? null;
        }

        return Inertia::render('rankings/Show', [
            'category' => $category
        ]);
    }
}