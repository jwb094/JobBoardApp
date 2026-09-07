@props(['cardTitle'])

<div {{ $attributes->merge(['id' => '','name' => '','class' => '']) }}>
    <span class="inline-flex items-center bg-brand-softer text-fg-brand-strong text-xs font-medium  py-0.5 rounded-sm">
        <h4 class="text-heading text-3xl font-semobild my-4"> {{ $cardTitle }}</h4>
    </span>
    {{ $slot }}

</div>
