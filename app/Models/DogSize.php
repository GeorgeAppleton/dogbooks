<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DogSize extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'dog_sizes';

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
    protected $fillable = ['size','rate_night','rate_day'];

    /**
     * The possible relationships.
     *
     * @var array
     */
    protected $possibleRelations = ['dog'];

    /**
     * Create a new instance.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'size' => 'required|string',
            'rate_night' => 'required|numeric',
            'rate_day' => 'required|numeric'
        ]);

        $dogSizeObj = new DogSize;

        $dogSizeObj->size = $request->size;
        $dogSizeObj->rate_night = $request->rate_night;
        $dogSizeObj->rate_day = $request->rate_day;

        $dogSizeObj->save();
    }

    /**
     * Get the dogs of this size
     */
    public function dog()
    {
        return $this->hasMany('App\Models\Dog', 'size_id');
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
