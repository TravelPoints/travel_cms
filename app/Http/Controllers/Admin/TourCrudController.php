<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\TourRequest;
use App\Models\City;
use App\Models\Country;
use App\Models\Tour_guides;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use App\Models\Tour;

/**
 * Class TourCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class TourCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CloneOperation;

    public function setup()
    {
        $this->crud->setModel(Tour::class);
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/tour');
        $this->crud->setEntityNameStrings('tour', 'tours');

        $this->crud->operation(['list', 'show'], function () {
            $this->crud->addColumn(['name' => 'tag', 'type' => 'text', 'label' => 'Tag']);
//            $this->crud->addColumn(['name' => 'lang_id', 'type' => 'text', 'label' => 'Language']);
            $this->crud->addColumn([
                'label' => 'Language',
                'type' => 'select',
                'name' => 'lang_id', // foreign key
                'entity' => 'language', // the method that defines the relationship in your Model
                'attribute' => 'lang', // foreign key attribute that is shown to user
                'pivot' => false, // on create&update, do you need to add/delete pivot table entries?]);
            ]);
            $this->crud->addColumn([
                'label' => 'Country',
                'type' => 'model_function',
                'function_name' => 'getCountries',
            ]);
            $this->crud->addColumn([
                'label' => 'City',
                'type' => 'model_function',
                'function_name' => 'getCities',
            ]);
            $this->crud->addColumn(['name' => 'title', 'type' => 'text', 'label' => 'Title']);
            $this->crud->addColumn(['name' => 'description', 'type' => 'text', 'label' => 'Description']);
            $this->crud->addColumn(['name' => 'duration', 'type' => 'text', 'label' => 'Duration']);
        });

        $this->crud->operation(['create', 'update'], function () {
            $this->crud->setValidation(TourRequest::class);
            $this->crud->addField(['name' => 'duration', 'type' => 'text', 'label' => 'Duration']);
        });
    }

    protected function setupListOperation()
    {
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(TourRequest::class);
        $this->crud->addField(['name' => 'title', 'type' => 'text', 'label' => 'Title']);
        $this->crud->addField(['name' => 'description', 'type' => 'ckeditor', 'label' => 'Description']);
        $this->crud->addField(['name' => 'tag', 'type' => 'text', 'label' => 'Tag']);
        $this->crud->addField([
            'label' => 'Language',
            'type' => 'select',
            'name' => 'lang_id', // foreign key
            'entity' => 'language', // the method that defines the relationship in your Model
            'attribute' => 'lang', // foreign key attribute that is shown to user
            'pivot' => false, // on create&update, do you need to add/delete pivot table entries?]);
            'options' => (function ($query) {
                return $query->orderBy('lang', 'ASC')->get();
            }),
        ]);
        $this->crud->addField([
            'label' => 'Point',
            'type' => 'select2_multiple',
            'name' => 'tour_guide_id', // foreign key
            'entity' => 'tour_guides', // the method that defines the relationship in your Model
            'attribute' => 'title', // foreign key attribute that is shown to user
            'model' => Tour_guides::class,
            'pivot' => true, // on create&update, do you need to add/delete pivot table entries?]);
            'options' => (function ($query) {
                return $query->orderBy('title', 'ASC')->get();
            }),
        ]);
        $this->crud->addField([
            'label' => 'Country',
            'type' => 'select2_multiple',
            'name' => 'country_id', // foreign key
            'entity' => 'country', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'model' => Country::class,
            'pivot' => true, // on create&update, do you need to add/delete pivot table entries?]);
            'options' => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }),
        ]);
        $this->crud->addField([
            'label' => 'City',
            'type' => 'select2_multiple',
            'name' => 'city_id', // foreign key
            'entity' => 'city', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'model' => City::class,
            'pivot' => true, // on create&update, do you need to add/delete pivot table entries?]);
            'options' => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }),
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
