<script>
    var listener = new window.keypress.Listener();

    listener.simple_combo("f9", function() {
        console.log('f9');
        livewire.emit('saveSale');
    })

    listener.simple_combo("f8", function() {
        document.getElementById('cash').value = ''
        document.getElementById('cash').focus()
        document.getElementById('hiddenTotal').value = ''
        livewire.emit('clearEfecty');
    })
    listener.simple_combo("f7", function() {
        document.getElementById('code').focus()
        livewire.emit('searchProduct');
    })
    
    listener.simple_combo("f4", function() {
        var total = parseFloat(document.getElementById('hiddenTotal').value)
        if (total > 0) {
            Confirm(0, 'clearCart', '¿SEGUR@ DE ELIMINAR EL CARRITO?')
        } else {
            noty('Agrega Productos a la Venta')
        }
    })
</script>
