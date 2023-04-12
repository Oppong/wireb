<div>
    <div>
        <div class="flex items-center justify-center min-h-full px-4 py-12 sm:px-6 lg:px-8">
            <div class="w-full max-w-sm space-y-8">
                <div>

                    <h2 class="mt-6 text-3xl font-bold tracking-tight text-center text-gray-900">Profile Page</h2>
                    <p class="mt-2 text-sm text-center text-gray-600">{{ auth()->user()->name }}</p>
                </div>
                <form wire:submit.prevent="save" class="mt-8 space-y-6">
                    <input type="hidden" name="remember" value="true">
                    <div class="rounded-md shadow-sm">

                        <div>
                            @if ($saved)
                                <div class="flex items-center justify-between px-4 py-3 mb-2 rounded shadow bh-white">
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-4 text-teal-500">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <p class="">Profile saved</p>
                                    </div>

                                    <div class="" wire:click="$set('saved', false)">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="justify-end w-4 h-4"
                                            fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <x-input.group label="Username">
                            <x-input.text wire:model.defer="username" id="username" :error="$errors->first('username')" leading-add-on="kofi.com"/>
                        </x-input.group>

                        <x-input.migroup wire:model="username" label="name" placeholder="Enter name hear" helper-text="The name of the person"  error="username"/>
                        <x-input.migroup wire:model="birthday" label="Birthday" error="birthday" type="date" placeholder="MM/DD/YYYY"/>

                        <div class="mb-5">
                            <label for="about" class="sr-only ">About</label>
                            <textarea wire:model.defer="about" name="about" id="" cols="30" rows="10"
                                class="relative px-4 block w-full rounded border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:z-10 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                            @error('about')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>


                    <div>
                        <button type="submit"
                            class="relative flex justify-center w-full px-3 py-2 text-sm font-semibold text-white bg-indigo-600 rounded-md group hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                <svg class="w-5 h-5 text-indigo-500 group-hover:text-indigo-400" viewBox="0 0 20 20"
                                    fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M10 1a4.5 4.5 0 00-4.5 4.5V9H5a2 2 0 00-2 2v6a2 2 0 002 2h10a2 2 0 002-2v-6a2 2 0 00-2-2h-.5V5.5A4.5 4.5 0 0010 1zm3 8V5.5a3 3 0 10-6 0V9h6z"
                                        clip-rule="evenodd" />
                                </svg>
                            </span>
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
