<?php

namespace App\Http\Controllers;

use App\Models\People;
use App\Models\PeopleMarriage;
use App\Models\Relations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
     public function index(Request $request) {
        $userId = Auth::id();

        // Haal de zoekterm op uit de querystring
        $search = $request->input('search', '');

        // Query voor het ophalen van mensen die bij de ingelogde gebruiker horen
        $peopleQuery = People::leftJoin('relations as child_relation', 'child_relation.child_id', '=', 'people.id')
            ->where('people.beheerder_id', $userId)
            ->select('people.*');

        // Voeg de zoekfunctionaliteit toe op zowel 'name' als 'last_name'
        if (!empty($search)) {
            $peopleQuery->where(function($query) use ($search) {
                $query->where('people.name', 'like', '%' . $search . '%')
                      ->orWhere('people.last_name', 'like', '%' . $search . '%');
            });
        }

        // Voer de query uit om de resultaten op te halen
        $people = $peopleQuery->get();

        // Haal alle relaties en huwelijken op
        $relations = Relations::all();
        $spouses = PeopleMarriage::all();

        // Bereken de geslachtsverdeling
        $genderCount = $people->groupBy('gender')->map(function ($group) {
            return $group->count();
        });

        // Bereken het aantal mensen met kinderen
        $peopleWithChildren = $relations->pluck('parent_id')->unique()->count();

        // Bereken het aantal mensen zonder kinderen
        $peopleWithoutChildren = $people->count() - $peopleWithChildren;

        // Stuur de resultaten naar de view
        return view('dashboard', compact('people', 'relations', 'spouses', 'genderCount', 'peopleWithChildren', 'peopleWithoutChildren', 'search'));
    }/*
    {
        $userId = Auth::id();

        // Haal de zoekterm op uit de querystring
        $search = $request->input('search', '');

        // Query voor het ophalen van mensen die geen kindrelatie hebben en die bij de ingelogde gebruiker horen
        $peopleQuery = People::leftJoin('relations as child_relation', 'child_relation.child_id', '=', 'people.id')
            ->whereNull('child_relation.id')
            ->leftJoin('relations as parent_relation', 'parent_relation.parent_id', '=', 'people.id')
            ->where('people.beheerder_id', $userId)
            ->select('people.*');

        // Voeg de zoekfunctionaliteit toe op zowel 'name' als 'last_name'
        if (!empty($search)) {
            $peopleQuery->where(function($query) use ($search) {
                $query->where('people.name', 'like', '%' . $search . '%')
                      ->orWhere('people.last_name', 'like', '%' . $search . '%');
            });
        }

        // Voer de query uit om de resultaten op te halen
        $people = $peopleQuery->get();

        // Haal alle relaties en huwelijken op
        $relations = Relations::all();
        $spouses = PeopleMarriage::all();

        // Bereken de geslachtsverdeling
        $genderCount = $people->groupBy('gender')->map(function ($group) {
            return $group->count();
        });

        // Stuur de resultaten naar de view
        return view('dashboard', compact('people', 'relations', 'spouses', 'genderCount', 'search'));
        
    }    */ 
}

