<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'addresses';

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
    protected $fillable = ['address'];

    /**
     * The possible relationships.
     *
     * @var array
     */
    protected $possibleRelations = ['owners'];

    /**
     * Create a new instance.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {

        $addressObj = new Address;

        $addressObj->address = $request->address;

        $addressObj->save();
    }

    /**
     * Get the owners of the address
     */
     public function owners()
     {
         return $this->belongsToMany('App\Models\Owner', 'address_owner', 'address_id', 'owner_id');
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
