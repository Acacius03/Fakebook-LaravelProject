@props(['image' => null])
@if ($image)
    <img src="{{ asset('storage/' . $image) }}">
@else
    <img src="/image/avatar.png">
@endif
