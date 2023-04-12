<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    <div class="container m-auto my-24">
        <div class="relative mt-8 overflow-x-auto">

            <div class="flex items-center justify-between mb-3">
                <div class="flex items-center justify-between">
                    <div class="w-2/4">
                        <x-input.migroup wire:model="search" placeholder="Search transaction..." />
                    </div>
                    <p wire:click="$toggle('showFilters')">
                        @if ($showFilters)
                            Hide
                        @endif Advanced Search....
                    </p>
                </div>

                <div>
                    @if (session()->has('message'))
                     <p>{{session('message')}}</p>
                    @endif
                </div>


                <div class="flex items-center space-x-3">

                    <x-dropdown class="px-2 py-2 bg-black">
                        <x-slot name="trigger" >
                            <div class="flex items-center cursor-pointer">
                                <span>Bulk Action</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" >
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                  </svg>
                            </div>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link type="button" wire:click="exportSelected">
                                Export
                            </x-dropdown-link>
                            <x-dropdown-link type="button"  wire:click="deleteSelected">
                                Delete
                            </x-dropdown-link>
                        </x-slot>

                    </x-dropdown>

                    <x-primary-button class="flex items-center text-center bg-indigo-700 hover:bg-indigo-800"
                        wire:click="create">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>

                        New
                    </x-primary-button>
                </div>
            </div>

            <div>
                {{-- @if ($showFilters) --}}
                    <div class="p-6 mb-5 bg-gray-100">
                        <div class="grid grid-cols-2 gap-6 ">
                            <div class="space-y-4">
                                <div>
                                    <label for="status">Status</label>
                                    <select wire:model="filters.status" id="status"
                                        class="flex-1 form-input px-4 block w-full rounded border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:z-10 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                        <option value="" disabled>Select Status...</option>
                                        @foreach (App\Models\Transaction::STATUSES as $value => $label)
                                            <option value="{{ $value }}">{{ $label }}</option>
                                        @endforeach

                                    </select>
                                    @error('editing.status')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <x-input.migroup wire:model.lazy="filters.amount-min" type="text" label="Minimun Amount" placeholder="$ 0.00"/>
                                <x-input.migroup wire:model.lazy="filters.amount-max" type="text" label="Maximum Amount" placeholder="$ 0.00"/>

                            </div>

                            <div>
                                <x-input.migroup wire:model="filters.date-min" type="date" label="Minimun Date" />
                                <x-input.migroup wire:model="filters.date-max" type="date" label="Maximum Date" />

                                <button wire:click="resetFilters" class="bottom-0 right-0 p-4 ">
                                    Reset Filters
                                </button>
                            </div>
                        </div>
                        {{-- @json($filters) --}}
                    </div>
                {{-- @endif --}}
            </div>

@json($selected)
            <table class="w-full text-sm text-left text-gray-500 border rounded shadow dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th>
                            <input type="checkbox" name="" id="" class="ml-2 text-gray-100">
                        </th>
                        <th scope="col" class="px-6 py-3" wire:click="sortBy('title')">
                            Title
                        </th>
                        <th scope="col" class="px-6 py-3" wire:click="sortBy('amount')">
                            Amount
                        </th>
                        <th scope="col" class="px-6 py-3" wire:click="sortBy('status')">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3" wire:click="sortBy('dated')">
                            Date
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transactions as $transaction)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
                            wire:loading.class="opacity-70" wire:key="{{$transaction->id}}">
                            <th>
                                <input type="checkbox" wire:model="selected" value="{{$transaction->id}}" name="" id="" class="ml-2 bg-gray-100">
                            </th>
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $transaction->title }}
                            </th>
                            <td class="px-6 py-4">
                                ${{ $transaction->amount }}USD
                            </td>
                            <td
                                class="px-6 py-4 bg-{{ $transaction->status_color }}-100 text-{{ $transaction->status_color }}-800">
                                {{ $transaction->status }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $transaction->dated_for_humans }}
                            </td>

                            <td class="px-6 py-4 underline" wire:click="edit({{ $transaction->id }})">
                                Edit
                            </td>
                        </tr>

                    @empty
                        <tr class="text-center col-span-full">
                            <td class="mx-auto py-44">
                                No Record Found
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $transactions->links() }}
        </div>
    </div>


    <form wire:submit.prevent="save">
        <x-dialog wire:model.defer="showModalEdit">
            <x-slot name="title">
                @if ($showNew)
                    New Transaction
                @else
                    Edit Transaction
                @endif

            </x-slot>

            <x-slot name="content">
                <x-input.migroup wire:model="editing.title" label="Title" placeholder="title" error="editing.title" />
                <x-input.migroup wire:model="editing.amount" label="Amount" placeholder="amount"
                    error="editing.amount" />
                {{-- <x-input.migroup wire:model="editing.status" label="Status" placeholder="status" error="editing.status" /> --}}

                <select wire:model="editing.status" id=""
                    class="flex-1 form-input px-4 block w-full rounded border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:z-10 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    @foreach (App\Models\Transaction::STATUSES as $value => $label)
                        <option value="{{ $value }}">{{ $label }}</option>
                    @endforeach
                    <option value="hacked">Hacked</option>
                </select>
                @error('editing.status')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror

                <x-input.migroup wire:model="editing.dated" label="Date" placeholder="dated" type="date"
                    error="editing.dated" />
            </x-slot>

            <x-slot name="footer">
                <x-secondary-button class="mr-3" wire:click="$set('showModalEdit', false)">
                    Cancel
                </x-secondary-button>

                <x-primary-button class="bg-indigo-700" type="submit">
                    Save
                </x-primary-button>

            </x-slot>
        </x-dialog>
    </form>


</div>
