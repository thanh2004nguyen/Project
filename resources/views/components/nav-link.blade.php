@props(['active'])

@php
    $classes = $active ?? false ? 'd-inline-flex align-items-center  border-bottom border-3 border-primary fw-bold nav-link active' : 'd-inline-flex align-items-center   nav-link border-bottom border-3';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
