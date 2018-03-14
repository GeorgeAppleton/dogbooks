<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'dog_id' => 'required|integer',
            'arrival' => 'required|date|before:departure',
            'departure' => 'required|date',
            'train' => 'required|boolean'
        ]);

        $boardingObj = new BoardingBooking;

        $boardingObj->dog_id = $request->dog_id;
        $boardingObj->arrival = $request->arrival;
        $boardingObj->departure = $request->departure;
        $boardingObj->train = $request->train;

        $boardingObj->save();
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

}
