<?php

namespace App\Http\Controllers;

use App\Models\People;
use App\Models\PeopleMarriage;
use App\Models\Relations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PeopleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        /*
        $userId = Auth::id();

        // Haal de zoekterm op uit de querystring
        $search = $request->input('search', '');

           $userId = Auth::id();
        // Haal de zoekterm op uit de querystring
        $search = $request->input('search', '');
    
        // Query voor het ophalen van mensen die geen kindrelatie hebben en die bij de ingelogde gebruiker horen
        $peopleQuery = People::leftJoin('relations as child_relation', 'child_relation.child_id', '=', 'people.id')
            ->whereNull('child_relation.id')
            //->leftJoin('relations as parent_relation', 'parent_relation.parent_id', '=', 'people.id')
            ->where('people.beheerder_id', $userId)
            ->select('people.*');
        
        // Voeg de zoekfunctionaliteit toe op zowel 'name' als 'last_name'
        
       
       if (!empty($search)) {
            $peopleQuery->leftJoin('people as child', 'child_relation.child_id', '=', 'child.id')
                ->where(function($query) use ($search) {
                    $query->where('people.name', 'like', '%' . $search . '%')
                          ->orWhere('people.last_name', 'like', '%' . $search . '%')
                          ->orWhere('child.name', 'like', '%' . $search . '%')
                          ->orWhere('child.last_name', 'like', '%' . $search . '%');
                });
        }
        // Voer de query uit om de resultaten op te halen
        $people = $peopleQuery->get();
    
        // Haal alle relaties en huwelijken op
        $relations = Relations::all();
        $spouses = PeopleMarriage::all();
        
         // Bereken het aantal mensen met kinderen
         $peopleWithChildren = $relations->pluck('parent_id')->unique()->count();

         // Bereken het aantal mensen zonder kinderen
         $peopleWithoutChildren = $people->count() - $peopleWithChildren;
        // Stuur de resultaten naar de view
        return view('people.index', compact('people', 'relations', 'spouses' , 'peopleWithChildren', 'peopleWithoutChildren'));
         */

        $userId = Auth::id();
        $people = People::leftJoin('relations as child_relation', 'child_relation.child_id', '=', 'people.id')
            ->whereNull('child_relation.id')

            //->leftJoin('relations as parent_relation', 'parent_relation.parent_id', '=', 'people.id')
            // ->rightJoin('people as spouse', function ($join) {
            //     $join->on('spouse.id', '=', 'people.id')
            //         ->orOn('spouse.id', '=', 'parent_relation.child_id');
            // })
            //->leftJoin('people as parent', 'parent.id', '=', 'parent_relation.child_id')
            ->where('people.beheerder_id', $userId)
            ->select('people.*')
            ->get();

        $relations = Relations::all();

        $spouses = PeopleMarriage::all();

        return view('people.index', compact('people', 'relations', 'spouses'));
    }
    /*
    public function search(Request $request)
    {
        $lastName = $request->input('last_name');
        $people = People::where('last_name', 'like', '%' . $lastName . '%')->get();

        // Обработка и отображение результатов поиска аналогично index методу
    }*/
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, People $people)
    {
        //
        $people->beheerder = Auth::id();

        return view('people.create', ['parent_id' => $request->get('parent_id')]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request, $id = null)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'birth_date' => 'nullable|date',
            'birth_place' => 'nullable|string|max:255',
            'death_date' => 'nullable|date',
            'death_place' => 'nullable|string|max:255',
            'gender' => 'required|string|max:255',
            'city' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'parent_id' => 'nullable|exists:people,id',
            'beheerder_id' => 'nullable|exists:users,id',
        ]);


        $people = People::create($request->all());
        if ($request->hasFile('img')) {
            $imagePath = $request->file('img')->store('images/simpel', 'public');
            $people->img = Storage::url($imagePath);
            $people->save();
        }
        $parent_id = $request->parent_id;
        // $people->beheerder = Auth::id();
        $people->beheerder_id = Auth::id();
        if ($parent_id !== null) {
            $relation = new Relations();
            $relation->parent_id = $parent_id;
            $relation->child_id = $people->id;
            $relation->save();
        }


        return redirect()->route('people.index');
    }

    public function createRelation($id)
    {
        $people = People::findOrFail($id);
        $users = People::where('id', '!=', $id)->get();

        return view('people.create', compact('people', 'users'));
    }

    public function storeRelation(Request $request, $id)
    {
        $request->validate([
            'parent_id' => 'required|exists:users,id',
        ]);

        $relation = new Relations();
        $relation->parent_id = $request->parent_id;
        $relation->child_id = $id;
        $relation->save();

        return redirect()->route('people.show', $id)->with('success', 'Relation added successfully.');
    }
    public function createMarriage($id)
    {
        $people = People::findOrFail($id);
        $users = People::where('id', '!=', $id)->get();


        return view('people.create_marriage', compact('people', 'users'));
    }

    public function storeMarriage(Request $request, $id)
    {
        $request->validate([
            'spouse_name' => 'required|string|max:255',
            'spouse_last_name' => 'required|string|max:255',
            'spouse_gender' => 'required|in:M,F',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);


        $spouse = People::create([
            'name' => $request->spouse_name,
            'last_name' => $request->spouse_last_name,
            'gender' => $request->spouse_gender,
            'img' => 'images/simpel/default.png',

            'beheerder_id' => Auth::id(),
        ]);

        if ($request->hasFile('img')) {
            $imagePath = $request->file('img')->store('images/simpel', 'public');
            $spouse->img = Storage::url($imagePath);
            $spouse->save();
        }
        PeopleMarriage::create([
            'person_id' => $id,
            'spouse_id' => $spouse->id,
        ]);

        return redirect()->route('people.index', $id)->with('success', 'Marriage created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\People  $people
     * @return \Illuminate\Http\Response
     */
    public function show(People $people)
    {
        $people = People::find($people->id);
        //$people = People::with(['parents', 'children'])->findOrFail($id);

        return view('people.show', compact('people'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\People  $people
     * @return \Illuminate\Http\Response
     */
    public function edit(People $people)
    {
        //
        $people = People::find($people->id);
        return view('people.edit', compact('people'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\People  $people
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, People $people)
    {
        //
        $people = People::find($people->id);
        $people->update($request->all());

        if ($request->hasFile('img')) {
            $imagePath = $request->file('img')->store('images/simpel', 'public');
            $people->img = Storage::url($imagePath);
            $people->save();
        }
        return redirect()->route('people.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\People  $people
     * @return \Illuminate\Http\Response
     */
    public function destroy(People $people)
    {
        //
        $people = People::find($people->id);
        $people->delete();

        return redirect()->route('people.index');
    }
}
