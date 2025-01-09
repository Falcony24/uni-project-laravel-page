<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class AdminSubmitController extends Controller {
    use WithFileUploads;

    protected array $modelMap = [
        'products' => \App\Models\Product::class,
        'categories' => \App\Models\Category::class,
        'sub_categories' => \App\Models\SubCategory::class,
        'addresses' => \App\Models\Addresses::class,
        'product_images' => \App\Models\ProductImage::class,
        'sub_categories_images' => \App\Models\SubCategoryImage::class,
        'users' => \App\Models\User::class,
        'brands' => \App\Models\Brand::class,
    ];

    public function toDB(Request $request) {
        $tableName = $request->input('tableName');
        $fields = $request->except(['_token', 'tableName', 'images']);
        $images = $request->file('images', []);

        if (!array_key_exists($tableName, $this->modelMap)) {
            return redirect()->back()->withErrors(['error' => 'Nie znaleziono modelu ' . $tableName]);
        }

        $modelClass = $this->modelMap[$tableName];
        $model = new $modelClass;

        if (str_contains($tableName, '_images')) {
            $this->handleImages($images, $fields[$tableName . '_id'], $tableName);
        } else {
            foreach ($fields as $key => $value) {
                if (in_array($key, $model->getFillable())) {
                    $model->$key = $value;
                }
            }

            $model->save();
        }

        return redirect('/admin')->with(['success' => 'Dane zapisane']);
    }

    protected function handleImages(array $images, $id, $tableName) {
        foreach ($images as $image) {
            $path = $image->store('uploads/' . $tableName . '/' . $id, 'public');
            $modelClass = $this->modelMap[$tableName];
            $model = new $modelClass;

            $model->file_name = basename($path);
            $model->file_path = dirname($path);
            $model->product_id = $id;

            $model->save();
        }
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */

    public function deleteRow(Request $request){
        $tableName = $request->input('tableName');
        $id = $request->input('id');

        if (!array_key_exists($tableName, $this->modelMap)) {
            return redirect('/admin')->with(['error' => 'Nie znaleziono modelu dla tabeli: ' . $tableName]);
        }

        $modelClass = $this->modelMap[$tableName];
        $model = new $modelClass;

        $record = $model::findOrFail($id);

        try {
            if ($tableName === 'product_images') {
                $filePath = $record->file_path;
                $fileName = $record->file_name;

                if (Storage::disk('public')->exists($filePath . '/' . $fileName)) {
                    Storage::disk('public')->delete($filePath . '/' . $fileName);
                }
            }

            $record->delete();

        } catch (QueryException $e) {
            if (str_contains($e->getMessage(), 'Cannot delete or update a parent row: a foreign key constraint fails')) {
                return redirect('/admin')->with(['error' => 'Nie można usunąć rekordu, ponieważ jest powiązany z innymi danymi.']);
            }

            throw $e;
        }

        return redirect('/admin')->with(['success' => 'Dane Usunięte']);
    }

    public function editRow(Request $request) {
        $tableName = $request->input('tableName');
        $id = $request->input('id');

        $modelClass = $this->modelMap[$tableName];

        $row = $modelClass::findOrFail($id);

        return view('editProduct', [
            'title' => 'Edycja produktu',
            'tableName' => $tableName,
            'row' => $row,
        ]);
    }

    public function editRowSubmit(Request $request) {
        $tableName = $request->input('tableName');
        $modelClass = $this->modelMap[$tableName] ?? null;

        if (!$modelClass || !class_exists($modelClass)) {
            return back()->withErrors(['error' => 'Nieprawidłowa tabela.']);
        }

        $id = $request->input('id');
        $modelInstance = $modelClass::find($id);

        if (!$modelInstance) {
            return back()->withErrors(['error' => 'Nie znaleziono rekordu.']);
        }

        try {
            $attributes = $request->except(['_token', '_method', 'tableName', 'id']);
            $modelInstance->update($attributes);
            return redirect()
                ->route('admin.index', ['tableName' => $tableName])->with('success', 'Rekord został zaktualizowany.');
        }
        catch (\Exception $e) {
            return redirect()
                ->route('admin.index', ['error' => 'Wystąpił błąd podczas aktualizacji rekordu: ' . $e->getMessage()])
                ->with('success', 'Rekord został zaktualizowany.');
        }
    }
}
