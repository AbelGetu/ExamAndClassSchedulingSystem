<?php

namespace App\Http\Controllers;

use App\Models\Institute;
use Illuminate\Http\Request;

class InstituteController extends Controller
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
        $institutes = Institute::orderBy('name')->get();

        return view('institutes.index')->with('institutes', $institutes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('institutes.create');
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
            'city' => 'nullable|max:255',
            'address' => 'nullable|max:255',
            'state' => 'nullable|max:255',
            'zip' => 'nullable|max:255'
        ]);

        $institute = new Institute;
        $institute->name = $request->name;
        $institute->phone = $request->phone;
        $institute->email = $request->email;
        $institute->website = $request->website;
        $institute->city = $request->city;
        $institute->address = $request->address;
        $institute->state = $request->state;
        $institute->zip = $request->zip;
        $institute->save();

        return redirect()->route('institutes.index')->with('success', 'Institute created successfully.');
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
        $institute = Institute::find($id);

        return view('institutes.edit')->with('institute', $institute);
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
            'city' => 'nullable|max:255',
            'address' => 'nullable|max:255',
            'state' => 'nullable|max:255',
            'zip' => 'nullable|max:255'
        ]);

        $institute = Institute::find($id);
        $institute->name = $request->name != null ? $request->name : $institute->name;
        $institute->phone = $request->phone != null ? $request->phone : $institute->phone;
        $institute->email = $request->email != null ? $request->email : $institute->email;
        $institute->website = $request->website != null ? $request->website : $institute->website;
        $institute->city = $request->city != null ? $request->city : $institute->city;
        $institute->address = $request->address != null ? $request->address : $institute->address;
        $institute->state = $request->state != null ? $request->state : $institute->state;
        $institute->zip = $request->zip != null ? $request->zip : $institute->zip;
        $institute->save();

        return redirect()->route('institutes.index')->with('success', 'Institute updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $institute = Institute::find($id);
        if($institute->colleges->count() > 0) {
            return redirect()->route('institutes.index')->with('error', 'Institute has colleges. Please delete colleges first.');
        }
        $institute->delete();

        return redirect()->route('institutes.index')->with('success', 'Institute deleted successfully.');
    }
}
