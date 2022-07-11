@include('common.modalhead')

<div class="row">

    <div class="col-sm-12 col-md-8">
        <!--nombre del producto-->
        <div class="form-group">
            <label>Nombre:</label>
            <input type="text" wire:model.lazy="name" class="form-control product-name" placeholder ="Ej.: Curso Laravel" autofocus>
            @error('name') <span class="text-danger er">{{$message}}</span>@enderror
        
        </div>
    </div>


    <div class="col-sm-12 col-md-4">
        <!--Codigo de Barras-->
        <div class="form-group">
            <label>Código de Barra:</label>
            <input type="text" wire:model.lazy="barcode" class="form-control" placeholder ="Ej.: 0254897865855">
            @error('barcode') <span class="text-danger er">{{$message}}</span>@enderror
        
        </div>
    </div>

      
    <div class="col-sm-12 col-md-4">
        <!--costo-->
        <div class="form-group">
            <label>Costo:</label>
            <input type="text" data-type='currency' wire:model.lazy="cost" class="form-control" placeholder ="Ej.: 0.00">
            @error('cost') <span class="text-danger er">{{$message}}</span>@enderror
        
        </div>
    </div>
    <div class="col-sm-12 col-md-4">
        <!--precio-->
        <div class="form-group">
            <label>Precio:</label>
            <input type="text" data-type='currency' wire:model.lazy="price" class="form-control" placeholder ="Ej.: 0.00">
            @error('price') <span class="text-danger er">{{$message}}</span>@enderror
        
        </div>
    </div>
    <div class="col-sm-12 col-md-4">
        <!--stock-->
        <div class="form-group">
            <label>Stock:</label>
            <input type="number" wire:model.lazy="stock" class="form-control" placeholder ="Ej.: 0">
            @error('stock')<span class="text-danger er">{{$message}}</span>@enderror
        </div>
    </div>
    
    <div class="col-sm-12 col-md-4">
             <!--inventario minimo-->
        <div class="form-group">
            <label>Inv. Mínimo:</label>
            <input type="number" wire:model.lazy="alerts" class="form-control" placeholder ="Ej.: 10">
            @error('alerts')<span class="text-danger er">{{$message}}</span>@enderror
        </div>
    </div>
 
    <div class="col-sm-12 col-md-4">
             <!--Categorias-->
        <div class="form-group">
            <label>Categoría:</label>
            <select wire:model="categoryid" class="form-control" >
                <option value="Seleccionar" disabled>Seleccionar</option>
                @foreach($categories as $category)
                <option value="{{$category->id}}"> {{$category->name}}</option>
                @endforeach
            </select>
            @error('categoryid')<span class="text-danger er">{{$message}}</span>@enderror
        </div>
    </div>

    <div class="col-sm-12 col-md-8">
             <!--imagen-->
        <div class="form-group custom-file">
            <input type="file" class="custom-file-input form-control" wire:model="image" accept="image/x-png, image/gif, image/jpeg">
            <label class="custom-file-label">Imagen {{$image}}</label>
            @error('image') <span class="text-danger er">{{$message}}</span>@enderror
        
        </div>
        
      
    </div>

</div>

@include('common.modalFooter')