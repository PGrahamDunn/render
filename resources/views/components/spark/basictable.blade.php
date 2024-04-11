<x-spark.table>
    <x.spark.tablehead>
        <tr>
            <x-spark.tableheader> Col 1 </x-spark.tableheader>
            <x-spark.tableheader> Action </x-spark.tableheader>
        </tr>
    </x.spark.tablehead>
    <x-spark.tablebody>
        @foreach (range(1,3) as $data)
        <tr {{-- wire:key="{{ $date->id }}" --}}>
            <x-spark.tabledata>
                <x-spark.tablevalue>data 1</x-spark.tablevalue>
            </x-spark.tabledata>
            <x-spark.tableaction>
                <x-spark.tableactionvalue>
                    <button wire:click="setKey({{ $loop->index }})">
                        <x-actions.view />
                    </button>
                    <a href="{{ route('users.create', $data) }}">
                        <x-actions.edit />
                    </a>
                    <form action="{{ route('users.create', $data) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <x-actions.delete />
                    </form>
                </x-spark.tableactionvalue>
            </x-spark.tableaction>
            </td>
        </tr>
        @endforeach
    </x-spark.tablebody>
</x-spark.table>
{{--
<x-spark.tablelinks>
{{ $data->links() }}
</x-spark.tablelinks>
--}}