<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Dog;
use App\Models\Owner;

class BoardingBooking extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'boarding_bookings';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['dog_id','owner_id','arrival','departure','train'];

    /**
     * The possible relationships.
     *
     * @var array
     */
    protected $possibleRelations = ['owner','dog'];

    /**
     * Create a new instance.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store($request)
    {
        $request->arrival = $request->arrival.' '.$request->arrivalTime;
        $request->departure = $request->departure.' '.$request->departureTime;

        $validatedData = $request->validate([
            'dog_id' => 'required|integer|min:1',
            'owner_id' => 'required|integer|min:1',
            'arrival' => 'required|date|before_or_equal:departure',
            'departure' => 'required|date',
            'train' => 'integer|min:0|max:1'
        ]);

        //set arrival departure datetimes here

        $dateRangeTester = new BoardingBooking;

        if ($dateRangeTester->where('dog_id',$request->dog_id)->where('departure','>=',$request->arrival)->where('arrival','<=',$request->departure)->count()>0) {//dates intersect for same dog
            \Session::flash('customError','These dates intersect with a booking for the same dog');
            return false;
        }
        // dd('wot');
        $boardingObj = new BoardingBooking;

        $boardingObj->dog_id = $request->dog_id;
        $dogObj = new Dog;
        $dogObj = $dogObj->where('id',$request->dog_id);
        $boardingObj->owner_id = $request->owner_id;
        $ownerObj = new Owner;
        $ownerObj = $ownerObj->where('id',$request->owner_id);

        if ($dogObj->count()!==1||$ownerObj->count()!==1) {//make sure the dog and owner were found
            \Session::flash('customError','Dog or Owner not found');
            return false;
        } else {
            $dogObj = $dogObj->first();//set up triangular relation, opposite side between dogs and owners
            $dogObj->owners()->sync($request->owner_id,false);//hard set those as only id's with duplicates removed
        }

        $boardingObj->arrival = $request->arrival;
        $boardingObj->departure = $request->departure;
        $boardingObj->train = $request->train?1:0;

        $boardingObj->save();

        return true;
    }



    /**
     * Get the owner of the booking
     */
    public function owner()
    {
        return $this->belongsTo('App\Models\Owner');
    }
    /**
     * Get the dog of the booking
     */
    public function dog()
    {
        return $this->belongsTo('App\Models\Dog');
    }

    /**
     * Get protected value fillable
     */
    public function getFillable()
    {
        return $this->fillable;
    }

    /**
     * Get protected value $possibleRelations
     */
    public function getPossibleRelations()
    {
        return $this->possibleRelations;
    }

    /**
     * Get protected value $fields
     */
    public function getFields()
    {
        $dogObj = new Dog;
        $dogObj = $dogObj->select('id','name')->get()->toArray();
        $dogObj = array_map(function($row){
            return [
                'value' => $row['id'],
                'text' => $row['name']
            ];
        }, $dogObj);


        $ownerObj = new Owner;
        $ownerObj = $ownerObj->select('id','first_name','last_name')->get()->toArray();
        $ownerObj = array_map(function($row) {
            return [
                'value' => $row['id'],
                'text' => $row['first_name'].' '.$row['last_name']
            ];
        }, $ownerObj);

        return [
            [
                'type' => 'dropdown-single',
                'label' => 'Dog',
                'name' => 'dog_id',
                'options' => $dogObj,
            ],
            [
                'type' => 'dropdown-single',
                'label' => 'Owner',
                'name' => 'owner_id',
                'options' => $ownerObj,
            ],
            [
                'type' => 'datetime',
                'label' => 'Arrival',
                'name' => 'arrivalDate'
            ],
            [
                'type' => 'datetime',
                'label' => 'Departure',
                'name' => 'departureDate'
            ],
            [
                'type' => 'checkbox',
                'label' => 'Training?',
                'name' => 'train'
            ],
        ];
    }

}
