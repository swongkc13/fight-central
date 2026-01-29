<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Inertia\Inertia;

class FighterController extends Controller
{
    public function index()
    {
        $response = Http::get('https://api.octagon-api.com/fighters')->json();

        return Inertia::render('fighters/Index', [
            'fighters' => $response
        ]);
    }

    public function show($id)
    {
        $fighter = Http::get("https://api.octagon-api.com/fighter/{$id}")->json();

        return Inertia::render('fighters/Show', [
            'fighter' => $fighter
        ]);
    }

    public function featured()
    {
        $fighters = Http::get('https://api.octagon-api.com/fighters')->json();

        // Keep keys intact, just take first 10
        $featured = array_slice($fighters, 0, 10, true);

        return Inertia::render('Home', [
            'featuredFighters' => $featured,
        ]);
    }
}
