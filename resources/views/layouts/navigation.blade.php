<div class="bg-gray-700 text-gray-100 w-64 space-y-6">
    <div class="flex flex-col">
        <div>
            <!-- logo -->
            <div class="h-18  border-b border-gray-600">
                <div class="p-2 bg-gradient-to-r from-violet-600 to-indigo-400 m-2 rounded-md flex justify-between">
                    <a class="flex items-center space-x-2" href="">
                        <x-application-icon class="text-white h-8 w-8" />
                        <span class="truncate text-2xl">{{ strtoupper(config('app.name')) }}</span>
                    </a>
                    @if (!App::environment('production'))
                    <div class="outline outline-1 outline-black border-2 border-yellow-400 text-xl text-yellow-400 rounded-md px-2 bg-gray-700">{{ strtoupper(config('app.pgd_env')) }}</div>
                    @endif
                </div>
            </div>
            <!-- nav -->
            <div class="">
                <nav>
                    @livewire('menu.dashboard',['menu_pill' => 0])
                    @can('admin')
                    @livewire('menu.admin')
                    @endcan
                    <!--livewire('menu.menu-admin',['menu_pill' => 0,'menu_sub_pills' => [0]])-->
                    <!--livewire('menu.menu-sub-item',['menu_texts' => ['Administration','Users'],'menu_links' => ['#','/users'],'menu_pills' => [0,0],'menu_icon' => '/icons/menu-flag.svg'])-->
                    <!--livewire('menu.menu-item',['menu_pill' => 0, 'menu_text' => 'admin role','menu_link' => '/','menu_icon' => '/icons/menu-flag.svg'])-->
                </nav>
            </div>
        </div>
    </div>
</div>