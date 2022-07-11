<script>
try {
    onScan.attachTo(document, {
        suffixkeyCodes: [13],
        onScan: function(barcode) {
            console.Log(barcode)
            window.livewire.emit('scan-code', barcode)

        },
        onScanError: function(e){
            console.log(e)
        }
    })
    console.log('Scanner ready!')
} catch (e) {
    console.log('Error de Lectura!',e)
}
</script>
