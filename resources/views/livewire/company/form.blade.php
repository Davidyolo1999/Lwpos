@include('common.modalHead')
<div class="row">
    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            <label>Nombre de la compañia:</label>
            <input type="text" wire:model.lazy="name" class="form-control" placeholder ="Ej.: Bussiness name">
            @error('name') <span class="text-danger er">{{$message}}</span>@enderror
        </div>
    </div>
    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            <label>Dirección:</label>
            <input type="text" wire:model.lazy="address" class="form-control" placeholder ="Ej.: San ildefonso, Villa de allende, México." >
            @error('address') <span class="text-danger er">{{$message}}</span>@enderror
        </div>
    </div>
    <div class="col-sm-12 col-md-6">
        <!--nombre del producto-->
        <div class="form-group">
            <label>Teléfono:</label>
            <input type="text" wire:model.lazy="phone" class="form-control" placeholder ="Ej.: 72260497398" maxlength="10">
            @error('phone') <span class="text-danger er">{{$message}}</span>@enderror
        </div>
    </div>
    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            <label>RFC:</label>
            <input type="text" wire:model.lazy="taxpayer_id" class="form-control" placeholder ="Ej.: 7226049">
            @error('taxpayer_id') <span class="text-danger er">{{$message}}</span>@enderror
        </div>
    </div>
</div>
@include('common.modalFooter')