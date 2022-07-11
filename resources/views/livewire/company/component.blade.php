<div class="row sales layout-top-spacing">
    <div class="col-sm-12">
        <div class="widget widget-chart-one">
            <!--Encabezado-->
            <div class="widget-heading">
                <h4 class="card-title">
                    <b>{{ $componentName }} | {{ $pageTitle }}</b>
                </h4>
                <ul class="tabs tab-pills">
                    @can('Company_Create')
                        <li>
                            @if ($data->count() < 1)
                            <a href="javascript:void(0)" class="tabmenu bg-dark" data-toggle="modal" data-target="#theModal">
                                Agregar
                            </a>
                            @endif
                            
                        </li>
                    @endcan
                </ul>
            </div>
            @can('Company_Search')
                @include('common.searchbox')
            @endcan
            <!--Contenido de la targeta (cardbody)-->
            <div class="widget-content">
                <div class="table-responsive">
                    <table class="table table-bordered table striped mt-1">

                        <thead class="text-white" style="background:#3b3f5c">
                            <tr>
                                <th class="table-th text-white">NOMBRE</th>
                                <th class="table-th text-white text-center">DIRECCIÓN</th>
                                <th class="table-th text-white text-center">TELÉFONO</th>
                                <th class="table-th text-white text-center">RFC</th>
                                <th class="table-th text-white text-center">ACTIONS</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($data as $r)
                                <tr>
                                    <td>
                                        <h6>{{ $r->name }}</h6>
                                    </td>
                                    <td class="text-center">
                                        <h6>{{ $r->address }}</h6>
                                    </td>
                                    <td class="text-center">
                                        <h6>{{ $r->phone }}</h6>
                                    </td>
                                    <td class="text-center">
                                        <h6>{{ $r->taxpayer_id }}</h6>
                                    </td>
                                    <td class="text-center">
                                        @can('Company_Update')
                                            <a href="javascript:void(0)" wire:click.prevent="Edit({{ $r->id }})"
                                                class="btn btn-dark mtmobile" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        @endcan
                                        @can('Company_Destroy')
                                            <a href="javascript:void(0)" class="btn btn-dark" title="Delete"
                                                onclick="confirm('{{ $r->id }}')">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        @endcan

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                    
                </div>
            </div>
        </div>
    </div>

    @include('livewire.company.form')
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        window.livewire.on('company-added', Msg => {
            $('#theModal').modal('hide')
            noty(Msg)
        })
        window.livewire.on('company-updated', Msg => {
            $('#theModal').modal('hide')
            noty(Msg)
        })
        window.livewire.on('company-deleted', Msg => {
            noty(Msg)
        })
        window.livewire.on('hide-modal', Msg => {
            $('#theModal').modal('hide')
        })
        window.livewire.on('show-modal', Msg => {
            $('#theModal').modal('show')
        })

    });

    function confirm(id) {
        swal({
            title: 'CONFIRMAR',
            text: '¿CONFIRMAS QUE DESEAS ELIMINAR EL REGISTRO?',
            type: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Cerrar',
            cancelButtonColor: '#fff',
            confirmButtonText: 'Aceptar',
            confirmButtonColor: '#3B3F5C',
        }).then(function(result) {
            if (result.value) {
                window.livewire.emit('deleteRow', id)
                Swal.fire(
                    'Borrado',
                    'El Registro ha sido Borrado.',
                    'success'
                )
            }
        })
    }
</script>
