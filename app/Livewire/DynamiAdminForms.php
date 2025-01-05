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

    public function render(){
        return view('livewire.admin.dynamiAdminForms');
    }
}
