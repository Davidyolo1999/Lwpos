<div class="row sales layout-top-spacing">

    <div class="col-sm-12 ">
        <div class="widget widget-chart-one">
            <div class="widget-heading">
                <h4 class="card-title">
                    <b> {{ $componentName }}| {{ $pageTitle }}</b>
                </h4>
                <ul class="tabs tab-pills">
                    <li>
                        @can('Coin_Create')
                            
                        
                        <a href="javascript:void(0)" class="tabmenu bg-dark" data-toggle="modal"
                            data-target="#theModal"> Agregar

                        </a>
                        @endcan
                    </li>
                </ul>
            </div>
            @can('Coin_Search')
            @include('common.searchbox')
            @endcan
            <div class="widget-content">
                <div class="table-responsive">
                    <table class="table table-bordered table striped mt-1">
                        <thead class="text-white" style="background: #3B3F5C">
                            <tr>
                                <th class="table-th text-white">TIPO</th>
                                <th class="table-th text-white text-center">VALOR</th>
                                <th class="table-th text-white text-cente">IMAGEN</th>
                                <th class="table-th text-white text-cente">ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $coin)
                                <tr>
                                    <td>
                                        <h6> {{ $coin->type }}</h6>
                                    </td>
                                    <td>
                                        <h6 class="text-center"> ${{ number_format($coin->value, 2) }}</h6>
                                    </td>

                                    <td class="text-center">
                                        <span>
                                            <img src="{{ asset('storage/denominations/' . $coin->imagen) }}"
                                                alt="imagen de ejemplo" height="70" width="80" class="rounded">
                                        </span>
                                    </td>
                                    @can('Coin_Update')
                                    <td class="text-center">
                                        <a href="javascript:void(0)" wire:click="Edit({{ $coin->id }})"
                                            class="btn btn-dark mtmobile" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        @endcan
                                        @can('Coin_Destroy')
                                        <a href="javascript:void(0)" class="btn btn-dark" title="Delete"
                                            onclick="confirm('{{ $coin->id }}')">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                        @endcan

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $data->links() }}
                </div>
            </div>

        </div>

    </div>
    @include('livewire.denominations.form')
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        window.livewire.on('item-deleted', Msg => {
            noty(Msg)
        });
        window.livewire.on('item-added', Msg => {
            $('#theModal').modal('hide');
            noty(Msg)
        });
        window.livewire.on('item-updated', Msg => {
            $('#theModal').modal('hide')
            noty(Msg)
        });

        window.livewire.on('show-modal', Msg => {
            $('#theModal').modal('show')
        });
        window.livewire.on('modal-hide', Msg => {
            $('#theModal').modal('hide')
        });

        $('#theModal').on('hidden.bs.modal', function(e) {
            $('.er').css('display', 'none')
        });

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
