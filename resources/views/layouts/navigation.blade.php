<div class="bg-gray-700 text-gray-100 w-64 space-y-6">
    <div class="flex flex-col">
        <div>
            <!-- logo -->
            <div class="h-18  border-b border-gray-600">
            <div class="p-2 {{ env('APP_DEBUG') == 'true' ? 'bg-green-600'  : 'bg-gray-600' }} m-2 rounded-md">
                    <a class="flex items-center space-x-2" href="">
                        <svg class="w-8 h-8 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12.75 15l3-3m0 0l-3-3m3 3h-7.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="text-2xl">{{ env('APP_DEBUG') == 'true' ? env('APP_NAME') . ' - DEV'  : env('APP_NAME') }}</span>
                    </a>
                </div>
            </div>
            <!-- nav -->
            <div class="">
            <nav>
                @livewire('menu.menu-dashboard',['menu_pill' => 0])
                @can('admin')
                    @livewire('menu.menu-admin')
                @endcan
                <!--livewire('menu.menu-admin',['menu_pill' => 0,'menu_sub_pills' => [0]])-->
                <!--livewire('menu.menu-sub-item',['menu_texts' => ['Administration','Users'],'menu_links' => ['#','/users'],'menu_pills' => [0,0],'menu_icon' => '/icons/menu-flag.svg'])-->
                <!--livewire('menu.menu-item',['menu_pill' => 0, 'menu_text' => 'admin role','menu_link' => '/','menu_icon' => '/icons/menu-flag.svg'])-->
            </nav>
            </div>
        </div>
    </div>
</div>