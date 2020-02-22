<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Tour_guidesRequest;
use App\Models\City;
use App\Models\Country;
use App\Models\Language;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use App\Models\Tour_guides;
use Illuminate\Support\Facades\DB;

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
    use \Backpack\CRUD\app\Http\Controllers\Operations\CloneOperation;

    public function setup()
    {
        $this->crud->setModel(Tour_guides::class);
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/tour_guides');
        $this->crud->setEntityNameStrings('points', 'points');

        $this->crud->operation(['list', 'show'], function () {
            $this->setListAndShow();
        });
    }

    private function setListAndShow(): void
    {
        $this->crud->addColumn([
            'label' => 'Language',
            'type' => 'model_function',
            'function_name' => 'getLangs',
        ]);
        $this->crud->addColumn([
            'name' => 'country.name',
            'type' => 'text',
            'label' => 'Country',
            'entity' => 'country', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'model' => Country::class,
        ]);
        $this->crud->addColumn([
            'name' => 'city.name',
            'type' => 'text',
            'label' => 'City',
            'entity' => 'city', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'model' => City::class,
        ]);
        $this->crud->addColumn(['name' => 'title', 'type' => 'text', 'label' => 'Title']);
        $this->crud->addColumn(['name' => 'text', 'type' => 'text', 'label' => 'Text']);
        $this->crud->addColumn(['name' => 'audio', 'type' => 'text', 'label' => 'Audio']);
    }

    protected function setupListOperation()
    {
        $this->crud->setFromDb();
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(Tour_guidesRequest::class);
        $this->crud->addField(['name' => 'title', 'type' => 'text', 'label' => 'Title']);
        $this->crud->addField(['name' => 'description', 'type' => 'ckeditor', 'label' => 'Description']);
        $this->crud->addField(['name' => 'text', 'type' => 'ckeditor', 'label' => 'Text']);
        $this->crud->addField([
            'name' => 'photos',
            'label' => 'Photos',
            'type' => 'upload_multiple',
            'upload' => true,
//            'disk' => 'uploads', // if you store files in the /public folder, please ommit this; if you store them in /storage or S3, please specify it;
            // optional:
//            'temporary' => 10 // if using a service, such as S3, that requires you to make temporary URL's this will make a URL that is valid for the number of minutes specified
        ]);

        $this->crud->addField(['name' => 'lat', 'type' => 'text', 'label' => 'Latitude']);
        $this->crud->addField(['name' => 'lng', 'type' => 'text', 'label' => 'Longitude']);
//        $this->crud->addField([
//            'label' => 'Tour',
//            'type' => 'select',
//            'name' => 'tour_id', // foreign key
//            'entity' => 'tour', // the method that defines the relationship in your Model
//            'attribute' => 'title', // foreign key attribute that is shown to user
//            'pivot' => false, // on create&update, do you need to add/delete pivot table entries?]);
//        ]);
        // many-to-many via lang_id() method difficult relations
        $this->crud->addField([
            'label' => 'Language',
            'type' => 'select2_multiple',
            'name' => 'lang_id', // foreign key
            'entity' => 'language', // the method that defines the relationship in your Model
            'attribute' => 'lang', // foreign key attribute that is shown to user
            'model' => Language::class,
            'pivot' => true, // on create&update, do you need to add/delete pivot table entries?]);
        ]);
        $this->crud->addField([
            'label' => 'Country',
            'type' => 'select',
            'name' => 'country_id', // foreign key
            'entity' => 'country', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'pivot' => false, // on create&update, do you need to add/delete pivot table entries?]);
            'options' => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }),
        ]);
        $this->crud->addField([
            'label' => 'City',
            'type' => 'select',
            'name' => 'city_id', // foreign key
            'entity' => 'city', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'pivot' => false, // on create&update, do you need to add/delete pivot table entries?]);
            'options' => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }),
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    public function setPhotosAttribute($value)
    {
        $attribute_name = 'photos';
        $disk = 'public';
        $destination_path = 'public/photos';

        $this->uploadMultipleFilesToDisk($value, $attribute_name, $disk, $destination_path);
    }
}
