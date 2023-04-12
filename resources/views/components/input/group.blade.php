@props([
    'label',
    'error',
    'name',

])

<div class="mb-5">
    <label for="{{strtolower($label)}}" class="font-bold">{{$label}}</label>
    <div>
        {{$slot}}
    </div>
    {{-- @error('username')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror --}}
</div>
