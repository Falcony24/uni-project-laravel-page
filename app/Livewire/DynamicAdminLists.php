<?php

namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Livewire\Component;

class DynamicAdminLists extends Component{
    protected $listeners = ['loadList' => 'loadTableData'];
    public $tableName;
    public $data = [];
    public $columns = [];
    public $id;

    public function loadList($tableName): void {
        if (Schema::hasTable($tableName)) {
            $this->tableName = $tableName;
            $this->columns = Schema::getColumnListing($tableName);
            $this->data = DB::table($tableName)->get();
        }
        else {
            $this->columns = [];
            $this->data = [];
        }
    }
    public function render()
    {
        return view('livewire.admin.dynamic-admin-lists');
    }
}
