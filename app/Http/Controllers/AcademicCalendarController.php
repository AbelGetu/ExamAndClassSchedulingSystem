<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AcademicCalendar;

class AcademicCalendarController extends Controller
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
        $acadmeic_calendars = AcademicCalendar::orderBy('created_at', 'desc')->get();

        return view('academic_calendars.index')->with('academic_calendars', $acadmeic_calendars);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('academic_calendars.create');
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
            'name' => 'string|required',
            'start_date' => 'date|required',
            'end_date' => 'date|required'
        ]);

        $academic_calendar = new AcademicCalendar;
        $academic_calendar->name = $request->name;
        $academic_calendar->start_date = $request->start_date;
        $academic_calendar->end_date = $request->end_date;
        $academic_calendar->save();

        return redirect()->route('academic_calendars.index')->with('success', 'Academic Calendar created successfully');
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
        $academic_calendar = AcademicCalendar::find($id);

        return view('academic_calendars.edit')->with('academic_calendar', $academic_calendar);
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
            'name' => 'string|required',
            'start_date' => 'date|required',
            'end_date' => 'date|required'
        ]);

        $academic_calendar = AcademicCalendar::find($id);
        $academic_calendar->name = $request->name;
        $academic_calendar->save();

        return redirect()->route('academic_calendars.index')->with('success', 'Academic Calendar updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $academic_calendar = AcademicCalendar::find($id);
        $academic_calendar->delete();

        return redirect()->route('academic_calendars.index')->with('success', 'Academic Calendar deleted successfully');
    }
}
