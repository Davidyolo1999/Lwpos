<?php

namespace App\Http\Livewire;


namespace App\Http\Livewire;

use App\Models\Denomination;
use Livewire\Component;
use Livewire\WithFileUploads; //trait para subir imagenes
use Livewire\WithPagination; // para la paginacion

class CoinsController extends Component

{
    use WithFileUploads;
    use withPagination;
    public $type, $value, $search, $image, $selected_id, $pageTitle, $componentName;
    private $pagination = 5;


    public function mount()
    {
        $this->pageTitle = 'Listado';
        $this->componentName = 'Denominaciones';
        $this->type = 'Seleccionar';
    }
    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }
    public function render()
    {
        if (strlen($this->search) > 0)
            $data = Denomination::where('type', 'like', '%' . $this->search . '%')->paginate($this->pagination);
        else
            $data = Denomination::orderby('id', 'asc')->paginate($this->pagination);

        return view('livewire.denominations.component', ['data' => $data])
            ->extends('layouts.theme.app')
            ->section('content');
    }

    public function Edit($id)
    {
        $record = Denomination::find($id, ['id', 'type', 'value', 'image']);
        $this->type = $record->type;
        $this->value = $record->value;
        $this->selected_id = $record->id;
        $this->image = null;
        $this->emit('show-modal', 'show modal');
    }

    public function Store()
    {
        $rulles = [
            'type' => 'required|not_in:Seleccionar',
            'value' => 'required|unique:denominations'
        ];

        $messages = [
            'type.required' => 'El tipo es requerido',
            'type.not_int' => 'Elige un valor distinto a Seleccionar',
            'value.required' => 'El valor es requerido',
            'value.unique' => 'Ya existe el valor'

        ];
        $this->validate($rulles, $messages);

        $denomination = Denomination::create([
            'type' => $this->type,
            'value' => $this->value
        ]);

        if ($this->image) {
            $customFileName = uniqid() . '_.' . $this->image->extension();
            $this->image->storeAs('public/denominations', $customFileName);
            $denomination->image = $customFileName;
            $denomination->save();
        }

        $this->ResetUI();
        $this->emit('item-added', 'Denominación Registrada');
    }


    public function Update()
    {
        //primero validamos que el name sea ingresado si o si que no quede null
        $rules = [
            'type' => 'required|not_in:Seleccionar',
            'value' => "required|unique:denominations,value,{$this->selected_id}"
        ];
        $messages = [
            'type.required' => 'El tipo es requerido',
            'type.not_int' => 'Elige un valor distinto a Seleccionar',
            'value.required' => 'El valor es requerido',
            'value.unique' => 'Ya existe el valor'
        ];
        //ejecutamos las validaciones
        $this->validate($rules, $messages);

        ///update
        $denomination = Denomination::find($this->selected_id);
        $denomination->update([
            'type' => $this->type,
            'value' => $this->value,
        ]);  ///SAVE
        if ($this->image) {
            $customFileName = uniqid() . '_.' . $this->image->extension();
            $this->image->storeAs('public/denominations', $customFileName);
            $imageName = $denomination->image;

            $denomination->image = $customFileName;
            $denomination->save();
            if ($imageName != null) {
                if (file_exists('storage/denominations' . $imageName)) {
                    unlink('storage/denominations' . $imageName);
                }
            }
        }
        $this->ResetUI();
        $this->emit('item-updated', 'Denominacion Actualizada');
    }


    public function ResetUI()
    {
        $this->type = '';
        $this->value = '';
        $this->image = null;
        $this->search = '';
        $this->selected_id = 0;
        $this->resetValidation();
        $this->resetPage();
        
    }
    protected $listeners = [
        'deleteRow' => 'Destroy'
    ];



    public function Destroy(Denomination $denomination)
    {
        $imageName = $denomination->image; //creamos una imagen temporal para despues eliminarla
        $denomination->delete();

        if ($imageName != null) {
            unlink('storage/denominations/' . $imageName);
        }
        //reinicializamos 
        $this->ResetUI();
        $this->emit('item-deleted', 'Denominacion Eliminada');
    }
}
