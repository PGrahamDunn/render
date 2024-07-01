<div>
    <div class="pl-4 py-3 bg-gradient-to-r from-fuchsia-600 to-purple-400 rounded-md text-white uppercase">Dashboard</div>
    <div class="mt-3 grid grid-cols-3 gap-3">
        <x-spark.container1 name="Stats" color="gray">
            <div class="m-2 space-y-3">
            </div>
        </x-spark.container1>
        <x-spark.container1 name="Items" color="gray">
            <div class="m-2 space-y-3">
            </div>
        </x-spark.container1>
        <x-spark.container1 name="Admin" color="gray">

            <div class="m-2 space-y-3">
                <div>
                    <a href="{{route('seed.database') }}">
                        <x-spark.button-main>Seed database</x-spark.button-main>
                    </a>
                </div>
                <x-spark.button-main wire:click="clean_previews">Clean up previews</x-spark.button-main>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-spark.button-main>Logout</x-spark.button-main>
                </form>
            </div>
        </x-spark.container1>
    </div>

</div>