@props(['cardTitle'])

<div {{ $attributes->merge(['id' => '','name' => '','class' => '']) }}>
    {{ $slot }}
</div>
