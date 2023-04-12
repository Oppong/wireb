@props(['leadingAddOn' => false, 'error'])

<div class="flex rounded-md shadow-sm">

    @if ($leadingAddOn)
        <span
            class="inline-flex items-center px-3 text-gray-500 border border-r-0 border-gray-300 rounded-1-md bg-gray-50 sm:text-sm ">
            {{ $leadingAddOn }}
        </span>
    @endif

    <input {{ $attributes }} type="text" autocomplete="username" required
        class="flex-1 form-input px-4 block w-full rounded border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:z-10 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
        placeholder="Username">
</div>
@if ($error)
        <p class="mt-1 text-sm text-red-600">{{ $error }}</p>
    @endif
