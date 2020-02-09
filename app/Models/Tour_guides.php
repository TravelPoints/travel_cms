<?php

namespace App\Models;

use App\Models\Language;
use App\Models\Tour;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Tour_guides extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'tour_guides';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
//     protected $fillable = ['title'];
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
    public function tour()
    {
        return $this->belongsTo(Tour::class, 'tour_id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'id');
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

    public function lang_id()
    {
        return $this->belongsToMany(Language::class, 'tour_guides_langs',
            'tour_guide_id', 'lang_id');
    }

    public function tour_guide_id()
    {
        return $this->belongsToMany(Tour_guides::class, 'tour_points',
            'tour_id', 'tour_guide_id');
    }
}
