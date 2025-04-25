<?php

namespace App\Http\Controllers\Admin;

use COM;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Http\Requests\ProductRequest;
use Backpack\CRUD\app\Library\Widget;
use App\Http\Requests\ProductWithImagesRequest;
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
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation {
        store as traitStore;
    }
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation {
        update as traitUpdate;
    }

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

    protected function addProductWidgets(): void
    {
        $categorySummary = Category::withCount('products')->get()->map(function ($cat) {
            return "{$cat->name} ({$cat->products_count})";
        })->implode(', ');

        // Create a row div as a container
        Widget::add([
            'type' => 'div',
            'class' => 'row',
            'content' => [ // Each item in this content array should be a column
                // First column widget
                [
                    'type' => 'progress',
                    'label' => 'Product Count',
                    'value' => Product::count(),
                    'description' => 'Total products in the menu'
                ],
                // Second column widget
                [
                    'type' => 'view',
                    // 'class' => 'col-md-6', // Add column class directly here
                    'view' => 'admin.widgets.category-summary'
                ]
            ]
        ]);
    }

    public function setupShowOperation()
    {
        $this->setupListOperation();
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation(bool $showWidgets = false)
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

        CRUD::column('images')
            ->label('Images')
            ->type('array')
            ->wrapper([
                'element' => 'span',
                'class' => 'd-flex flex-wrap gap-1'
            ])
            ->function(function ($value, $entry) {
                return collect($entry->images)->pluck('image_url')->toArray();
            });

        if (!request()->ajax() && $showWidgets) {
            $this->addProductWidgets();
        }
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

        // Change the validation class
        CRUD::setValidation(ProductWithImagesRequest::class);

        // Your existing fields...

        // Add a multiple file upload field 
        $this->crud->addField([
            'name' => 'images',
            'label' => 'Images',
            'type' => 'upload_multiple',
            'upload' => true,
            'disk' => 'public',
            'max_file_count' => 3
        ]);
    }

    /**
     * Store a newly created resource in the database.
     */
    public function store()
    {
        // Execute the parent store method
        $response = $this->traitStore();

        // Get the product that was just created
        $product = $this->crud->entry;
        \Log::info('Files: ', request()->file('images'));
        // Handle image uploads
        $this->handleImageUploads($product, request()->file('images'));

        return $response;
    }

    /**
     * Update the specified resource in the database.
     */
    public function update()
    {
        // Execute the parent update method
        $response = $this->traitUpdate();

        // Get the product that was just updated
        $product = $this->crud->entry;

        // Handle image uploads
        $this->handleImageUploads($product, request()->file('images'));

        return $response;
    }

    /**
     * Handle image uploads and save to related table
     */
    private function handleImageUploads($product, $images)
    {
        if (!$images) return;

        // If it's not an array, wrap it
        if (!is_array($images)) {
            $images = [$images];
        }

        foreach ($images as $image) {
            if (!$image instanceof \Illuminate\Http\UploadedFile) {
                continue;
            }

            $path = $image->store('products', 'public');

            $product->images()->create([
                'image_url' => $path,
                'product_id' => $product->id
            ]);
        }
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
