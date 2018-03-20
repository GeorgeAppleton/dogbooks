<?php

namespace App\Http\Controllers;

use App;
use App\Models\Address;
use App\Models\BoardingBooking;
use App\Models\Dog;
use App\Models\DogSize;
use App\Models\Owner;
use Illuminate\Http\Request;

class NewDataController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
        $arrayToFront = [
            'dog' => Dog::select('id','name')->get()->toArray(),
            'owner' => Owner::select('id','first_name','last_name')->get()->toArray(),
        ];
        return view('new-data.index',$arrayToFront);
    }
}
