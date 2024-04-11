@props([
    'name' => '(name)',
    'color' => 'gray'
])

@php
$color = [
    'amber' => 'from-amber-600 to-amber-500',
    'blue' => 'from-blue-600 to-blue-500',
    'cyan' => 'from-cyan-600 to-cyan-500',
    'emerald' => 'from-emerald-600 to-emerald-500',
    'fuchsia' => 'from-fuchsia-600 to-fuchsia-500',
    'gray' => 'from-gray-600 to-gray-500',
    'green' => 'from-green-600 to-green-500',
    'indigo' => 'from-indigo-600 to-indigo-500',
    'lime' => 'from-lime-600 to-lime-500',
    'neutral' => 'from-neutral-600 to-neutral-500',
    'orange' => 'from-orange-600 to-orange-500',
    'pink' => 'from-pink-600 to-pink-500',
    'purple' => 'from-purple-600 to-purple-500',
    'red' => 'from-red-600 to-red-500',
    'rose' => 'from-rose-600 to-rose-500',
    'sky' => 'from-sky-600 to-sky-500',
    'slate' => 'from-slate-600 to-slate-500',
    'stone' => 'from-stone-600 to-stone-500',
    'teal' => 'from-teal-600 to-teal-500',
    'violet' => 'from-violet-600 to-violet-500',
    'yellow' => 'from-yellow-600 to-yellow-500',
    'zinc' => 'from-zinc-600 to-zinc-500',
][$color];
@endphp

<div {!! $attributes->merge(['class' => 'border border-gray-300 bg-white col-span-1 rounded-md']) !!}>
    <div class="p-2 bg-gradient-to-r {{ $color }} rounded-t-md border-b border-gray-300 text-white">
        <div class="flex space-x-2">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-7 h-7">
                <path fill-rule="evenodd" d="M11.078 2.25c-.917 0-1.699.663-1.85 1.567L9.05 4.889c-.02.12-.115.26-.297.348a7.493 7.493 0 0 0-.986.57c-.166.115-.334.126-.45.083L6.3 5.508a1.875 1.875 0 0 0-2.282.819l-.922 1.597a1.875 1.875 0 0 0 .432 2.385l.84.692c.095.078.17.229.154.43a7.598 7.598 0 0 0 0 1.139c.015.2-.059.352-.153.43l-.841.692a1.875 1.875 0 0 0-.432 2.385l.922 1.597a1.875 1.875 0 0 0 2.282.818l1.019-.382c.115-.043.283-.031.45.082.312.214.641.405.985.57.182.088.277.228.297.35l.178 1.071c.151.904.933 1.567 1.85 1.567h1.844c.916 0 1.699-.663 1.85-1.567l.178-1.072c.02-.12.114-.26.297-.349.344-.165.673-.356.985-.57.167-.114.335-.125.45-.082l1.02.382a1.875 1.875 0 0 0 2.28-.819l.923-1.597a1.875 1.875 0 0 0-.432-2.385l-.84-.692c-.095-.078-.17-.229-.154-.43a7.614 7.614 0 0 0 0-1.139c-.016-.2.059-.352.153-.43l.84-.692c.708-.582.891-1.59.433-2.385l-.922-1.597a1.875 1.875 0 0 0-2.282-.818l-1.02.382c-.114.043-.282.031-.449-.083a7.49 7.49 0 0 0-.985-.57c-.183-.087-.277-.227-.297-.348l-.179-1.072a1.875 1.875 0 0 0-1.85-1.567h-1.843ZM12 15.75a3.75 3.75 0 1 0 0-7.5 3.75 3.75 0 0 0 0 7.5Z" clip-rule="evenodd" />
            </svg>
            <span class="text-xl">{{ $name }}</span>
        </div>
    </div>
    {{ $slot }}
</div>