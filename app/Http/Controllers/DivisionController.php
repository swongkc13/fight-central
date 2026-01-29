<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Inertia\Inertia;

class DivisionController extends Controller
{
    public function index()
    {
        // Fetch all divisions
        $divisions = Http::get('https://api.octagon-api.com/divisions')->json();

        return Inertia::render('division/Index', [
            'divisions' => $divisions
        ]);
    }

    public function show($id)
    {
        // Fetch a single division with fighters
        $division = Http::get("https://api.octagon-api.com/division/{$id}")->json();

        return Inertia::render('division/Show', [
            'division' => $division
        ]);
    }
}