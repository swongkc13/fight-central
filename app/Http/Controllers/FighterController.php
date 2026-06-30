<?php

namespace App\Http\Controllers;

use App\Models\Fighter;
use App\Services\OctagonApi;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FighterController extends Controller
{

    public function index(Request $request)
    {
        $fighters = Fighter::query()
            ->when($request->filled('search'), function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->string('search') . '%');
            })
            ->when($request->filled('division'), function ($query) use ($request) {
                $query->where('category', $request->string('division'));
            })
            ->when($request->filled('status'), function ($query) use ($request) {
                $query->where('status', $request->string('status'));
            })
            ->orderByDesc('wins')
            ->orderBy('name')
            ->get()
            ->mapWithKeys(fn(Fighter $fighter) => [
                $fighter->external_id => [
                    'id' => $fighter->external_id,
                    'name' => $fighter->name,
                    'category' => $fighter->category,
                    'wins' => $fighter->wins,
                    'losses' => $fighter->losses,
                    'draws' => $fighter->draws,
                    'status' => $fighter->status,
                    'imgUrl' => $fighter->img_url,
                ],
            ]);

        return Inertia::render('fighters/Index', [
            'fighters' => $fighters,
            'filters' => $request->only(['search', 'division', 'status']),
            'divisions' => Fighter::query()
                ->whereNotNull('category')
                ->distinct()
                ->orderBy('category')
                ->pluck('category'),
            'statuses' => Fighter::query()
                ->whereNotNull('status')
                ->distinct()
                ->orderBy('status')
                ->pluck('status'),
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
