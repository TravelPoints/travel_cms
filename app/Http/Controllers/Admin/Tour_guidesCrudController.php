<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Tour_guidesRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use App\Models\Tour_guides;

/**
 * Class Tour_guidesCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class Tour_guidesCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel(Tour_guides::class);
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/tour_guides');
        $this->crud->setEntityNameStrings('tour_guides', 'tour_guides');
    }

    protected function setupListOperation()
    {
        $this->crud->setColumns(['title', 'description', 'lang', 'order', 'tour.title', 'country.name', 'city.name']);
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(Tour_guidesRequest::class);
        $this->crud->addField(['name' => 'title', 'type' => 'text', 'label' => 'Title']);
        $this->crud->addField(['name' => 'title', 'type' => 'text', 'label' => 'Title']);
        $this->crud->addField(['name' => 'description', 'type' => 'ckeditor', 'label' => 'Description']);
        $this->crud->addField(['name' => 'lang', 'type' => 'text', 'label' => 'Language']);
        $this->crud->addField(['name' => 'order', 'type' => 'number', 'label' => 'Order']);
        $this->crud->addField(['name' => 'lat', 'type' => 'text', 'label' => 'Latitude']);
        $this->crud->addField(['name' => 'lng', 'type' => 'text', 'label' => 'Longitude']);
        $this->crud->addField([
            'label' => 'Tour',
            'type' => 'select',
            'name' => 'tour_id', // foreign key
            'entity' => 'tour', // the method that defines the relationship in your Model
            'attribute' => 'title', // foreign key attribute that is shown to user
            'pivot' => false, // on create&update, do you need to add/delete pivot table entries?]);
        ]);
        $this->crud->addField([
            'label' => 'Country',
            'type' => 'select',
            'name' => 'country_id', // foreign key
            'entity' => 'country', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'pivot' => false, // on create&update, do you need to add/delete pivot table entries?]);
        ]);
        $this->crud->addField([
            'label' => 'City',
            'type' => 'select',
            'name' => 'city_id', // foreign key
            'entity' => 'city', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'pivot' => false, // on create&update, do you need to add/delete pivot table entries?]);
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
