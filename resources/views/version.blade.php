<x-app-layout>
    <x-slot name="header">
        <x-header />
    </x-slot>

    @php
        $versionid = -1;
        $typeid = -1;
    @endphp

    <div class="p-4">
    @foreach ($version_notes as $version_note)
        <div>
            @if ($version_note->version_id <> $versionid)
            <div class="mt-4">
            <span class="font-bold text-lg">version {{ $version_note->version->version_number }}  {{ $version_note->version->version_date }}</span>
            </div>
            @php
                $versionid = $version_note->version_id;
            @endphp
            @endif
            <div class=" ml-4 font-bold">
                @if ($version_note->version_type_id <> $typeid)
                <span>{{ $version_note->version_type->name }}</span>
                @php
                    $typeid = $version_note->version_type_id;
                @endphp
                @endif
                <div class="ml-8 font-normal">
                    <span>- {{ $version_note->description }}</span>
                </div>
            </div>
        </div>
    @endforeach
    </div>





</x-app-layout>