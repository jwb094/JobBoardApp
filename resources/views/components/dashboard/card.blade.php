@props(['cardTitle'])

<div {{ $attributes->merge(['id' => '','name' => '','class' => '']) }}>
    <h3 class="dashboard-card__heading">{{ $cardTitle }}</h3>
    {{ $slot }}

</div>
