<div>
    <div>
        <a href="{{ route($menu_link) }}">
            <div class="py-2 px-2 flex justify-between hover:bg-gray-800/30 hover:text-white rounded-md m-2">
                <div class="flex space-x-2 items-center">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                        </svg>
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