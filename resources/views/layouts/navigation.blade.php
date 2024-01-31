<div class="bg-gray-700 text-gray-100 w-64 space-y-6">
    <div class="flex flex-col">
        <div>
            <!-- logo -->
            <div class="h-18  border-b border-gray-600">
                @if (App::environment('production'))
                <div class="p-2 bg-gradient-to-r from-gray-600 to-zinc-500 m-2 rounded-md">
                    @elseif (config('app.env') =='staging')
                    <div class="p-2 bg-gradient-to-r from-blue-600 to-sky-500 m-2 rounded-md flex justify-between">
                        @elseif (config('app.env') =='local')
                        <div class="p-2 bg-gradient-to-r from-green-600 to-lime-500 m-2 rounded-md flex justify-between">
                            @else
                            <div class="p-2 bg-gradient-to-r from-amber-600 to-yellow-500 m-2 rounded-md flex justify-between">
                                @endif
                                <a class="flex items-center space-x-2" href="">
                                    <x-application-icon class="text-white h-8 w-8" />
                                    <span class="truncate text-2xl">{{ config('app.name') }}</span>
                                </a>
                                @if (!App::environment('production'))
                                <span class=" border border-white text-xl text-white rounded-md px-2">{{ strtoupper(config('app.pgd_env')) }}</span>
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