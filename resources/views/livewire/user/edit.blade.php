<div>
    @if ($openEdit)
        <div
            class="fixed top-0 bottom-0 left-0 right-0 z-50 items-center justify-center p-3 overflow-y-auto bg-gray-900 lg:flex bg-opacity-70 backdrop-blur-sm">
            <div class="w-full overflow-hidden bg-white rounded-md shadow-sm lg:w-6/12">
                <div class="px-5 pb-5">
                    <div class="grid grid-cols-1 mt-4 lg:gap-4 lg:grid-cols-2">
                        <div class="overflow-hidden rounded-md">
                            @if (!empty($profile_photo_url) && file_exists($profile_photo_url))
                                <figure class="relative">
                                    <button wire:click="deleteProfilePhoto" type="button"
                                        class="absolute flex items-center justify-center w-8 h-8 text-gray-100 hover:text-red-600 top-2 right-2">
                                        <svg class="h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                            fill="currentColor">
                                            <path
                                                d="M7 21q-.825 0-1.412-.587Q5 19.825 5 19V6H4V4h5V3h6v1h5v2h-1v13q0 .825-.587 1.413Q17.825 21 17 21ZM17 6H7v13h10ZM9 17h2V8H9Zm4 0h2V8h-2ZM7 6v13Z" />
                                        </svg>
                                    </button>
                                    <img src="{{ asset($profile_photo_url) }}" alt="Foto {{ $name }}"
                                        title="Foto {{ $name }}" class="block w-full" />
                                </figure>
                            @elseif (!empty($tempProfilePhoto))
                                <figure class="relative">
                                    <button wire:click="removeTempProfilePhoto" type="button"
                                        class="absolute flex items-center justify-center w-8 h-8 text-gray-100 hover:text-red-600 top-2 right-2">
                                        <svg class="h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                            fill="currentColor">
                                            <path
                                                d="M7 21q-.825 0-1.412-.587Q5 19.825 5 19V6H4V4h5V3h6v1h5v2h-1v13q0 .825-.587 1.413Q17.825 21 17 21ZM17 6H7v13h10ZM9 17h2V8H9Zm4 0h2V8h-2ZM7 6v13Z" />
                                        </svg>
                                    </button>
                                    <img src="{{ $tempProfilePhoto->temporaryUrl() }}" class="block w-full" />
                                </figure>
                            @else
                                <label for="dropzone-file"
                                    class="flex flex-col items-center justify-center w-full h-full border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 ">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <svg class="w-10 h-10 mb-3 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                            </path>
                                        </svg>
                                        <p class="text-xs text-center text-gray-500">PNG, JPG <br />
                                            (MAX 243x243 px)</p>
                                    </div>
                                    <input wire:model="tempProfilePhoto" id="dropzone-file" type="file"
                                        class="hidden" />
                                </label>
                                <div wire:loading wire:target="tempProfilePhoto" class="mt-3 text-green-500 pulse">
                                    Uploading...
                                </div>
                            @endif
                        </div>
                        <div class="">
                            <div class="py-3">
                                <x:component::form.label value="Name" />
                                <x:component::form.input wire:model="name" type="text" name="name" />
                                <x:component::form.input-error :for="$name" />
                            </div>

                            <div class="py-3">
                                <x:component::form.label value="E-Mail-Adresse" />
                                <x:component::form.input wire:model="email" type="email" name="email" />
                                <x:component::form.input-error :for="$email" />
                            </div>

                            <div class="py-3">
                                <x:component::form.label value="Neues Passwort" />
                                <x:component::form.input wire:model="password" type="text" name="password" />
                                <x:component::form.input-error :for="$password" />
                            </div>
                        </div>
                    </div>

                </div>
                <div class="grid grid-cols-2 gap-4 px-4 text-right bg-gray-100 py-7 sm:px-6">
                    <x:component::button.cancel wire:click="cloasEditWindow" />

                    <button wire:click="update" type="button"
                        class="flex justify-center w-full px-4 py-2 font-medium text-center text-white bg-green-500 border border-transparent rounded-md shadow-sm hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">Speichern</button>
                </div>
            </div>
        </div>
    @endif
</div>
