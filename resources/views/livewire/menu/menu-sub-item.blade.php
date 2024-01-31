<div> <!-- menu item container -->
    <div>
        <div class="py-2 px-2 flex justify-between hover:bg-gray-800/30 hover:text-white rounded-md m-2" wire:click="menu_open"> <!-- hover boarder -->
            <div class="flex space-x-2 items-center"> <!-- left container -->
                <div> <!-- menu icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75" />
                    </svg>
                </div>
                <div> <!-- menu item -->
                    <span class="text-md">{{ $menu_text }}</span>
                </div>
            </div>
            <div class="flex space-x-1 items-center"> <!-- right container -->
                <div class="w-8"> <!-- badge -->
                    @if ($menu_pill > 0)
                    <span class="inline-flex px-2 text-xs font-semibold leading-5 text-gray-800 bg-gray-200 rounded-full border border-gray-400"> {{ $menu_pill }} </span>
                    @else
                    <div class="rounded-full px-2 w-6 h-6"></div>
                    @endif
                </div>
                <div> <!-- chevron -->
                    @if ($menu_expanded)
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                    </svg>
                    @else
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                    </svg>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- sub menu -->
    @if ($menu_expanded)
    @foreach ($menu_sub_texts as $menutext)
    <div class="bg-gray-600/60 px-2 py-1">
        <a href="{{ route($menu_sub_links[$loop->index]) }}">
            <div class="py-2 px-2 flex justify-between hover:bg-gray-800/30 hover:text-white rounded-md"> <!-- hover boarder -->
                <div class="flex space-x-2 items-center"> <!-- left container -->
                    <div> <!-- menu icon -->
                        <div class="w-6 h-6"></div>
                    </div>
                    <div> <!-- menu item -->
                        <span class="text-md">{{ $menutext }}</span>
                    </div>
                </div>
                <div class="flex space-x-1 items-center"> <!-- right container -->
                    <div class="w-8"> <!-- badge -->
                        @if ($menu_sub_pills[$loop->index] > 0)
                        <span class="inline-flex px-2 text-xs font-semibold leading-5 text-gray-800 bg-gray-200 rounded-full border border-gray-400"> {{ $menu_sub_pills[$loop->index] }} </span>
                        @else
                        <div class="rounded-full px-2 w-6 h-6"></div>
                        @endif
                    </div>
                    <div> <!-- chevron -->
                        <div class="w-6 h-6"></div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    @endforeach
    @endif
</div>