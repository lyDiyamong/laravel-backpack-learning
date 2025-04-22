<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ProductCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ProductCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(Product::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/product');
        CRUD::setEntityNameStrings('product', 'products');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        // Product Name
        CRUD::column('name')
            ->label('Product Name');

        // Price
        CRUD::column('price')
            ->type('number')
            ->label('Price');

        // Category (shows name instead of ID)
        CRUD::column('category.name')
            ->label('Category');

        // Brand (shows name instead of ID)
        CRUD::column('brand.name')
            ->label('Brand');

        // Status (if you have it)
        CRUD::column('is_available')
            ->label('Status')
            ->type('checkbox');
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(ProductRequest::class);

        $this->crud->addField([
            'name' => 'name',
            'label' => 'Product Name',
            'type' => 'text'
        ]);

        $this->crud->addField([
            'name' => 'price',
            'label' => 'Price',
            'type' => 'number',
            'attributes' => ["step" => "any"] // Allows decimal values
        ]);

        // Category select field
        $this->crud->addField([
            'label' => "Category",
            'type' => 'select', // Better than 'select' for UX
            'name' => 'category_id',
            'entity' => 'category', // Should match the method name in your model
            'model' => Category::class,
            'attribute' => 'name',
            'options' => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }),
        ]);

        // Brand select field
        $this->crud->addField([
            'label' => "Brand",
            'type' => "select",
            'name' => "brand_id",
            'entity' => "brand", // Should match the method name in your model
            'model' => Brand::class,
            'attribute' => "name",
            'options' => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }),
        ]);

        $this->crud->addField([
            'name' => 'image',
            'label' => 'Image',
            'type' => 'upload',
            'upload' => true,
            'disk' => 'public' // or whatever disk you're using
        ]);
    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
