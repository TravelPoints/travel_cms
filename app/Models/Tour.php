<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'tour';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
//    public function tour_guides()
//    {
//        return $this->hasMany(Tour_guides::class, 'tour_id');
//    }

    public function language()
    {
        return $this->belongsTo(Language::class, 'id');
    }

    public function tour_guide_id()
    {
        return $this->belongsToMany(Tour_guides::class, 'tour_points',
             'tour_id', 'tour_guide_id');
    }

    public function country_id()
    {
        return $this->belongsToMany(Country::class, 'tour_country_city_lang',
             'country_id', 'tour_id');
    }

    public function city_id()
    {
        return $this->belongsToMany(City::class, 'tour_country_city_lang',
            'tour_id', 'city_id');
    }
    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
