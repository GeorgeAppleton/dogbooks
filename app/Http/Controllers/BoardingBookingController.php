<?php

namespace App\Http\Controllers;

use App;
use App\Models\BoardingBooking;
use Illuminate\Http\Request;

class BoardingBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        foreach($request->input() as $name => $value) {
            \Session::flash($name,$value??'');//flash back submitted data so users dont lose entered info
        }

        $validator = $request->validate([
            'from' => 'date|before_or_equal:to',
            'to' => 'date',
        ]);

        $from; $to; $allTime = false;

        if (!isset($request->from) || !isset($request->to)) {
                $allTime = true; //no date range so we get most recent hundered results
        } else {
            $from = $request->from.' 00:00:00';//daterange passed to us so get all results between that
            $to = $request->to.' 23:59:59';
        }

        $bookings;
        if ($allTime) {
            $bookings = App\Models\BoardingBooking::orderBy('departure', 'desc')->limit(100);
        } else {
            $bookings = App\Models\BoardingBooking::whereBetween('arrival',[$from,$to])->orWhereBetween('departure', [$from, $to])->orderBy('departure', 'desc');
        }

        $bookings = $bookings->with([//fetch the data needed from related tables, eager load
            'dog' => function ($query) {
                $query->select('id', 'size_id', 'name', 'breed');
            },
            'dog.size' => function ($query) {
                $query->select('id', 'size','rate_night','rate_day');
            },
            'owner' => function ($query) {
                $query->select('id', 'first_name','last_name');
            }
        ])->get()->toArray();

        $dataArray = [
            'bookings' => $bookings
        ];

        return view('boarding.index',$dataArray);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BoardingBooking  $boardingBooking
     * @return \Illuminate\Http\Response
     */
    public function show(BoardingBooking $boardingBooking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BoardingBooking  $boardingBooking
     * @return \Illuminate\Http\Response
     */
    public function edit(BoardingBooking $boardingBooking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BoardingBooking  $boardingBooking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BoardingBooking $boardingBooking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BoardingBooking  $boardingBooking
     * @return \Illuminate\Http\Response
     */
    public function destroy(BoardingBooking $boardingBooking)
    {
        //
    }
}
