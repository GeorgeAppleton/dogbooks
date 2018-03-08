<?php

namespace App;

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
         return $this->belongsToMany('App\Owner', 'address_owner', 'address_id', 'owner_id');
     }
}
