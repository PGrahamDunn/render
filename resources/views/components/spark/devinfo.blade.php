@if(config('app.env') == 'local')
<div class="border border-gray-300 bg-gray-100 p-2 m-1 rounded-md text-xs font-mono">
{{ $slot }}
</div>
@endif