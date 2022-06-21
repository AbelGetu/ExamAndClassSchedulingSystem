<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Building;
use Illuminate\Http\Request;

class RoomController extends Controller
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
        $rooms = Room::orderBy('name')->with('building')->get();

        return view('rooms.index')->with('rooms', $rooms);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $buildings = Building::orderBy('name')->get();

        return view('rooms.create')->with('buildings', $buildings);
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
            'building' => 'integer|required'
        ]);

        $room = new Room;
        $room->name = $request->name;
        $room->building_id = $request->building;
        $room->save();

        return redirect()->route('rooms.index')->with('success', 'Room created successfully');
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
        $buildings = Building::orderBy('name')->get();
        $room = Room::find($id);

        return view('rooms.edit')->with(['room' => $room, 'buildings' => $buildings]);
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
            'building_id' => 'integer|required'
        ]);

        $room = Room::find($id);
        $room->name = $request->name;
        $room->building_id = $request->building_id;
        $room->save();

        return redirect()->route('rooms.index')->with('success', 'Room updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $room = Room::find($id);
        if($room->section_allocations->count() > 0) {
            return redirect()->route('rooms.index')->with('error', 'Room cannot be deleted because it is allocated to a section');
        }
        $room->delete();

        return redirect()->route('rooms.index')->with('success', 'Room deleted successfully');
    }
}
