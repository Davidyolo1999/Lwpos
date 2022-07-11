<div class="row sales layout-top-spacing">

    <div class="col-sm-12">
        <div class="widget widget-chart-one">
            <div class="widget-heading">
                <h4 class="card-title">
                    <b> {{ $componentName }} | {{ $pageTitle }}</b>
                </h4>
                <ul class="tabs tab-pills">
                    @can('Category_Create')
                        <li>
                            <a href="javascript:void(0)" class="tabmenu bg-dark" data-toggle="modal" data-target="#theModal">
                                Agregar

                            </a>
                        </li>
                    @endcan
                </ul>
            </div>
            @can('Category_Search')
                @include('common.searchbox')
            @endcan

            <div class="widget-content">
                <div class="table-responsive">
                    <table class="table table-bordered table striped mt-1">
                        <thead class="text-white" style="background: #3B3F5C">
                            <tr>
                                <th class="table-th text-white">DESCRIPCION</th>
                                <th class="table-th text-white">IMAGEN</th>
                                <th class="table-th text-white">ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    <td>
                                        <h6> {{ $category->name }}</h6>
                                    </td>
                                    <td class="text-center">
                                        <span>
                                            <img src="{{ asset('storage/categories/' . $category->imagen) }}"
                                                alt="imagen de ejemplo" height="70" width="80" class="rounded">
                                        </span>
                                    </td>

                                    <td class="text-center">

                                        @can('Category_Update')
                                            <a href="javascript:void(0)" wire:click="Edit({{ $category->id }})"
                                                class="btn btn-dark mtmobile" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        @endcan

                                        @if ($category->products->count() < 1)
                                            @can('Category_Destroy')
                                                <a href="javascript:void(0)" onclick="Confirm('{{ $category->id }}')"
                                                    class="btn btn-dark" title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            @endcan
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $categories->links() }}
                </div>
            </div>

        </div>

    </div>
    @include('livewire.category.form')
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        window.livewire.on('show-modal', Msg => {
            $('#theModal').modal('show');
        });
        window.livewire.on('category-added', Msg => {
            $('#theModal').modal('hide');
            noty(Msg)
        });
        window.livewire.on('category-updated', Msg => {
            $('#theModal').modal('hide')
            noty(Msg)
        });
        window.livewire.on('category-deleted', Msg => {
            $('#theModal').modal('hide')
            noty(Msg)
        });
    });

    function Confirm(id, products) {
        if (products > 0) {
            Swal('NO Se puede eliminar!! tiene productos relacionados')
            return;
        }
        Swal({
            title: '¿Estás Seguro? ',
            text: "No podrás revertir esto!",
            icon: 'Advertencia',
            showCancelButton: true,
            cancelButtonText: 'Cerrar',
            cancelButtonColor: '#fff',
            confirmButtonText: 'Aceptar',
            confirmButtonColor: '#3B3F5C',
        }).then(function(result) {
            if (result.value) {
                window.livewire.emit('deleteRow', id);
                Swal.fire(
                    'Borrado',
                    'El Registro ha sido Borrado.',
                    'success'
                )
            }
        })
    }
</script>
