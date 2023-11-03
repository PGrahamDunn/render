<div> 
    <div>
        <a href="{{ $menu_link }}">
        <div class="py-2 px-2 flex justify-between hover:bg-gray-800/30 hover:text-white rounded-md m-2">
            <div class="flex space-x-2 items-center"> 
                <div> 
                    <img class="w-6 h-6 text-gray-400" src={{$menu_icon}} alt="icon"></img>
                </div>
                <div> 
                    <span class="text-md ">{{ $menu_text }}</span>
                </div>
            </div>
            <div class="flex space-x-1 items-center"> 
                <div class="w-8"> 
                    @if ($menu_pill > 0)
                    <span class="inline-flex px-2 text-xs font-semibold leading-5 text-gray-800 bg-gray-200 rounded-full border border-gray-400"> {{ $menu_pill }} </span>
                    @else
                    <div class="rounded-full px-2 w-6 h-6"></div>
                    @endif
                </div>
                <div> 
                    <div class="w-6 h-6"></div>
                </div>
            </div>
        </div>
        </a>
    </div>

</div>