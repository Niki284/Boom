<?php

namespace App\Http\Controllers;

use App\Models\PeopleHistory;
use Illuminate\Http\Request;

class PeopleHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('people_history.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($people_id)
    {
        //
        return view('people_history.create', ['people_id' => $people_id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $peopleHistory = new PeopleHistory();
        $peopleHistory->people_id = $request->input('people_id');
        $peopleHistory->school = $request->input('school');
        $peopleHistory->university = $request->input('university');
        $peopleHistory->work = $request->input('work');
        $peopleHistory->married = $request->input('married');
        $peopleHistory->divorce = $request->input('divorce');

        $peopleHistory->save();

        return redirect()->route('people.show', $request->input('people_id'))->with('success', 'History is toegevoegd');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        return view('people_history.edit', ['peopleHistory' => PeopleHistory::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $peopleHistory = PeopleHistory::find($id);
        $peopleHistory->school = $request->input('school');
        $peopleHistory->university = $request->input('university');
        $peopleHistory->work = $request->input('work');
        $peopleHistory->married = $request->input('married');
        $peopleHistory->divorce = $request->input('divorce');

        $peopleHistory->save();

        return redirect()->route('people.show', $peopleHistory->people_id)->with('success', 'History is aangepast');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        PeopleHistory::find($id)->delete();

        return redirect()->back()->with('success', 'History is verwijderd');
    }
}
