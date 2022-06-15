<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\StudentClass;
use Illuminate\Http\Request;
use App\Models\ClassAllocation;

class ClassAllocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $class_allocations = ClassAllocation::orderBy('created_at', 'desc')->with([
           'student_class.academic_calendar', 'student_class.semester', 'student_class.class_year', 'room'
        ]);

        return view('class_allocations.index')->with('class_allocations', $class_allocations);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $student_classes = StudentClass::orderBy('created_at')->with([
        'class_year', 'semester', 'academic_calendar', 'department'
       ])->get();
        $rooms = Room::orderBy('created_at')->with('building')->get();

        return view('class_allocations.create')->with([
            'student_classes' => $student_classes,
            'rooms' => $rooms
        ]);
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
            'student_class' => 'required',
            'room' => 'required'
        ]);

        $class_allocation = new ClassAllocation;
        $class_allocation->student_class_id = $request->student_class;
        $class_allocation->room_id = $request->room;
        $class_allocation->save();

        return redirect()->route('class_allocations.index')->with('success', 'Class allocation created successfully');
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $class_allocation = ClassAllocation::findOrFail($id);
        $class_allocation->delete();

        return redirect()->route('class_allocations.index')->with('success', 'Class allocation deleted successfully');
    }
}
