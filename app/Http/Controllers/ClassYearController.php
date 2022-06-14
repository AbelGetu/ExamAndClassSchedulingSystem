<?php

namespace App\Http\Controllers;

use App\Models\ClassYear;
use Illuminate\Http\Request;

class ClassYearController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $class_years = ClassYear::orderBy('name')->get();

        return view('class_years.index')->with('class_years', $class_years);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('class_years.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:class_years|max:255',
        ]);

        $class_year = new ClassYear;
        $class_year->name = $request->name;
        $class_year->save();

        return redirect()->route('class_years.index')->with('success', 'Class Year created successfully.');
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
        $class_year = ClassYear::findOrFail($id);

        return view('class_years.edit')->with('class_year', $class_year);
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
        $this->validate($request, [
            'name' => 'required|unique:class_years,name,'.$id.'|max:255',
        ]);

        $class_year = ClassYear::findOrFail($id);
        $class_year->name = $request->name;
        $class_year->save();

        return redirect()->route('class_years.index')->with('success', 'Class Year updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $class_year = ClassYear::findOrFail($id);
        $class_year->delete();
    }
}
