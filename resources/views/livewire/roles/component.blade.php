<div class="row sales layout-top-spacing">

    <div class="col-sm-12">
        <div class="widget widget-chart-one">
            <div class="widget-heading">
                <h4 class="card-title">
                    <b> {{ $componentName }} | {{ $pageTitle }}</b>
                </h4>
                <ul class="tabs tab-pills">
                    @can('Role_Create')
                        <li>
                            <a href="javascript:void(0)" class="tabmenu bg-dark" data-toggle="modal" data-target="#theModal">
                                Agregar

                            </a>
                        </li>
                    @endcan
                </ul>
            </div>
            @can('Role_Search')
                @include('common.searchbox')
            @endcan

            <div class="widget-content">
                <div class="table-responsive">
                    <table class="table table-bordered table striped mt-1">
                        <thead class="text-white" style="background: #3B3F5C">
                            <tr>
                                <th class="table-th text-white">ID</th>
                                <th class="table-th text-white text-centerS">DESCRIPCION</th>
                                <th class="table-th text-white text-center">ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)
                                <tr>
                                    <td>
                                        <h6> {{ $role->id }}</h6>
                                    </td>
                                    <td class="text-center">
                                        <h6>{{ $role->name }}</h6>
                                    </td>
                                    @can('Role_Update')
                                        <td class="text-center">
                                            <a href="javascript:void(0)" wire:click="Edit({{ $role->id }})"
                                                class="btn btn-dark mtmobile" title="Editar Registro">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        @endcan
                                        @can('Role_Destroy')
                                            <a href="javascript:void(0)" onclick="Confirm('{{ $role->id }}')"
                                                class="btn btn-dark" title="Eliminar Registro">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        @endcan

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $roles->links() }}
                </div>
            </div>

        </div>

    </div>
    @include('livewire.roles.form')
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        window.livewire.on('role-added', Msg => {
            $('#theModal').modal('hide')
            noty(Msg)
        })
        window.livewire.on('role-updated', Msg => {
            $('#theModal').modal('hide')
            noty(Msg)
        })
        window.livewire.on('role-deleted', Msg => {
            noty(Msg)
        })
        window.livewire.on('role-exists', Msg => {
            noty(Msg)
        })
        window.livewire.on('role-error', Msg => {
            noty(Msg)
        })
        window.livewire.on('hide-modal', Msg => {
            $('#theModal').modal('hide')
        })
        window.livewire.on('show-modal', Msg => {
            $('#theModal').modal('show')
        })
        window.livewire.on('hidden.bs.modal', Msg => {
            $('.er').css('display', 'none')
        })
    });

    function Confirm(id, products) {
        if (products > 0) {
            Swal('NO Se puede eliminar!! tiene productos relacionados')
            return;
        }
        Swal({
            title: '¿Estás Seguro? ',
            text: "No podrás revertir esto!",
            type: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Cerrar',
            cancelButtonColor: '#fff',
            confirmButtonText: 'Aceptar',
            confirmButtonColor: '#3B3F5C',
        }).then(function(result) {
            if (result.value) {
                window.livewire.emit('destroy', id);
                Swal.fire(
                    'Borrado',
                    'El Registro ha sido Borrado.',
                    'success'
                )
            }
        })
    }
</script>
