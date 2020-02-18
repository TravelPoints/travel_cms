<?php

namespace App\Models;

use App\Models\Language;
use App\Models\Tour;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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
//    public function tour()
//    {
//        return $this->belongsTo(Tour::class, 'tour_id');
//    }

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

    public function getLangs()
    {
        $data = DB::table('tour_guides_langs')->select(['lang'])
            ->leftJoin('language', 'tour_guides_langs.lang_id', '=','language.id')
            ->where('tour_guides_langs.tour_guide_id', '=', $this->id)->get();

        $langs = '';
        foreach ($data->toArray() as $val) {
            $langs .= $val->lang . ' ';
        }

        return $langs;
    }
}
