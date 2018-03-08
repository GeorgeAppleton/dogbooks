<?php

namespace App;

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
        return $this->hasMany('App\Dog');
    }
}
