<?php
namespace App\Traits;

use Darryldecode\Cart\Facades\CartFacade as Cart; //lib carrito
use App\Models\Product;

trait CartTrait{

    
    public function ScanearCode($barcode, $cant = 1)
    {
        //dd($barcode);
        $product = Product::where('barcode', $barcode)->first();
        if ($product == null || empty($product)) {
            $this->emit('scan-notfound', 'El Producto no Está Registrado');
        } else {
            if ($this->InCart($product->id)) {
                $this->IncreaseQuantity($product);
                return;
            }
            if ($product->stock < 1) {
                $this->emit('no-stock', 'Stock Insuficiente *');
                return;
            }
            Cart::add($product->id, $product->name, $product->price, $cant, $product->imagen);
            $this->total = Cart::getTotal();
            $this->itemsQuantity = Cart::getTotalQuantity();
            $this->emit('scan-ok', 'Producto Agregado *');
        }
    }

    public function InCart($productId)
    {
        $exist = Cart::get($productId);
        if ($exist)
            return true;
        else
            return false;
    }

    public function IncreaseQuantity($product, $cant = 1)
    {
       // dd($product);
        $title = '';
        $exist = Cart::get($product->id);
        if ($exist)
            $title = 'Cantidad Actualizada*';
        else
            $title = 'Producto Agregado*';
        if ($exist) {
            if ($product->stock < ($cant + $exist->quantity)) {

                $this->emit('no-stock', 'Stock Insuficiente*');
                return;
            }
        }
        Cart::add($product->id, $product->name, $product->price, $cant, $product->imagen);
        $this->total = Cart::getTotal();
        $this->itemsQuantity = Cart::getTotalQuantity();
        $this->emit('scan-ok', $title);
    }

    public function updateQuantity($product, $cant = 1)
    {
        $title = '';
        $exist = Cart::get($product->id);
        if ($exist)
            $title = 'Cantidad Actualizada*';
        else
            $title = 'Producto Agregado*';

        if ($exist) {
            if ($product->stock < $cant) {
                $this->emit('no-stock', 'Stock Insuficiente*');
                return;
            }
        }
        $this->removeItem($product->id);
        if ($cant > 0) {
            Cart::add($product->id, $product->name, $product->price, $cant, $product->imagen);
            $this->total = Cart::getTotal();
            $this->itemsQuantity = Cart::getTotalQuantity();
            $this->emit('scan-ok', $title);
        }
    }

    public function removeItem($id)
    {
        Cart::remove($id);
        $this->total = Cart::getTotal();
        $this->itemsQuantity = Cart::getTotalQuantity();
        $this->emit('scan-ok', 'Producto Eliminado*');
    }

    public function decreaseQuantity($productId)
    {
        $item = Cart::get($productId);
        Cart::remove($productId);
        $img = (count($item->attributes) > 0 ? $item->attributes[0] : Product::find($productId->imagen));

        $newQty = ($item->quantity) - 1;
        if ($newQty > 0)
            Cart::add($item->id, $item->name, $item->price, $newQty, $img);
        $this->total = Cart::getTotal();
        $this->itemsQuantity = Cart::getTotalQuantity();
        $this->emit('scan-ok', 'Cantidad Actualizada*');
    }

    public function trashCart()
    {
        Cart::clear();
        $this->efectivo = 0;
        $this->change = 0;
        $this->total = Cart::getTotal();
        $this->itemsQuantity = Cart::getTotalQuantity();
        $this->emit('scan-ok', 'Carrito Vacio*');
    }

}