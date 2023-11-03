<x-app-layout>
    <x-slot name="header">
        <x-header />
    </x-slot>

    <div class="p-4">
    @for ($j = 0 ; $j < 3 ; $j++)
        <div class="p-2">
            <span class="font-bold text-lg"> Version 1.3.2 - {{ now() }}</span>
            <div class=" ml-2 font-bold">
                <span>New</span>
                @for ($k = 0 ; $k < 5 ; $k++)
                <div class="ml-4 font-normal">
                    <span>- added a field to selectoradded a field to selectoradded a field to selectoradded a field to selectoradded a field to selectoradded a field to selectoradded a field to selectoradded a field to selectoradded</span>
                </div>
                @endfor
            </div>

            <div class=" ml-2 font-bold">
                <span>Improved</span>
                @for ($k = 0 ; $k < 3 ; $k++)
                <div class="ml-4 font-normal">
                    <span>- added a field to selector</span>
                </div>
                @endfor
            </div>

            <div class=" ml-2 font-bold">
                <span>Fixed</span>
                @for ($k = 0 ; $k < 4 ; $k++)
                <div class="ml-4 font-normal">
                    <span>- added a field to selector</span>
                </div>
                @endfor
            </div>

        </div>
        @endfor
    </div>





</x-app-layout>