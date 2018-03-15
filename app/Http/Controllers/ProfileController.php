<?php

namespace App\Http\Controllers;

use App;
use App\Models\Address;
use App\Models\BoardingBooking;
use App\Models\Dog;
use App\Models\DogSize;
use App\Models\Owner;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    protected $models = [];

    public function __construct()
    {
        $this->models = [
            'address' => new Address,
            'boardingbooking' => new BoardingBooking,
            'dog' => new Dog,
            'dogsize' => new DogSize,
            'owner' => new Owner
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($modelName,$id)
    {
        $model = $this->models[$modelName]; //grabs the model class from the constructed values $models
        $item = $model->where('id',$id);

        function deepProcess($item,$depth,$currentRel,$currentRelClasses) {
            foreach ($depth->first()->getPossibleRelations() as $rel) {//eager load any possible relations
                $newRel = $rel;
                if ($currentRel !== '') {
                    $newRel = $currentRel.'.'.$rel;// $newRel example, dog.owner.addresses
                }

                $futureItemCollection = $depth->first()->$rel->first();
                if (!$futureItemCollection) {
                    continue; // no relationship found from $depth through $rel
                }
                array_push($currentRelClasses, get_class($futureItemCollection));//we need to check for the future relationship before the recursive call
                if (max(array_count_values($currentRelClasses)) > 1) {//if we've hit the same relation more than once then skip current iteration
                    array_pop($currentRelClasses); //remove one from the stack
                    continue;
                }

                // $fillable = $futureItemCollection->getFillable();
                // $item = $item->with([$newRel => function($query) use($fillable) {
                //     call_user_func_array([$query, 'select'], $fillable);//select only fillable fields
                // }]);
                $item = $item->with($newRel);//selecting only fillable fields wasn't working, likely due to unexpected fields being required
                $item = deepProcess($item, $depth->first()->$rel,$newRel,$currentRelClasses);
                array_pop($currentRelClasses); //remove one from the stack
            }
            return $item;
        }
        $item = deepProcess($item,$item,'',[get_class($item->first())])->get()->toArray();
        dd($item);

        return view('profile.index',$item);
    }
}
