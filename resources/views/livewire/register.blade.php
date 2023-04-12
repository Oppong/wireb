<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}


    <div class="flex min-h-full items-center justify-center px-4 py-12 sm:px-6 lg:px-8">
        <div class="w-full max-w-sm space-y-8">
            <div>

                <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">Register</h2>
                <p class="mt-2 text-center text-sm text-gray-600"></p>
            </div>
            <form wire:submit.prevent="register"  class="mt-8 space-y-6" method="POST">
                <input type="hidden" name="remember" value="true">
                <div class="rounded-md shadow-sm">
                    <div class="mb-5">
                        <label for="name" class="sr-only">Full Name</label>
                        <input wire:model="name" id="name"  type="text" autocomplete="name" required
                            class=" px-4 relative block w-full rounded border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:z-10 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            placeholder="Enter Full Name">
                        @error('name')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-5">
                        <label for="email" class="sr-only">Email address</label>
                        <input wire:model="email" id="email" type="email" autocomplete="email" required
                            class="relative px-4 block w-full rounded border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:z-10 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            placeholder="Email address">
                        @error('email')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <label for="password" class="sr-only">Password</label>
                        <input wire:model="password" id="password" type="password" autocomplete="current-password" required
                            class="relative px-4 block w-full rounded border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:z-10 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            placeholder="Password">
                        @error('password')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <label for="passwordConfirm" class="sr-only">Password</label>
                        <input wire:model="passwordConfirmation" id="passwordConfirm" type="password" autocomplete="current-password" required
                            class="relative px-4 block w-full rounded border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:z-10 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            placeholder="Password Confirmation">
                        @error('password')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember-me" name="remember-me" type="checkbox"
                            class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
                        <label for="remember-me" class="ml-2 block text-sm text-gray-900">Remember me</label>
                    </div>

                    <div class="text-sm">
                        <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">Forgot your
                            password?</a>
                    </div>
                </div>

                <div>
                    <button type="submit"
                        class="group relative flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <svg class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400" viewBox="0 0 20 20"
                                fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M10 1a4.5 4.5 0 00-4.5 4.5V9H5a2 2 0 00-2 2v6a2 2 0 002 2h10a2 2 0 002-2v-6a2 2 0 00-2-2h-.5V5.5A4.5 4.5 0 0010 1zm3 8V5.5a3 3 0 10-6 0V9h6z"
                                    clip-rule="evenodd" />
                            </svg>
                        </span>
                        Sign in
                    </button>
                </div>
            </form>
        </div>
    </div>




    {{-- <form wire:submit.prevent="register" method="post">
    <div class="mb-5">
        <label for="name">Name</label>
        <input wire:model="name" type="text" name="name" id="name" class="border">
        @error('name')
            {{$message}}
        @enderror
    </div>
    <div class="mb-5">
        <label for="email">Email</label>
        <input wire:model="email" type="email" name="email" id="email" class="border">
        @error('email')
            {{$message}}
        @enderror
    </div>

    <div class="mb-5">
        <label for="password">Password</label>
        <input wire:model.lazy="password" type="password" name="password" id="password" class="border">
        @error('password')
            {{$message}}
        @enderror
    </div>
    <div class="mb-5">
        <label for="passwordconfirm">Confirm Password</label>
        <input wire:model.lazy="passwordConfirmation" type="password" name="passwordConfirmation" id="passwordconfirm" class="border">
    </div>

    <div>
        <input type="submit" value="register" class="border">
    </div>
   </form> --}}
</div>
