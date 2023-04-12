<div>
    {{-- In work, do what you enjoy. --}}
    {{-- {{$name}} --}}

    <input type="text" wire:model="name">
    <select wire:model="greeting" id="" multiple>
        <option value="">Hello</option>
        <option value="">Good bye</option>
        <option value="">Not Good yea</option>
    </select>

    <p>{{$plus}}</p>
    {{$name}}

    {{implode(', ', $greeting)}}

    <div class="mt-8">
        <h1>Single checkbox</h1>
        <label for="" class="flex items-center">
            <input type="checkbox" name="" id="">
            Show email on profile
        </label>
    </div>
</div>
