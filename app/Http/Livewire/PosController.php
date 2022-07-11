<?php

namespace App\Http\Livewire;

use Darryldecode\Cart\Facades\CartFacade as Cart; //lib carrito
use App\Models\Denomination;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleDetails;
use Livewire\Component;
use DB;
use Exception;
use App\Traits\CartTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class PosController extends Component
{
    use CartTrait;

    public $total, $itemsQuantity, $efectivo, $change;
    public function mount()
    {
        $this->efectivo = 0;
        $this->change = 0;
        $this->total = Cart::getTotal();
        $this->itemsQuantity = Cart::getTotalQuantity();
    }
    public function render()
    {
        return view('livewire.pos.component', [
            'denominations' => Denomination::orderBy('value', 'desc')->get(),
            'cart' => Cart::getContent()->sortBy('name')
        ])
            ->extends('layouts.theme.app')
            ->section('content');
    }

    public function ACash($value)
    {
        $this->efectivo += ($value == 0 ? $this->total : $value);
        $this->change = ($this->efectivo - $this->total);
    }
    protected $listeners = [
        'scan-code' => 'ScanCode',
        'removeItem' => 'removeItem',
        'clearCart' => 'clearCart',
        'saveSale' => 'saveSale',
        'clearEfecty' => 'clearEfecty',
        'searchProduct' => 'searchProduct',
    ];

    public function ScanCode($barcode, $cant = 1)
    {
        $this->ScanearCode($barcode, $cant);
    }

    public function increaseQty(Product $product, $cant = 1)
    {
       // dd($product);
        $this->IncreaseQuantity($product, $cant);
    }
    public function updateQty(Product $product, $cant = 1)
    {
        if ($cant <= 0)
            $this->removeItem($product->id);
        else
            $this->updateQuantity($product, $cant);
    }
    
    public function decreaseQty($productId)
    {
        $this->decreaseQuantity($productId);
    }
    public function clearCart()
    {
        $this->trashCart();
    }
    public function searchProduct()
    {
        $this->emit('search-product', 'search');
    }

    public function clearEfecty()
    {
        $this->efectivo = 0;
        $this->change = 0;
        $this->emit('clear-efecty', 'Efectivo y Cambio Vacio');
    }

    public function saveSale()
    {
        if ($this->total <= 0) {
            $this->emit('sale-error', 'Agrega Productos a la Venta');
            return;
        }
        if ($this->efectivo <= 0) {
            $this->emit('sale-error', 'Ingrese el Efectivo');
            return;
        }
        if ($this->total > $this->efectivo) {
            $this->emit('sale-error', 'El Efectivo Debe ser Mayor o Igual al Total');
            return;
        }
        DB::beginTransaction();
        try {
            $sale = Sale::create([
                'total' => $this->total,
                'items' => $this->itemsQuantity,
                'cash' => $this->efectivo,
                'change' => $this->change,
                'user_id' => Auth()->user()->id
            ]);

            if ($sale) {
                $items = Cart::getContent();
                foreach ($items as $item) {
                    SaleDetails::create([
                        'price' => $item->price,
                        'quantity' => $item->quantity,
                        'product_id' => $item->id,
                        'sale_id' => $sale->id,
                    ]);
                    $product = Product::find($item->id);
                    $product->stock = $product->stock - $item->quantity;
                    $product->save();
                }
            }

            DB::commit();
            Cart::clear();
            $this->efectivo = 0;
            $this->change = 0;
            $this->total = Cart::getTotal();
            $this->itemsQuantity = Cart::getTotalQuantity();
            $this->emit('sale-ok', 'Venta Registrada Con Éxito');
            $this->emit('print-ticket', $sale->id);
        } catch (Exception $e) {
            DB::rollback();
            $this->emit('sale-error', $e->getMessage());
        }
    }

    public function printTicket($sale)
    {
        return Redirect::to("print://$sale->id");
    }
}
