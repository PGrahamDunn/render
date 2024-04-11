@props([
    'pill_color' => 'neutral'
])

@php
$pill_color = [
    'amber' => 'text-amber-800 bg-amber-200 border-amber-400',
    'blue' => 'text-blue-800 bg-blue-200 border-blue-400',
    'cyan' => 'text-cyan-800 bg-cyan-200 border-cyan-400',
    'emerald' => 'text-emerald-800 bg-emerald-200 border-emerald-400',
    'fuchsia' => 'text-fuchsia-800 bg-fuchsia-200 border-fuchsia-400',
    'gray' => 'text-gray-800 bg-gray-200 border-gray-400',
    'green' => 'text-green-800 bg-green-200 border-green-400',
    'indigo' => 'text-indigo-800 bg-indigo-200 border-indigo-400',
    'lime' => 'text-lime-800 bg-lime-200 border-lime-400',
    'neutral' => 'text-neutral-800 bg-neutral-200 border-neutral-400',
    'orange' => 'text-orange-800 bg-orange-200 border-orange-400',
    'pink' => 'text-pink-800 bg-pink-200 border-pink-400',
    'purple' => 'text-purple-800 bg-purple-200 border-purple-400',
    'red' => 'text-red-800 bg-red-200 border-red-400',
    'rose' => 'text-rose-800 bg-rose-200 border-rose-400',
    'sky' => 'text-sky-800 bg-sky-200 border-sky-400',
    'slate' => 'text-slate-800 bg-slate-200 border-slate-400',
    'stone' => 'text-stone-800 bg-stone-200 border-stone-400',
    'teal' => 'text-teal-800 bg-teal-200 border-teal-400',
    'violet' => 'text-violet-800 bg-violet-200 border-violet-400',
    'yellow' => 'text-yellow-800 bg-yellow-200 border-yellow-400',
    'zinc' => 'text-zinc-800 bg-zinc-200 border-zinc-400',
][$pill_color];
@endphp

<span class="inline-flex px-2 text-xs font-semibold leading-5 rounded-full border {{ $pill_color }}"> {{ $slot }} </span>