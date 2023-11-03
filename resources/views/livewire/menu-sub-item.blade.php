<div> <!-- menu item container -->
    <div>
        <div class="py-2 px-2 flex justify-between hover:bg-gray-800/30 hover:text-white rounded-md m-2" wire:click="menu_open"> <!-- hover boarder -->
            <div class="flex space-x-2 items-center"> <!-- left container -->
                <div> <!-- menu icon -->
                    <img class="w-6 h-6 text-gray-400" src={{$menu_icon}} alt="icon"></img>
                </div>
                <div> <!-- menu item -->
                    <span class="text-md text-gray-300">{{ $menu_texts[0] }}</span>
                </div>
            </div>
            <div class="flex space-x-1 items-center"> <!-- right container -->
                <div class="w-8"> <!-- badge -->
                    @if ($menu_pills[0] > 0)
                    <span class="inline-flex px-2 text-xs font-semibold leading-5 text-gray-800 bg-gray-200 rounded-full border border-gray-400"> {{ $menu_pills[0] }} </span>
                    @else
                    <div class="rounded-full px-2 w-6 h-6"></div>
                    @endif
                </div>
                <div> <!-- chevron -->
                    <img class="w-6 h-6 text-gray-400 " alt="icon" src={{ $menu_expanded ?  $menu_expanded_icon : $menu_collapsed_icon }}></img>
                </div>
            </div>
        </div>
    </div>
    <!-- sub menu -->
    @if ($menu_expanded)
    @foreach ($menu_texts as $menutext)
    @if (!$loop->first)
    <div class="bg-gray-600/60 px-2 py-1">
        <a href="{{ $menu_links[$loop->index] }}">
            <div class="py-2 px-2 flex justify-between hover:bg-gray-800/30 hover:text-white rounded-md"> <!-- hover boarder -->
                <div class="flex space-x-2 items-center"> <!-- left container -->
                    <div> <!-- menu icon -->
                        <div class="w-6 h-6"></div>
                    </div>
                    <div> <!-- menu item -->
                        <span class="text-md ">{{ $menutext }}</span>
                    </div>
                </div>
                <div class="flex space-x-1 items-center"> <!-- right container -->
                    <div class="w-8"> <!-- badge -->
                        @if ($menu_pills[$loop->index] > 0)
                        <span class="inline-flex px-2 text-xs font-semibold leading-5 text-gray-800 bg-gray-200 rounded-full border border-gray-400"> {{ $menu_pills[$loop->index] }} </span>
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
    @endif
    @endforeach
    @endif
</div>