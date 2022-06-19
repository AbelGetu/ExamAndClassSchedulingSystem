<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use App\Models\SectionAllocation;
use App\Models\ClassSectionAllocation;

class SectionAllocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $section_allocations = SectionAllocation::orderBy('created_at', 'desc')->with([
            'class_section_allocation.section', 'class_section_allocation.student_class', 'room'
        ])->get();

        return view('section_allocations.index')->with('section_allocations', $section_allocations);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rooms = Room::orderBy('name')->with('building')->get();
        $class_section_allocations = ClassSectionAllocation::orderBy('created_at', 'desc')->with([
            'section', 'student_class'
        ])->get();

        return view('section_allocations.create')->with([
            'rooms' => $rooms,
            'class_section_allocations' => $class_section_allocations
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
            'class_section_allocation' => 'required',
            'room' => 'required'
        ]);

        // Check if room is free
        $is_room_free = SectionAllocation::where('room_id', $request->room)->count();

        if ($is_room_free > 0) {
            return redirect()->back()->with('error', 'Room is not free');
        }

        $section_allocation = new SectionAllocation;
        $section_allocation->class_section_allocation_id = $request->class_section_allocation;
        $section_allocation->room_id = $request->room;
        $section_allocation->save();

        return redirect()->route('section_allocations.index')->with('success', 'Section Allocation created successfully');
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
        $rooms = Room::orderBy('name')->with('building')->get();

        return view('section_allocations.edit')->with([
            'rooms' => $rooms
        ]);
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
            'room' => 'required'
        ]);
        
        $section_allocation = SectionAllocation::find($id);
        if($request->room === $section_allocation->room_id) {
            return redirect()->back()->with('error', 'Room is not changed');
        } else {
            // Check if room is free
            $is_room_free = SectionAllocation::where('room_id', $request->room)->count();

            if ($is_room_free > 0) {
                return redirect()->back()->with('error', 'Room is not free');
            }

            $section_allocation->room_id = $request->room;
            $section_allocation->save();

            return redirect()->route('section_allocations.index')->with('success', 'Section Allocation updated successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $section_allocation = SectionAllocation::find($id);
        $section_allocation->delete();

        return redirect()->route('section_allocations.index')->with('success', 'Section Allocation deleted successfully');
    }
}
