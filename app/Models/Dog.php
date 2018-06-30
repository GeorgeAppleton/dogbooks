<?php

namespace App\Models;

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
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','size_id','breed'];

    /**
     * The possible relationships.
     *
     * @var array
     */
    protected $possibleRelations = ['size','boardingBookings'];

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
        return $this->belongsTo('App\Models\DogSize');
    }

    /**
     * Get the bookings for the dog.
     */
    public function boardingBookings()
    {
        return $this->hasMany('App\Models\BoardingBooking');
    }

    /**
     * Get the dogs of the owner (change to through boarding not direct relation)
     */
    // public function owners()
    // {
    //     return $this->belongsToMany('App\Models\Owner');
    // }

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
