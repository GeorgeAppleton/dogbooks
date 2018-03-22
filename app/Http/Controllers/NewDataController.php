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
        $this->models = [
            'address' => new Address,
            'boardingbooking' => new BoardingBooking,
            'dog' => new Dog,
            'dogsize' => new DogSize,
            'owner' => new Owner
        ];
    }

    public function index(Request $request)
    {
        if (null!==$request->get('model')) {
            foreach($request->input() as $name => $value) {
                \Session::flash($name,$value??'');//flash back submitted data so users dont lose entered info
            }

            $model = $this->models[$request->get('model')];
            $result = $model->store($request);
            if ($result) {
                \Session::flash('success','Successfully Submitted');
            }
        }

        $arrayToFront = [
            'dog' => Dog::select('id','name')->get()->toArray(),
            'owner' => Owner::select('id','first_name','last_name')->get()->toArray(),
        ];
        return view('new-data.index',$arrayToFront);
    }
}
