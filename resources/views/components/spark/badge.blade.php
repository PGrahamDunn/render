@props([
    'badge_color' => 'neutral'
])

@php
$badge_color = [
    'amber' => 'text-amber-700 bg-amber-50 ring-amber-600/20',
    'blue' => 'text-blue-700 bg-blue-50 ring-blue-600/20',
    'cyan' => 'text-cyan-700 bg-cyan-50 ring-cyan-600/20',
    'emerald' => 'text-emerald-700 bg-emerald-50 ring-emerald-600/20',
    'fuchsia' => 'text-fuchsia-700 bg-fuchsia-50 ring-fuchsia-600/20',
    'gray' => 'text-gray-700 bg-gray-50 ring-gray-600/20',
    'green' => 'text-green-700 bg-green-50 ring-green-600/20',
    'indigo' => 'text-indigo-700 bg-indigo-50 ring-indigo-600/20',
    'lime' => 'text-lime-700 bg-lime-50 ring-lime-600/20',
    'neutral' => 'text-neutral-700 bg-neutral-50 ring-neutral-600/20',
    'orange' => 'text-orange-700 bg-orange-50 ring-orange-600/20',
    'pink' => 'text-pink-700 bg-pink-50 ring-pink-600/20',
    'purple' => 'text-purple-700 bg-purple-50 ring-purple-600/20',
    'red' => 'text-red-700 bg-red-50 ring-red-600/20',
    'rose' => 'text-rose-700 bg-rose-50 ring-rose-600/20',
    'sky' => 'text-sky-700 bg-sky-50 ring-sky-600/20',
    'slate' => 'text-slate-700 bg-slate-50 ring-slate-600/20',
    'stone' => 'text-stone-700 bg-stone-50 ring-stone-600/20',
    'teal' => 'text-teal-700 bg-teal-50 ring-teal-600/20',
    'violet' => 'text-violet-700 bg-violet-50 ring-violet-600/20',
    'yellow' => 'text-yellow-700 bg-yellow-50 ring-yellow-600/20',
    'zinc' => 'text-zinc-700 bg-zinc-50 ring-zinc-600/20',
][$badge_color];
@endphp

<span class="inline-flex items-center rounded-md px-2 py-1 text-xs font-medium ring-1 ring-inset {{ $badge_color }}">{{ $slot }}</span>