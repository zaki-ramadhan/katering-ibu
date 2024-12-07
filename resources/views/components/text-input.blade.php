@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'p-3 border border-gray-200 bg-gray-100 rounded-md']) }}>
