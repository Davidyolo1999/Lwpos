<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Livewire\WithPagination;
use app\model\User;
use DB;

class PermisosController extends Component
{
    use WithPagination;
    public $permissionName, $search, $selected_id, $pageTitle, $componentName;
    public $pagination = 10;
    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }

    public function mount()
    {
        $this->pageTitle = 'Listado';
        $this->componentName = 'Permisos';
    }
    public function render()
    {
        if (strlen($this->search) > 0)
            $permisos = Permission::Where('name', 'like', '%'. $this->search . '%')->paginate($this->pagination);
        else
            $permisos = Permission::orderBy('name', 'asc')->paginate($this->pagination);


        return view('livewire.permisos.component', [
            'permisos' => $permisos
        ])
            ->extends('layouts.theme.app')
            ->section('content');
    }
    public function CreatePermission()
    {
    $rules=['permissionName'=>'required|min:2|unique:permissions,name'];
    $messages=[
        'permissionName.required'=> 'El Nombre del Permiso es Requerido',
        'permissionName.unique'=> 'El Permiso ya Existe',
        'permissionName.min'=>'El Nombre del Permiso debe Tener al menos 2 Caracteres'
    ];
    $this->validate($rules,$messages);
    Permission::create(['name'=>$this->permissionName]);
    $this->emit('permiso-added','Se Registro el permiso con Éxito');
    $this->ResetUI();
    }
public function Edit(Permission $permiso)
{
    //$role=Role::find($id);
    $this->selected_id=$permiso->id;
    $this->permissionName=$permiso->name;
    $this->emit('show-modal','Show modal');

}
public function UpdatePermission()
{
    $rules=['permissionName'=> "required|min:2|unique:permissions,name,{$this->selected_id}"];
    $messages=[
        'permissionName.required'=> 'El Nombre del Permiso es Requerido',
        'permissionName.unique'=> 'El Permiso ya Existe',
        'permissionName.min'=>'El Nombre del Permiso debe Tener al menos 2 Caracteres'
    ];
    $this->validate($rules,$messages);
    $permiso=Permission::find($this->selected_id);
    $permiso->name=$this->permissionName;
    $permiso->save();

    $this->emit('permiso-updated','Se Actualizo el permiso con Éxito');
    $this->ResetUI();
}

protected $listeners=['destroy'=>'Destroy'];

public function Destroy($id)
{

$rolesCount=Permission::find($id)->getRoleNames()->count();
if($rolesCount>0){
    $this->emit('permiso-error', 'No se puede Eliminar el permiso tiene roles Adociados');
    return;
}
Permission::find($id)->delete();
$this->emit('permiso-deleted', 'Se Eliminó el permiso con Éxito');
}
public function ResetUI()
{
    $this->permissionName='';
    $this->search='';
    $this->selected_id=0;
    $this->resetValidation();
    $this->resetPage();
}

}
