<?php

namespace App\Http\Controllers;

use App\Models\Personnel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PersonnelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $personnel = Personnel::all();

        return view('personnel', compact('personnel'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $personnel = new Personnel;

        $personnel->reference = $request->reference;
        $personnel->forename = $request->forename;
        $personnel->surname = $request->surname;
        $personnel->email = $request->email;
        $personnel->phone = $request->phone;

        $success = $personnel->save();

        if ($success){
            $newPersonnel = $personnel;
        }

        return response()->json(['success'=>'Personnel record has been added successfully!', 'newPersonnel' => $personnel]);
    }

    /**
     * Store a newly created resource in storage via CSV upload.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_bulk(Request $request)
    {
        $file = fopen($request->file->path(), 'r');


        $arrPersonnel = [];

        $header = fgetcsv($file);
        while ($row = fgetcsv($file)){
            $arrPersonnel[] = array_combine($header, $row);
        }

        foreach($arrPersonnel as $person){
            $personnel = new Personnel;
            $personnel->reference = $person['reference'];
            $personnel->forename = $person['forename'];
            $personnel->surname = $person['surname'];
            $personnel->email = $person['email'];
            $personnel->phone = $person['phone'];
            $personnel->save();
        }

        return redirect('/');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\personnel  $personnel
     * @return \Illuminate\Http\Response
     */
    public function show(personnel $personnel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\personnel  $personnel
     * @return \Illuminate\Http\Response
     */
    public function edit(personnel $personnel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\personnel  $personnel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, personnel $personnel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\personnel  $personnel
     * @return \Illuminate\Http\Response
     */
    public function destroy(personnel $personnel)
    {
        //
    }
}
