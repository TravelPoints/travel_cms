<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\TourRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
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

    public function setup()
    {
        $this->crud->setModel(Tour::class);
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/tour');
        $this->crud->setEntityNameStrings('tour', 'tours');

        $this->crud->operation('list', function() {
            $this->crud->addColumn(['name' => 'duration', 'type' => 'text', 'label' => 'Duration']);
        });

        $this->crud->operation(['create', 'update'], function() {
            $this->crud->setValidation(TourRequest::class);
            $this->crud->addField(['name' => 'duration', 'type' => 'text', 'label' => 'Duration']);
        });
    }

    protected function setupListOperation()
    {
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        $this->crud->setFromDb();
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(TourRequest::class);

        // TODO: remove setFromDb() and manually define Fields
        $this->crud->setFromDb();
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
