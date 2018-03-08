<?php

namespace App;

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
        return $this->belongsToMany('App\Address', 'address_owner', 'owner_id', 'address_id');
    }

    /**
     * Get the dogs of the owner
     */
    public function dogs()
    {
        return $this->belongsToMany('App\Dog');
    }

    /**
     * Get the bookings for the owner
     */
    public function boardingBookings()
    {
        return $this->hasMany('App\BoardingBooking');
    }
}
