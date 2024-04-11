<x-web-layout>
  <div class="p-2 m-2">
    @livewire('preview',['query_sku' => $query_sku, 'query_select' => $query_select, 'query_download' => $query_download, 'query_vendor' => $query_vendor, 'request_host' => $request_host])
  </div>
</x-web-layout>