<x-web-layout>
  <div class="p-2 m-2">
    @livewire('preview',['query_sku' => $query_sku, 'query_source' => $query_source])
    
    <script>
        async function copyImgToClipboard(imgUrl) {
            try {
                const data = await fetch(imgUrl);
                const blob = await data.blob();
                await navigator.clipboard.write([
                    new ClipboardItem({
                        [blob.type]: blob,
                    }),
                ]);
                alert('Image copied to clipboard.');
                //console.log('Image copied.');
            } catch (err) {
                alert('Image failed to copy.');
                //console.error(err.name, err.message);
            }
        }
    </script>

    <script>
        function copyToClipboard(id) {
            try {
                var copy_field = document.getElementById(id);
                copy_field.select();
                //document.execCommand('copy');
                navigator.clipboard.writeText(copy_field.value);
                alert('Personilization copied to clipboard.');
            } catch (err) {
                alert(err.message);
            }
        }
    </script>

    <script>
        function copyToClipboardByID(id) {
            try {

                var copy_field = document.getElementById(id);
                copy_field.select();
                document.execCommand('copy');
                alert(copy_field.value);
                alert('Personilization copied to clipboard.');
            } catch (err) {
                alert(err.message);
            }
        }
    </script>
  </div>
</x-web-layout>