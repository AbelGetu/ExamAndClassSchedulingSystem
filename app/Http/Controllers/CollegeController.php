<?php

namespace App\Http\Controllers;

use App\Models\College;
use App\Models\Institute;
use Illuminate\Http\Request;

class CollegeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $colleges = College::orderBy('name')->with('institute')->get();

        return view('colleges.index')->with('colleges', $colleges);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $institutes = Institute::orderBy('name')->get();
        return view('colleges.create')->with('institutes', $institutes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'phone' => 'nullable|max:255',
            'email' => 'nullable|email|max:255',
            'website' => 'nullable|url|max:255',
           
            'institute' => 'required|exists:institutes,id'
        ]);

        $college = new College;
        $college->name = $request->name;
        $college->phone = $request->phone;
        $college->email = $request->email;
        $college->website = $request->website;
        $college->institute_id = $request->institute;
        $college->save();

        return redirect('/colleges')->with('success', 'College created successfully');
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
        $college = College::find($id);
        $institutes = Institute::orderBy('name')->get();

        return view('colleges.edit')->with('college', $college)->with('institutes', $institutes);
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
        $request->validate([
            'name' => 'required|max:255',
            'phone' => 'nullable|max:255',
            'email' => 'nullable|email|max:255',
            'website' => 'nullable|url|max:255',
           
            'institute' => 'required|exists:institutes,id'
        ]);

        $college = College::find($id);
        $college->name = $request->name;
        $college->phone = $request->phone;
        $college->email = $request->email;
        $college->website = $request->website;
        $college->institute_id = $request->institute;
        $college->save();

        return redirect('/colleges')->with('success', 'College updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $college = College::find($id);
        $college->delete();

        return redirect('/colleges')->with('success', 'College deleted successfully');
    }
}
