<div>
    <div class=" px-4 py-4 border-4 rounded-lg border-red-500">
        <div class="mt-2 flex justify-center">
            <div class="text-red-600 font-extrabold text-4xl md:text-5xl">Customizable Product Preview</div>
        </div>
        <div class="mt-6 flex justify-center">
            <img src="squarelogo (1).png" alt="P Graham Dunn.">
        </div>
    </div>
    
    <x-spark.devinfo>
    <x-spark.input wire:model="sku" class="h-8"></x-spark.input>
        <x-spark.input wire:model="source" class="h-8" value="{{ $source }}"></x-spark.input>
        <ul>
            <li><a href="http://127.0.0.1:8000" class="m-2 font-bold text-gray-700 hover:underline hover:text-blue-700">base url</a></li>
            <li><a href="http://127.0.0.1:8000/preview" class="m-2 font-bold text-gray-700 hover:underline hover:text-blue-700">base preview url</a></li>
            <li><a href="http://127.0.0.1:8000/preview/?source={{ $source }}" class="m-2 font-bold text-gray-700 hover:underline hover:text-blue-700">source</a></li>
            <li><a href="http://127.0.0.1:8000/preview/?sku={{ $sku }}&source={{ $source }}" class="m-2 font-bold text-gray-700 hover:underline hover:text-blue-700">sku source</a></li>
            <li><a href="http://127.0.0.1:8000/preview/?sku={{ $sku }}" class="m-2 font-bold text-gray-700 hover:underline hover:text-blue-700">sku</a></li>
            <li><a href="http://127.0.0.1:8000/dashboard?dashboard_key=ZDTXRVK" class="m-2 font-bold text-gray-700 hover:underline hover:text-blue-700">Dashboard</a></li>

        </ul>
        <a href="{{ route('verify.sku') }}">
        <x-spark.button-main>Verify SKU</x-spark.button-main>
    </a>
    </x-spark.devinfo>
</div>