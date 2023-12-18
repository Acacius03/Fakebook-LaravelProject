@props(['image' => null])
@if ($image)
    <img src="{{ asset('storage/' . $image) }}" loading="lazy">
@else
    <img src="/image/avatar.png" loading="lazy">
@endif
