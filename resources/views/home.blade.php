<x-web-layout>
  <div class="p-2 m-2">
    {{-- @livewire('home') --}}
    script test
  </div>
  <input id="div1" onclick="copyToClipboard2('div1')" value="abc">
  <input id="div2" onclick="copyToClipboardByID2()" value="def">
  <script>
        function copyToClipboard2(id) {
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
        function copyToClipboardByID2() {
            try {

                var coordinatesField = document.getElementById('div2');
                coordinatesField.select();
                document.execCommand('copy');
                alert('Personilization copied to clipboard.');
            } catch (err) {
                alert(err.message);
            }
        }
    </script>
</x-web-layout>