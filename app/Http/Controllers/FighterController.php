<?php

namespace App\Http\Controllers;

use App\Services\OctagonApi;
use Inertia\Inertia;

class FighterController extends Controller
{
    public function index(OctagonApi $octagonApi)
    {
        return Inertia::render('fighters/Index', [
            'fighters' => $octagonApi->fighters(),
        ]);
    }

    public function show(OctagonApi $octagonApi, string $id)
    {
        $fighter = $octagonApi->fighter($id);

        if (!$fighter) {
            abort(404);
        }

        return Inertia::render('fighters/Show', [
            'fighter' => $fighter,
        ]);
    }

    public function featured(OctagonApi $octagonApi)
    {
        $featured = array_slice($octagonApi->fighters(), 0, 10, true);

        return Inertia::render('Home', [
            'featuredFighters' => $featured,
        ]);
    }
}
