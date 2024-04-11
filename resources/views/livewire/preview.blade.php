<div>
    {{--
    <div class="flex justify-end">
        <a href="{{ route('pulse.render') }}">
    <x-button-main>MapBox test</x-button-main>
    </a>
</div>
--}}
<div class="mb-4 p-2 border-2 border-gray-600 rounded-md">
    <div>sku = {{ $query_sku }}</div>
    <div>select = {{ $query_select }}</div>
    <div>download = {{ $query_download }}</div>
    <div>vendor = {{ $query_vendor }}</div>
</div>
<div class="grid grid-cols-1 2xl:grid-cols-2 gap-4">

    <div class="border border-gray-300 bg-white col-span-1 rounded-md">
        <div class="p-2 bg-gray-600 rowspan-2 rounded-t-md border-b border-gray-300 text-white">
            <div class="flex space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.0" stroke="currentColor" class="w-7 h-7">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                </svg>
                <span class="text-xl">Template</span>
            </div>
        </div>
        @if(strlen($error_message) > 2)
        <div class="m-2 bg-red-100 pl-3 py-0.5 border border-red-300 rounded-sm">{{ $error_message }}</div>
        @endif
        <!-- template -->
        <div class="p-2 space-y-6 mx-2 divide-y">
            <!-- select it -->
            <div class="space-y-3">
                @if($select_it_enabled or $query_select)
                <div class="mt-2"><span class="font-extrabold text-xl border-2 border-gray-300 rounded-md py-1 px-3">1</span><span class="pl-3 font-bold text-lg">Select it.</span><span class="pl-8 text-sm">Enter the SKU or the template name to preview.</span></div>
                <div class="ml-14 flex space-x-2 items-center justify-between">
                    <x-text-input wire:model="template_name" id="template_name" name="template_name" type="text" class="h-8 block w-48 sm:text-sm sm:leading-6" />
                    <x-button-main wire:click="select_it">Select</x-button-main>
                </div>
                @else
                <div class="mt-2"><span class="font-extrabold text-xl border-2 border-gray-300 rounded-md py-1 px-3">1</span><span class="pl-3 font-bold text-lg">Select it.</span></div>
                <div class="ml-14 flex items-center space-x-3">
                    <span class="text-md">SKU:</span>
                    <span id="template_name_dispay" name="template_name_dispay" class="block w-48 sm:leading-6">{{ $template_name }}</span>
                </div>
                @endif
            </div>
            <!-- personalize it -->
            <div class="space-y-3 {{ $personalize_it_enabled ? 'opacity-100' : 'opacity-25' }}">
                <div class="mt-4"><span class="font-extrabold text-xl border-2 border-gray-300 rounded-md py-1 px-3">2</span><span class="pl-3 font-bold text-lg">Personalize it.</span><span class="pl-8 text-sm">Enter or select personalizations for this template.</span></div>

                <!-- Line 1 -->
                <div class="ml-14 flex items-center space-x-3 {{ $element_line_1_enabled ? 'block' : 'hidden' }}">
                    <x-input-label for="element_line_1" value="Line 1" />
                    <x-text-input wire:model="element_line_1" id="element_line_1" name="element_line_1" type="text" class="h-8 block w-72 sm:text-sm sm:leading-6" />
                </div>
                <!-- Line 2 -->
                <div class="ml-14 flex items-center space-x-3 {{ $element_line_2_enabled ? 'block' : 'hidden' }}">
                    <x-input-label for="element_line_2" value="Line 2" />
                    <x-text-input wire:model="element_line_2" id="element_line_2" name="element_line_2" type="text" class="h-8 block w-72 sm:text-sm sm:leading-6" />
                </div>
                <!-- Line 3 -->
                <div class="ml-14 flex items-center space-x-3 {{ $element_line_3_enabled ? 'block' : 'hidden' }}">
                    <x-input-label for="element_line_3" value="Line 3" />
                    <x-text-input wire:model="element_line_3" id="element_line_3" name="element_line_3" type="text" class="h-8 block w-72 sm:text-sm sm:leading-6" />
                </div>
                <!-- Line map coordinates -->
                <div class="ml-14 flex items-center space-x-3 {{ $element_map_coordinates_enabled ? 'block' : 'hidden' }}">
                    <x-input-label for="element_map_coordinates" value="Map Coordinates" />
                    <x-text-input wire:model="element_map_coordinates" id="element_map_coordinates" name="element_map_coordinates" type="text" class="h-8 block w-72 sm:text-sm sm:leading-6" />
                </div>
                <!-- Line mascot -->
                <div class="ml-14 flex items-center space-x-3 {{ $element_mascot_enabled ? 'block' : 'hidden' }}">
                    <x-input-label for="element_mascot" value="Mascot" />
                    {{--<x-text-input wire:model="element_mascot" id="element_mascot" name="element_mascot" type="text" class="h-8 block w-72 sm:text-sm sm:leading-6" />--}}
                    <select wire:model="element_mascot" id="element_mascot" name="element_mascot" class=" h-8 block w-72 rounded-md border-0 py-1 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        <option value="-1" selected>none</option>
                        @isset($mascots)
                        @foreach ($mascots as $mascot)
                        <option value="{{ $mascot->DesignName }}">{{ str_replace('-','',str_replace($template_name,'', $mascot->DesignName)) }}</option>
                        @endforeach
                        @endisset
                    </select>
                </div>
                <div class="flex justify-end">
                    <x-button-main wire:click="personalize_it">Personalize</x-button-main>
                </div>
            </div>
            <!-- render it -->
            <div class="space-y-3 {{ $render_it_enabled ? 'opacity-100' : 'opacity-25' }}">
                <div class="mt-4"><span class="font-extrabold text-xl border-2 border-gray-300 rounded-md py-1 px-3">3</span><span class="pl-3 font-bold text-lg">Render it.</span><span class="pl-8 text-sm">Render and display the preview image from Pulse.</span></div>
                <div class="flex justify-end">
                    <x-button-main wire:click="render_it">Render</x-button-main>
                </div>
            </div>
            <!-- download it -->
            <div class="space-y-3 {{ $download_it_enabled ? 'opacity-100' : 'opacity-25' }}">
            <div class="mt-4"><span class="font-extrabold text-xl border-2 border-gray-300 rounded-md py-1 px-3">4</span><span class="pl-3 font-bold text-lg">Download it.</span><span class="pl-8 text-sm">Enter the filename and download a PNG file or copy it to the clipboard.</span></div>
            <div class="ml-14 flex space-x-2 items-center justify-between">
                <div class="flex items-center space-x-3">
                    <x-input-label for="download_file_name" value="Filename" />
                    <x-text-input wire:model="download_file_name" id="download_file_name" name="download_file_name" type="text" class="h-8 block w-48 sm:text-sm sm:leading-6" />
                    <span>.png</span>
                </div>
                <div class="space-x-2">
                    <x-button-main wire:click="download_it" class="mb-4">Download</x-button-main>
                    <button onclick="copyImgToClipboard('\\storage\\C2\\{{ $template_name }}\\{{ $local_file_name }}.png')" class="inline-flex items-center px-4 py-2 bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-600 focus:bg-gray-600 active:bg-gray-800 focus:outline-none transition ease-in-out duration-150">Clipboard</button>
                </div>
            </div>
        </div>
        <!-- copy it -->
        <div class="space-y-3 {{ $render_it_enabled ? 'opacity-100' : 'opacity-25' }}">
            <div class="mt-4"><span class="font-extrabold text-xl border-2 border-gray-300 rounded-md py-1 px-3">4</span><span class="pl-3 font-bold text-lg">Copy it.</span><span class="pl-8 text-sm">Copy the personilizations for this item.</span></div>
            <div class="ml-14 flex  justify-between items-center space-x-3">
                <div class="flex items-center space-x-6">
                @if(strtolower($query_vendor) == 'zoey')
                <div class="ml-14 ">Zoey</div>
                <div>Map Coordinates</div>
                <x-text-input id="zoey_elements" name="zoey_elements" type="text" class="h-8 block w-72 sm:text-sm sm:leading-6" />
                @elseif(strtolower($query_vendor) == 'faire')
                <div class="ml-14">Faire</div>
                <textarea name="faire_elements" id="faire_elements" cols="50" rows="4"></textarea>
                @else
                <div class="ml-14">Other</div>
                @endif
                </div>
                <div class="flex justify-end">
                    <x-button-main wire:click="render_it" class="mb-4">Copy</x-button-main>
                </div>
            </div>

        </div>
    </div>
</div>
<div class="border border-gray-300 bg-white col-span-1 rounded-md">
    <div class="p-2 bg-gray-600 rowspan-2 rounded-t-md border-b border-gray-300 text-white">
        <div class="flex space-x-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.0" stroke="currentColor" class="w-7 h-7">
                <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
            </svg>
            <span class="text-xl">Preview</span>
        </div>
    </div>
    <!-- preview -->
    @if($render_is_set)
    <div class="p-2 space-y-2 mx-2 flex justify-center">
        <img src="\storage\C2\{{ $template_name }}\\{{ $local_file_name }}.png" alt="" class="max-w-xl w-full">
    </div>
    @else
    <div class="flex justify-center items-center">
        <div class="m-8 rounded-lg border border-gray-300 border-dashed w-96 h-96 bg-gradient-to-r from-gray-100 to-gray-50 flex justify-center items-center">
            <!-- spinner -->
            <div role="status" wire:loading wire:target="render_it">
                <svg aria-hidden="true" class="w-24 h-24 text-gray-200 animate-spin dark:text-gray-600 fill-gray-400" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor" />
                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill" />
                </svg>
                <span class="sr-only">Loading...</span>
            </div>

        </div>
    </div>
    @endif
</div>
</div>
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
            //console.log('Image copied.');
        } catch (err) {
            alert('Image failed to copy.');
            //console.error(err.name, err.message);
        }
    }
</script>
</div>