<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Holidays;
use Illuminate\Http\Request;

class HolidayController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'holiday' => 'required|string',
            'day' => 'required|string',
        ]);

        Holidays::create($request->all());

        return redirect()->route('admin.holidays')->with('success', 'Holiday Added successlly.');;
    }


    public function holidays()
    {
        //Fetch  all Holidays from the database
        $tableData = Holidays::orderBy('created_at', 'asc')->paginate(10);
        $holidays = Holidays::orderBy('created_at', 'asc')->paginate(10);
        return view('admin.holidays', compact('holidays','tableData'));

    }

    public function fetchHolidays()
    {
        $holidays = Holidays::pluck('date')->toArray();
        return response()->json($holidays);
    }

    public function updateHoliday(Request $request, Holidays $holidays)

    {

        
        // dd($request->all());

        $request->validate([
            'date',
            'holiday',
            'day',

        ]);
        //$holiday = Holidays::findOrFail($id);
       // $holidays->delete();
        $holidays->date = $request->input('date');
        $holidays->holiday = $request->input('holiday');
        $holidays->day = $request->input('day');
        $holidays->save();

        return redirect()->route('admin.holidays')->with('success', 'Holiday updated successfully');
    }


    public function show($id)
    {
        $holiday = Holidays::findOrFail($id);
        return response()->json($holiday);
    }

    public function edit($id)
    {
        $holiday = Holidays::findOrFail($id);
        return view('admin.holidays', compact('holiday'));
    }

    //////////////////////////////////////////////////////////////////////

    public function editJson($id)
    {
        $holiday = Holidays::findOrFail($id);
        return response()->json($holiday);
    }


}
