<?php

namespace App\Http\Controllers;
use App\Services\OctagonApi;
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
    public function index(OctagonApi $octagonApi)
    {
        $divisions = [];

        foreach ($this->divisionIds as $id) {
            $division = $octagonApi->division($id);

            if ($division) {

                // Fetch image for first fighter to use as division image
                $firstFighterId = $division['fighters'][0]['id'] ?? null;
                $imgUrl = null;
                if ($firstFighterId) {
                    $fighterData = $octagonApi->fighter($firstFighterId);
                    $imgUrl = $fighterData['imgUrl'] ?? null;
                }

                // Fetch champion image if exists
                if (isset($division['champion']['id'])) {
                    $championData = $octagonApi->fighter($division['champion']['id']);
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
    public function show(OctagonApi $octagonApi, string $id)
    {
        $division = $octagonApi->division($id);

        if (!$division)
            abort(404);

        // Fetch champion image
        if (isset($division['champion']['id'])) {
            $championData = $octagonApi->fighter($division['champion']['id']);
            $division['champion']['imgUrl'] = $championData['imgUrl'] ?? null;
        }

        // Fetch images for all fighters
        foreach ($division['fighters'] as &$fighter) {
            $fighterData = $octagonApi->fighter($fighter['id']);
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