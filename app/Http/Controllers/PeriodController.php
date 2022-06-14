<?php

namespace App\Http\Controllers;

use App\Models\Period;
use Illuminate\Http\Request;

class PeriodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $periods = Period::orderBy('name')->get();

        return view('periods.index')->with('periods', $periods);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('periods.create');
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
            'name' => 'required|unique:periods|max:255',
            'order' => 'required|integer|min:1|max:255',
        ]);

        $period = new Period;
        $period->name = $request->name;
        $period->order = $request->order;
        $period->save();

        return redirect()->route('periods.index')->with('success', 'Period created successfully.');
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
        $period = Period::find($id);

        return view('periods.edit')->with('period', $period);
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
            'name' => 'required|unique:periods|max:255',
            'order' => 'required|integer|min:1|max:255',
        ]);

        $period = Period::find($id);
        $period->name = $request->name;
        $period->order = $request->order;
        $period->save();

        return redirect()->route('periods.index')->with('success', 'Period updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $period = Period::find($id);
        $period->delete();

        return redirect()->route('periods.index')->with('success', 'Period deleted successfully.');
    }
}
