<div>
    <x-spark.devinfo>
        <div>sku = {{ strlen(trim($query_sku)) ? trim($query_sku) : "[none]" }}</div>
        <div>source = {{ strlen(trim($query_source)) ? trim($query_source) : "[none]" }}</div>
    </x-spark.devinfo>
    <div class="grid grid-cols-1 2xl:grid-cols-2 gap-4">

        <div class="border border-gray-300 bg-white col-span-1 rounded-md">
            <div class="p-2 bg-gray-600 rowspan-2 rounded-t-md border-b border-gray-300 text-white">
                <div class="flex space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-7 h-7">
                        <path fill-rule="evenodd" d="M11.078 2.25c-.917 0-1.699.663-1.85 1.567L9.05 4.889c-.02.12-.115.26-.297.348a7.493 7.493 0 0 0-.986.57c-.166.115-.334.126-.45.083L6.3 5.508a1.875 1.875 0 0 0-2.282.819l-.922 1.597a1.875 1.875 0 0 0 .432 2.385l.84.692c.095.078.17.229.154.43a7.598 7.598 0 0 0 0 1.139c.015.2-.059.352-.153.43l-.841.692a1.875 1.875 0 0 0-.432 2.385l.922 1.597a1.875 1.875 0 0 0 2.282.818l1.019-.382c.115-.043.283-.031.45.082.312.214.641.405.985.57.182.088.277.228.297.35l.178 1.071c.151.904.933 1.567 1.85 1.567h1.844c.916 0 1.699-.663 1.85-1.567l.178-1.072c.02-.12.114-.26.297-.349.344-.165.673-.356.985-.57.167-.114.335-.125.45-.082l1.02.382a1.875 1.875 0 0 0 2.28-.819l.923-1.597a1.875 1.875 0 0 0-.432-2.385l-.84-.692c-.095-.078-.17-.229-.154-.43a7.614 7.614 0 0 0 0-1.139c-.016-.2.059-.352.153-.43l.84-.692c.708-.582.891-1.59.433-2.385l-.922-1.597a1.875 1.875 0 0 0-2.282-.818l-1.02.382c-.114.043-.282.031-.449-.083a7.49 7.49 0 0 0-.985-.57c-.183-.087-.277-.227-.297-.348l-.179-1.072a1.875 1.875 0 0 0-1.85-1.567h-1.843ZM12 15.75a3.75 3.75 0 1 0 0-7.5 3.75 3.75 0 0 0 0 7.5Z" clip-rule="evenodd" />
                    </svg>
                    <span class="text-xl">Template</span>
                </div>
            </div>
            @if($show_message)
            <div class="m-2 bg-red-100 pl-3 py-0.5 border border-red-300 text-red-800 rounded-sm">{{ $status_message }}</div>
            @endif
            <!-- template -->
            <div class="p-2 space-y-6 mx-2 divide-y divide-gray-300">
                <!-- choose it -->
                @if ((config('app.c2_preview_env') == 'web'))
                <div class="space-y-3">
                    <div class="flex space-x-2 items-center justify-between">
                        <div class="mt-4"><span class="pl-3 font-bold text-lg">Choose.</span><span class="pl-8 text-sm">SKU:</span><span class="pl-3">{{ $template_name }}</span></div>
                        {{--
                        <div role="status" wire:loading wire:target="choose_it">
                            <x-spark.spinner class="w-8 h-8"></x-spark.spinner>
                        </div>
                        <x-spark.button-main wire:click="choose_it" :disabled="!$choose_it_enabled" class="mt-4">Choose</x-spark.button-main>
                        --}}
                    </div>
                </div>
                @endif
                <!-- select it -->
                @if (config('app.c2_preview_env') == 'local')
                <div class="space-y-3">
                    <div class="mt-2"><span class="pl-3 font-bold text-lg">Select.</span><span class="pl-8 text-sm">Enter the SKU or the template name to preview.</span></div>
                    <div class="ml-14 flex space-x-2 items-center justify-between">
                        <x-spark.input wire:model="template_name" :disabled="!$select_it_enabled" id="template_name" name="template_name" value="{{ $template_name }}" type="text" class="h-8" />
                        <div role="status" wire:loading wire:target="select_it">
                            <x-spark.spinner class="w-8 h-8"></x-spark.spinner>
                        </div>
                        <x-spark.button-main wire:click="select_it" :disabled="!$select_it_enabled">Select</x-spark.button-main>
                    </div>
                </div>
                @endif
                <!-- personalize it -->
                <div class="space-y-3">
                    <div class="mt-4"></span><span class="pl-3 font-bold text-lg">Personalize.</span><span class="pl-8 text-sm">Enter or select personalizations for this template.</span></div>
                    <!-- Line 1 -->
                    <div class="ml-14 flex items-center space-x-3 {{ $element_line_1_enabled ? 'block' : 'hidden' }}">
                        <x-spark.label for="element_line_1" value="Line 1" />
                        <x-spark.input wire:model="element_line_1" id="element_line_1" name="element_line_1" value="{{ $element_line_1 }}" type="text" :disabled="!$personalize_it_enabled" placeholder="{{ $element_line_1_placeholder }}" class="h-8 placeholder-zinc-400" />
                    </div>
                    <!-- Line 2 -->
                    <div class="ml-14 flex items-center space-x-3 {{ $element_line_2_enabled ? 'block' : 'hidden' }}">
                        <x-spark.label for="element_line_2" value="Line 2" />
                        <x-spark.input wire:model="element_line_2" id="element_line_2" name="element_line_2" value="{{ $element_line_2 }}" type="text" :disabled="!$personalize_it_enabled" placeholder="{{ $element_line_2_placeholder }}" class="h-8 placeholder-zinc-400" />
                    </div>
                    <!-- Line 3 -->
                    <div class="ml-14 flex items-center space-x-3 {{ $element_line_3_enabled ? 'block' : 'hidden' }}">
                        <x-spark.label for="element_line_3" value="Line 3" />
                        <x-spark.input wire:model="element_line_3" id="element_line_3" name="element_line_3" value="{{ $element_line_3 }}" type="text" :disabled="!$personalize_it_enabled" placeholder="{{ $element_line_3_placeholder }}" class="h-8 placeholder-zinc-400" />
                    </div>
                    <!-- Line map coordinates -->
                    <div class="ml-14 flex items-center space-x-3 {{ $element_map_coordinates_enabled ? 'block' : 'hidden' }}">
                        <x-spark.label for="element_map_coordinates" value="Map Coordinates" />
                        <x-spark.input wire:model="element_map_coordinates" id="element_map_coordinates" name="element_map_coordinates" value="{{ $element_map_coordinates }}" type="text" :disabled="!$personalize_it_enabled" class="h-8 placeholder-zinc-400" />
                        <a href="{{ route('map') }}" target="_blank"><x-spark.button-main class="h-8">Get coordinates</x-spark.button-main></a>
                    </div>
                    <!-- Line mascot -->
                    <div class="ml-14 flex items-center space-x-3 {{ ($element_mascot_enabled and !$element_map_coordinates_enabled) ? 'block' : 'hidden' }}">
                        <x-spark.label for="element_mascot" value="Mascot" />
                        {{--<x-text-input wire:model="element_mascot" id="element_mascot" name="element_mascot" type="text" class="h-8 block w-72 sm:text-sm sm:leading-6" />--}}
                        <x-spark.select wire:model="element_mascot" id="element_mascot" name="element_mascot" class=" h-8">
                            <option value="-1" selected>none</option>
                            @foreach ($local_template->c2elements as $c2element)
                            @if (strtolower($c2element->name) == 'mascot')
                            @foreach ($c2element->c2designs as $mascot)
                            <option value="{{ $mascot->name }}">{{ str_replace('-','',str_replace($template_name,'', $mascot->name)) }}</option>
                            @endforeach
                            @endif
                            @endforeach
                        </x-spark.select>
                    </div>
                    <div class="flex justify-end">
                        <x-spark.button-main wire:click="personalize_it" :disabled="!$personalize_it_enabled" class="h-9">Personalize</x-spark.button-main>
                    </div>
                    @if(strlen($personalization_string) > 2)
                    <x-spark.devinfo>
                        {{ $personalization_string }}
                    </x-spark.devinfo>
                    @endif
                </div>
                {{--
                <!-- render it -->
                <div class="space-y-3">
                    <div class="mt-4"><span class="pl-3 font-bold text-lg">Render.</span><span class="pl-8 text-sm">Render and display the preview image from Pulse.</span></div>
                    <div class="flex justify-end">
                        <x-spark.button-main wire:click="render_it" :disabled="!$render_it_enabled">Render</x-spark.button-main>
                    </div>
                </div>
                --}}
                <!-- download it -->
                @if (config('app.c2_preview_env') == 'local')
                <div class="space-y-3">
                    <div class="mt-4"><span class="pl-3 font-bold text-lg">Download.</span><span class="pl-8 text-sm">Enter the filename and download a PNG file{{-- or copy it to the clipboard--}}.</span></div>
                    <div class="ml-14 flex space-x-2 items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <x-spark.label for="download_file" value="Filename" />
                            <x-spark.input wire:model="download_file_name" id="download_file_name" name="download_file_name" type="text" value="{{ $download_file_name }}" :disabled="!$download_it_enabled" class="h-8" />
                            <span>.png</span>
                        </div>
                        <div class="space-x-2">
                            {{--<x-spark.button-main onclick="copyImgToClipboard('/storage/C2/{{ $template_name }}/{{ $local_file_name }}.png')" :disabled="!$download_it_enabled">Clipboard</x-spark.button-main>--}}
                            <x-spark.button-main wire:click="download_it" :disabled="!$download_it_enabled">Download</x-spark.button-main>
                        </div>
                    </div>
                </div>
                @endif
                <!-- copy it -->
                @if (((strtolower($query_source) == 'zoey') and ($element_map_coordinates_enabled)) or (strtolower($query_source) == 'faire') or (strtolower($query_source) == 'pgd'))
                <div class="space-y-3">
                    <div class="mt-4"><span class="pl-3 font-bold text-lg">Copy.</span><span class="pl-8 text-sm">Copy personalizations for the {{ strtoupper($query_source) }} order form.</span></div>
                    <div class="ml-14 flex justify-between items-center space-x-3">
                        <div class="flex items-center space-x-6">
                            <x-spark.input type="text" id="copy_customization" name="copy_customization" value="{{ $customization_string }}" class="h-8" />
                        </div>
                        <div class="flex justify-end">
                            {{--<x-spark.button-main onclick="copyToClipboard('copy_customization')" class="mb-4" :disabled="!$copy_it_enabled">Copy</x-spark.button-main>
                            <x-spark.button-main wire:click="copyTo" class="mb-4" :disabled="!$copy_it_enabled">Copy</x-spark.button-main>--}}
                            <x-spark.button-main onclick="copyToClipboardByID('copy_customization')" class="mb-4" :disabled="!$copy_it_enabled">Copy</x-spark.button-main>
                        </div>
                    </div>
                    @if(strlen($customization_string) > 2)
                    <x-spark.devinfo>
                        {{ $customization_string }}
                    </x-spark.devinfo>
                    @endif
                </div>
                @endif
                <!-- submit it -->
                @if (config('app.c2_preview_env') == 'local')
                <div class="space-y-3">
                    <div class="mt-4"><span class="pl-3 font-bold text-lg">Submit.</span><span class="pl-8 text-sm">Submit an order to Pulse.</span></div>
                    <div class="ml-14 flex space-x-2 items-center justify-between">
                        <div class="space-x-3">
                            <span>Batch ID:</span>
                            <span>{{ $pulse_batch_id }}</span>
                        </div>
                        <div role="status" wire:loading wire:target="submit_it">
                            <x-spark.spinner class="w-8 h-8"></x-spark.spinner>
                        </div>
                        <x-spark.button-main wire:click="submit_it" class="mb-4" :disabled="!$submit_it_enabled">Submit</x-spark.button-main>
                    </div>
                </div>
                @endif
                <!-- reset it -->
                @if (config('app.c2_preview_env') == 'local')
                <div class="space-y-3">
                    <div class="mt-4"><span class="pl-3 font-bold text-lg">Reset.</span><span class="pl-8 text-sm">Reset the template form.</span></div>
                    <div class="flex justify-end">
                        <x-spark.button-main wire:click="reset_it" class="mb-4">Reset</x-spark.button-main>
                    </div>
                </div>
                @endif
            </div>
        </div>
        <div class="border border-gray-300 bg-white col-span-1 rounded-md">
            <div class="p-2 bg-gray-600  rounded-t-md border-b border-gray-300 text-white">
                <div class="flex space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-7 h-7">
                        <path fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 0 1 2.25-2.25h16.5A2.25 2.25 0 0 1 22.5 6v12a2.25 2.25 0 0 1-2.25 2.25H3.75A2.25 2.25 0 0 1 1.5 18V6ZM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0 0 21 18v-1.94l-2.69-2.689a1.5 1.5 0 0 0-2.12 0l-.88.879.97.97a.75.75 0 1 1-1.06 1.06l-5.16-5.159a1.5 1.5 0 0 0-2.12 0L3 16.061Zm10.125-7.81a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Z" clip-rule="evenodd" />
                    </svg>
                    <span class="text-xl">Preview</span>
                </div>
            </div>
            <!-- preview -->
            <x-spark.devinfo>
                render is set: {{ $render_is_set ? 'true' : 'false' }}
            </x-spark.devinfo>
            @if($render_is_set)
            @if($render_is_available)
            <div class="p-2 space-y-2 mx-2 flex justify-center">
                {{--<img src="storage\C2\{{ $template_name }}\\{{ $local_file_name }}.png" alt="" class="max-w-xl w-full">--}}
                <img src="\storage\C2\{{ $local_file_name }}.png" alt="image not found" class="max-w-xl w-full">
            </div>
            @else
            <div class="flex justify-center">
                <div class="m-8 rounded-lg border-2 border-gray-300 w-96 h-96 bg-gradient-to-r from-gray-100 to-gray-50 flex flex-col justify-center items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-40 text-gray-400">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                    </svg>
                    <div class="text-4xl text-gray-400 font-bold">No image available</div>
                </div>
            </div>
            @endif
            @elseif(1==2)
            <div class="p-2 justify-center">
                <iframe src="http://127.0.0.1:8000/oldmap" frameborder="0" class="w-full h-fit"></iframe>
            </div>
            @else
            <div class="flex justify-center items-center">
                <div class="m-8 rounded-lg border border-gray-300 border-dashed w-96 h-96 bg-gradient-to-r from-gray-100 to-gray-50 flex justify-center items-center">
                    <!-- spinner -->
                    <div role="status" wire:loading wire:target="personalize_it">
                        <x-spark.spinner class="w-24 h-24"></x-spark.spinner>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>

</div>