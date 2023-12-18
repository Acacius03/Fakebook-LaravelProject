@props(['image' => null, 'id' => 0])
@if ($image)
    <img class="h-full w-full" src="{{ asset('storage/' . $image) }}" loading="lazy">
@else
    @if ($id)
        <img class="h-full w-full" src="https://i.pravatar.cc/300?img={{ $id }}" loading="lazy">
    @else
        <img class="h-full w-full" src="/image/avatar.png" loading="lazy">
    @endif
@endif
