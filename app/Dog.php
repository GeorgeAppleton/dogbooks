<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dog extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'dogs';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * Create a new instance.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'size_id' => 'required|integer',
            'breed' => 'string'
        ]);

        $dogObj = new Dog;

        $dogObj->name = $request->name;
        $dogObj->size_id = $request->size_id;
        $dogObj->breed = $request->breed ?? '';

        $dogObj->save();
    }

    /**
     * Get the size of the dog
     */
    public function size()
    {
        return $this->belongsTo('App\DogSize');
    }

    /**
     * Get the bookings for the dog.
     */
    public function boardingBookings()
    {
        return $this->hasMany('App\BoardingBooking');
    }

    /**
     * Get the dogs of the owner
     */
    public function owners()
    {
        return $this->belongsToMany('App\Owner');
    }
}
