<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Inertia\Inertia;

class DivisionController extends Controller
{
    // List of known divisions
    private $divisionIds = [
        'flyweight',
        'bantamweight',
        'featherweight',
        'lightweight',
        'welterweight',
        'middleweight',
        'light-heavyweight',
        'heavyweight'
    ];

    // Show all divisions (Index)
    public function index()
    {
        $divisions = [];

        foreach ($this->divisionIds as $id) {
            $response = Http::get("https://api.octagon-api.com/division/{$id}");
            if ($response->successful()) {
                $division = $response->json();

                // Fetch image for first fighter to use as division image
                $firstFighterId = $division['fighters'][0]['id'] ?? null;
                $imgUrl = null;
                if ($firstFighterId) {
                    $fighterData = Http::get("https://api.octagon-api.com/fighter/{$firstFighterId}")->json();
                    $imgUrl = $fighterData['imgUrl'] ?? null;
                }

                // Fetch champion image if exists
                if (isset($division['champion']['id'])) {
                    $championData = Http::get("https://api.octagon-api.com/fighter/{$division['champion']['id']}")->json();
                    $division['champion']['imgUrl'] = $championData['imgUrl'] ?? null;
                }

                // Map data to match Vue props
                $divisions[] = [
                    'id' => $division['id'],
                    'name' => $division['categoryName'],
                    'fighters' => $division['fighters'],
                    'champion' => $division['champion'] ?? null,
                    'imgUrl' => $imgUrl,
                ];
            }
        }

        return Inertia::render('division/Index', [
            'divisions' => $divisions
        ]);
    }

    // Show a single division
    public function show($id)
    {
        $response = Http::get("https://api.octagon-api.com/division/{$id}");
        $division = $response->successful() ? $response->json() : null;

        if (!$division)
            abort(404);

        // Fetch champion image
        if (isset($division['champion']['id'])) {
            $championData = Http::get("https://api.octagon-api.com/fighter/{$division['champion']['id']}")->json();
            $division['champion']['imgUrl'] = $championData['imgUrl'] ?? null;
        }

        // Fetch images for all fighters
        foreach ($division['fighters'] as &$fighter) {
            $fighterData = Http::get("https://api.octagon-api.com/fighter/{$fighter['id']}")->json();
            $fighter['imgUrl'] = $fighterData['imgUrl'] ?? null;
        }

        return Inertia::render('division/Show', [
            'division' => [
                'id' => $division['id'],
                'name' => $division['categoryName'],
                'fighters' => $division['fighters'],
                'champion' => $division['champion'] ?? null,
            ]
        ]);
    }
}