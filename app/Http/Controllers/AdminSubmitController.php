<?php

namespace App\Http\Controllers;

use App\Models\ProductImage;
use Exception;
use Livewire\WithFileUploads;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class AdminSubmitController extends Controller {
    use WithFileUploads;

    protected array $modelMap = [
        'products' => \App\Models\Product::class,
        'categories' => \App\Models\Category::class,
        'sub_categories' => \App\Models\SubCategory::class,
        'brands' => \App\Models\Brand::class,
        'product_images' => \App\Models\ProductImage::class,
        'sub_categories_images' => \App\Models\SubCategoryImage::class
    ];

    protected function imgsToDB(array $imgsPaths, $id, $tableName) {
        $foreignKeyMap = [
            'product_images' => 'product_id',
            'sub_categories_images' => 'sub_categories_id',
        ];

        foreach ($imgsPaths as $imgPath) {
            $modelClass = $this->modelMap[$tableName];
            $model = new $modelClass;

            $filename = basename($imgPath);
            $filepath = dirname($imgPath);

            $foreignKey = $foreignKeyMap[$tableName] ?? null;

            if ($foreignKey) {
                $model->file_name = $filename;
                $model->file_path = $filepath;
                $model->$foreignKey = $id;

                $model->save();
            } else {
                throw new Exception("Nie znaleziono klucza obcego dla tabeli: $tableName");
            }
        }
    }

    public function toDB() {
        $formData = session()->get('formData');

        if ($formData) {
            $tableName = $formData['tableName'];
            $fields = $formData['fields'];
        } else {
            return response(['error' => 'Nie przekazano danych']);
        }

        if (!array_key_exists($tableName, $this->modelMap)) {
            return response(['error' => 'Nie znaleziono modelu '.$tableName]);
        }

        if (str_contains($tableName, '_images')) {
            $this->imgsToDB($fields['images'], $fields[$tableName.'_id'], $tableName);

            return redirect('/admin')->with(['success' => 'Dane zapisane']);
        }

        $modelClass = $this->modelMap[$tableName];
        $model = new $modelClass;

//        $t = '';
//        foreach($fields['images'] as $field) {
//            $t .= $field." ";
//        }
//        return response(['error' => $t]);


        foreach ($fields as $key => $value) {
            if (in_array($key, $model->getFillable())) {
                $model->$key = $value;
            }
        }

        $model->save();

        return redirect('/admin')->with(['success' => 'Dane zapisane']);
    }

    public function hasAnyRelations($model) {
        foreach ($model->getRelations() as $relation => $value) {
            if ($value instanceof \Illuminate\Database\Eloquent\Relations\HasMany ||
                $value instanceof \Illuminate\Database\Eloquent\Relations\BelongsTo) {
                if ($value->exists()) {
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function deleteRow() {
        $formData = session()->get('formData');
        $tableName = $formData['tableName'];
        $id = $formData['id'];

        $modelClass = $this->modelMap[$tableName];
        $model = new $modelClass;

        $record = $model::findOrFail($id);

        if(!$this->hasAnyRelations($model)){
            return redirect('/admin')->with(['error' => 'Istnieją powiązania, nie można usunąć bezpośrednio']);
        }

        $record->delete();

        return redirect('/admin')->with(['success' => 'Dane Usunięte']);
    }
}
