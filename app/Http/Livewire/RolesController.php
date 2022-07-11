<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Livewire\WithPagination;
use app\model\User;
use DB;

class RolesController extends Component
{
    use WithPagination;
    public $roleName, $search, $selected_id, $pageTitle, $componentName;
    public $pagination = 5;
    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }

    public function mount()
    {
        $this->pageTitle = 'Listado';
        $this->componentName = 'Roles';
    }
    public function render()
    {
        if (strlen($this->search) > 0)
            $roles = Role::Where('name', 'like', '%'. $this->search . '%')->paginate($this->pagination);
        else
            $roles = Role::orderBy('name', 'asc')->paginate($this->pagination);


        return view('livewire.roles.component', [
            'roles' => $roles
        ])
            ->extends('layouts.theme.app')
            ->section('content');
    }
    public function CreateRole()
    {
    $rules=['roleName'=>'required|min:2|unique:roles,name'];
    $messages=[
        'roleName.required'=> 'El Nombre del Role es Requerido',
        'roleName.unique'=> 'El Role ya Existe',
        'roleName.min'=>'El Nombre del Role debe Tener al menos 2 Caracteres'
    ];
    $this->validate($rules,$messages);
    Role::create(['name'=>$this->roleName]);
    $this->emit('role-added','Se Registro el rol con Éxito');
    $this->ResetUI();
    }
public function Edit($id)
{
    $role=Role::find($id);
    $this->selected_id=$role->id;
    $this->roleName=$role->name;
    $this->emit('show-modal','Show modal');

}
public function UpdateRole()
{
    $rules=['roleName'=> "required|min:2|unique:roles,name,{$this->selected_id}"];
    $messages=[
        'roleName.required'=> 'El Nombre del Role es Requerido',
        'roleName.unique'=> 'El Role ya Existe',
        'roleName.min'=>'El Nombre del Role debe Tener al menos 2 Caracteres'
    ];
    $this->validate($rules,$messages);
    $role=Role::find($this->selected_id);
    $role->name=$this->roleName;
    $role->save();
    $this->emit('role-updated','Se Actualizo el role con Éxito');
    $this->ResetUI();
}

protected $listeners=['destroy'=>'Destroy'];

public function Destroy($id)
{

$permissionsCount=Role::find($id)->permissions->count();
if($permissionsCount>0){
    $this->emit('role-error', 'No se puede Eliminar el role tiene Permisos Adociados');
    return;
}
Role::find($id)->delete();
$this->emit('role-deleted', 'Se Eliminó el rol con Éxito');
}
public function ResetUI()
{
    $this->roleName='';
    $this->search='';
    $this->selected_id=0;
    $this->resetValidation();
    $this->resetPage();
}

}
