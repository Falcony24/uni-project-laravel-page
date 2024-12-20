<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Schema;
use Livewire\Component;
use Livewire\WithFileUploads;

class DynamiAdminForms extends Component{
    use WithFileUploads;

    public $listeners = ['loadForm' => 'loadForm'];
    public $tableName;
    public $formFields = [];
    public $fields = [];
    public $images = [];

    public function loadImgForm($tableName): void{
        if (Schema::hasTable($tableName)){
            $this->formFields = ['images'];
            $this->tableName = $tableName;
        }
        else {
            $this->formFields = [];
            $this->tableName = null;
        }
    }
    public function loadForm($tableName): void{
        if (Schema::hasTable($tableName)){
            $this->tableName = $tableName;
            $this->formFields = Schema::getColumnListing($tableName);
        }
        else {
            $this->formFields = [];
            $this->tableName = null;
        }
    }

    protected function submitImgs() {
        $this->validate([
            'images.*' => 'required|file|mimes:jpg,jpeg,png|max:1024'
        ]);

        $id = $this->fields[$this->tableName.'_id'];
        $paths = [];

        foreach ($this->images as $image) {
            $paths[] = $image->store('uploads/'.$this->tableName.'/'.$id, 'public');
        }
        $this->fields['images'] = $paths;
        $this->fields[$this->tableName.'_id'] = $id;
    }

    public function submit(){
        if (str_contains($this->tableName, '_images')){
            $this->submitImgs();
        }

        session()->flash('formData', ['tableName' => $this->tableName, 'fields' => $this->fields]);

        return redirect()->route('admin.submitData');
    }

    public function render(){
        return view('livewire.admin.dynamiAdminForms');
    }
}
