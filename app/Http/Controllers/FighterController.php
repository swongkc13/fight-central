<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Inertia\Inertia;

class FighterController extends Controller
{
    public function index()
    {
        $response = Http::get('https://api.octagon-api.com/fighters')->json();

        return Inertia::render('fighters/index', [
            'fighters' => $response
        ]);
    }

    public function show($id)
    {
        $fighter = Http::get("https://api.octagon-api.com/fighter/{$id}")->json();

        return Inertia::render('fighters/show', [
            'fighter' => $fighter
        ]);
    }
}
