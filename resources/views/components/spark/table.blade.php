<div {!! $attributes->merge(['class' => 'shadow inline-block min-w-full overflow-hidden align-middle border border-gray-300 sm:rounded-lg mt-4']) !!}>
    <table class="min-w-full divide-y divide-gray-200">
        {{ $slot }}
    </table>
</div>