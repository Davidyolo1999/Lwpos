<div class="row sales layout-top-spacing">


    <div class="col-sm-12">
        <div class="widget widget-chart-one">
            <!--Encabezado-->
            <div class="widget-heading">
                <h4 class="card-title">
                    <b>{{ $componentName }} | {{ $pageTitle }}</b>
                </h4>
                <ul class="tabs tab-pills">
                    <li>
                        @can('Product_Create')
                            <a href="javascript:void(0)" class="tabmenu bg-dark" data-toggle="modal"
                                data-target="#theModal">Agregar</a>
                        @endcan
                    </li>
                </ul>
            </div>
            @can('Product_Search')
                @include('common.searchbox')
            @endcan
            <!--Contenido de la targeta (cardbody)-->
            <div class="widget-content">
                <div class="table-responsive">
                    <table class="table table-bordered table striped mt-1">
                        <thead class="text-white" style="background:#3b3f5c">

                            <tr>
                                <th class="table-th text-white text-center">DESCRIPCIÓN</th>
                                <th class="table-th text-white text-center">CÓDIGO DE BARRA</th>
                                <th class="table-th text-white text-center">CATEGORÍA</th>

                                <th class="table-th text-white text-center">PRECIO</th>
                                <th class="table-th text-white text-center">STOCK</th>
                                <th class="table-th text-white text-center">INVENTARIO MÍNIMO</th>
                                <th class="table-th text-white text-center">IMAGEN</th>
                                <th class="table-th text-white text-center">ACCIÓN</th>
                            </tr>

                        </thead>

                        <tbody>
                            @foreach ($data as $product)
                                <tr>
                                    <td>
                                        <h6 class="text-left">{{ $product->name }}</h6>
                                    </td>
                                    <td class=" text-center">
                                        <h6>{{ $product->barcode }}</h6>
                                    </td>
                                    <td class="text-center">
                                        <h6>{{ $product->category }}</h6>
                                    </td>

                                    <td class="text-center">
                                        <h6>$ {{ $product->price }}</h6>
                                    </td>
                                    <td class="text-center">
                                        <h6>{{ $product->stock }}</h6>
                                    </td>
                                    <td class="text-center">
                                        <h6>{{ $product->alerts }}</h6>
                                    </td>


                                    <td class="text-center">
                                        <span>
                                            <img src="{{ asset('storage/products/' . $product->imagen) }}"
                                                height="70" width="80" class="rounded" alt="imagen de ejemplo"
                                                class="rounded">
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        @can('Product_Update')
                                            <a href="javascript:void(0)" wire:click.prevent="Edit({{ $product->id }})"
                                                class="btn btn-dark mtmobile" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        @endcan
                                        @can('Product_Destroy')
                                            <a href="javascript:void(0)" class="btn btn-dark" title="Delete"
                                                onclick="confirm('{{ $product->id }}')">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        @endcan
                                        <button wire:click.prevent="ScanCode('{{ $product->barcode }}')"
                                            class="btn btn-dark">
                                            <i class="fas fa-shopping-cart"> </i>
                                        </button>
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

    @include('livewire.products.form')
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        window.livewire.on('product-delete', Msg => {
            noty(Msg)
        });
        window.livewire.on('product-added', Msg => {
            $('#theModal').modal('hide')
            noty(Msg)
        });
        window.livewire.on('product-updated', Msg => {
            $('#theModal').modal('hide')
            noty(Msg)
        });
        window.livewire.on('modal-show', Msg => {
            $('#theModal').modal('show')
        });
        window.livewire.on('modal-hide', Msg => {
            $('#theModal').modal('hide')
        });
        window.livewire.on('hidden.bs.modal', Msg => {
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
