<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'owners';

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
    protected $fillable = ['first_name','last_name','home_number','mobile_number','email'];

    /**
     * The possible relationships.
     *
     * @var array
     */
    protected $possibleRelations = ['address','boardingBookings'];

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required_unless:last_name|string',
            'last_name' => 'required_unless:first_name|string',
            'home_number' => 'regex:/\+?[0-9]+/',
            'mobile_number' => 'regex:/\+?[0-9]+/',
            'email' => 'email_address',
            'address_id' => 'required|integer',
        ]);

        $dogSizeObj = new DogSize;

        $dogSizeObj->dog_id = $request->dog_id;
        $dogSizeObj->size = $request->size;
        $dogSizeObj->rate_night = $request->rate_night;
        $dogSizeObj->rate_day = $request->rate_day;

        $dogSizeObj->save();
    }

    /**
     * Get the addresses of the owner
     */
    public function address()
    {
        return $this->belongsToMany('App\Models\Address', 'address_owner', 'owner_id', 'address_id');
    }

    /**
     * Get the dogs of the owner (change to through boarding not direct relation)
     */
    // public function dogs()
    // {
    //     return $this->belongsToMany('App\Models\Dog');
    // }

    /**
     * Get the bookings for the owner
     */
    public function boardingBookings()
    {
        return $this->hasMany('App\Models\BoardingBooking');
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
