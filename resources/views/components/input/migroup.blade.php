@props([
    'label'=>false,
    'type' => 'text',
    'error'=> false,
    'name' => false,
    'placeholder' => false,
    'helperText' => false,
])

<div class="mb-3">
    <label for="{{strtolower($label)}}" class="">{{$label}}</label>
    <input {{ $attributes }} type="{{$type}}" class="flex-1 form-input px-4 block w-full rounded border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:z-10 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
    placeholder="{{$placeholder}}"
    >
      @error($error)
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror

    {{-- helper text --}}
    <p class="text-sm text-gray-500 ">{{$helperText}}</p>
</div>
