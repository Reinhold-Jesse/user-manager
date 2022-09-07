<div class="">
    <div class="flex flex-col gap-4 mb-12 md:flex-row">
        <div class="relative w-full">
            <x:component::element.search wire:model.debounce.300ms="search" type="text" placeholder="Suche nach User" />
        </div>
        <button wire:click="create" type="button"
            class="flex items-center justify-center w-56 px-5 text-white bg-green-500 border-0 rounded-md shadow-sm hover:text-white hover:bg-green-600 default-transition">
            User erstellen
        </button>
    </div>

    <div class="grid grid-cols-1 gap-4 lg:col-span-2">

        <div class="w-full overflow-hidden">
            <div class="overflow-x-auto shadow md:rounded-lg">
                <div class="">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr class="">
                                <th scope="col"
                                    class="px-3 py-3.5 text-sm font-semibold text-gray-700 text-left pl-6 w-1/12">
                                    Foto
                                </th>

                                <th scope="col"
                                    class="px-3 py-3.5 text-sm font-semibold text-gray-700 text-left pl-6 w-3/12">
                                    Name
                                </th>

                                <th scope="col"
                                    class="px-3 py-3.5 text-sm font-semibold text-gray-700 text-left pl-6 w-3/12">
                                    E-Mail
                                </th>

                                <th scope="col" class="w-2/12"></th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">

                            @foreach ($content as $value)
                                <tr class="hover:bg-gray-50">
                                    <td class="py-4 pl-4 pr-3 text-sm whitespace-nowrap sm:pl-6">
                                        @if (!empty($value->profile_photo_url) && file_exists($value->profile_photo_url))
                                            <img src="{{ asset($value->profile_photo_url) }}" alt="{{ $value->name }}"
                                                title="{{ $value->name }}" class="block max-h-12" />
                                        @endif
                                    </td>

                                    <td class="py-4 pl-4 pr-3 text-sm whitespace-nowrap sm:pl-6">
                                        {{ $value->name }}
                                    </td>

                                    <td class="py-4 pl-4 pr-3 text-sm whitespace-nowrap sm:pl-6">
                                        {{ $value->email }}
                                    </td>


                                    <td
                                        class="flex items-center justify-end gap-2 py-4 pl-3 pr-4 text-sm font-medium text-right whitespace-nowrap sm:pr-6">

                                        @if (Reinholdjesse\Usermanager\UserManagerFeatures::managesUserSwitcher())
                                            <button wire:click="switchUser({{ $value->id }})" type="button"
                                                class="flex items-center justify-center text-green-500 border-2 border-green-500 rounded-md shadow-sm hover:text-white w-9 h-9 hover:bg-green-600 default-transition">

                                                <svg xmlns="http://www.w3.org/2000/svg" height="24" width="24"
                                                    fill="currentColor">
                                                    <path
                                                        d="M1 20v-2.8q0-.85.438-1.563.437-.712 1.162-1.087 1.55-.775 3.15-1.163Q7.35 13 9 13t3.25.387q1.6.388 3.15 1.163.725.375 1.162 1.087Q17 16.35 17 17.2V20Zm18 0v-3q0-1.1-.612-2.113-.613-1.012-1.738-1.737 1.275.15 2.4.512 1.125.363 2.1.888.9.5 1.375 1.112Q23 16.275 23 17v3ZM9 12q-1.65 0-2.825-1.175Q5 9.65 5 8q0-1.65 1.175-2.825Q7.35 4 9 4q1.65 0 2.825 1.175Q13 6.35 13 8q0 1.65-1.175 2.825Q10.65 12 9 12Zm10-4q0 1.65-1.175 2.825Q16.65 12 15 12q-.275 0-.7-.062-.425-.063-.7-.138.675-.8 1.037-1.775Q15 9.05 15 8q0-1.05-.363-2.025Q14.275 5 13.6 4.2q.35-.125.7-.163Q14.65 4 15 4q1.65 0 2.825 1.175Q19 6.35 19 8ZM3 18h12v-.8q0-.275-.137-.5-.138-.225-.363-.35-1.35-.675-2.725-1.013Q10.4 15 9 15t-2.775.337Q4.85 15.675 3.5 16.35q-.225.125-.362.35-.138.225-.138.5Zm6-8q.825 0 1.413-.588Q11 8.825 11 8t-.587-1.412Q9.825 6 9 6q-.825 0-1.412.588Q7 7.175 7 8t.588 1.412Q8.175 10 9 10Zm0 8ZM9 8Z" />
                                                </svg>
                                            </button>
                                        @endif


                                        <x:component::button.edit wire:click.prevent="edit({{ $value->id }})"
                                            type="button" />

                                        <x:component::element.modal>
                                            <x-slot:trigger>
                                                <x:component::button.delete @click.prevent="modal=true"
                                                    type="button" />
                                            </x-slot:trigger>

                                            <x-slot:content>
                                                <div class="flex justify-center ">
                                                    <div
                                                        class="flex items-center justify-center text-red-500 bg-red-200 rounded-full shadow-sm w-28 h-28">
                                                        <x:component::icon.delete class="h-16" />
                                                    </div>
                                                </div>
                                                <div class="flex justify-center mt-7">
                                                    <h3 class="text-lg font-bold text-center text-gray-700">
                                                        {{ $value->name }} löschen?</h3>
                                                </div>
                                            </x-slot:content>

                                            <x-slot:controller>
                                                <button @click.prevent="modal=false" type="button"
                                                    class="flex justify-center w-full px-4 py-2 mr-2 font-medium text-center text-white bg-gray-300 border border-transparent rounded-md shadow-sm hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">Abbrechen</button>

                                                <button wire:click="delete({{ $value->id }})"
                                                    @click.prevent="modal=false" type="button"
                                                    class="flex justify-center w-full px-4 py-2 font-medium text-center text-white bg-red-500 border border-transparent rounded-md shadow-sm hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">löschen</button>
                                            </x-slot:controller>
                                        </x:component::element.modal>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        @if ($openEdit)
            @include('usermanager::livewire.user.edit')
        @endif

        <div class="mx-5 mt-14">
            {{ $content->links('livewire::tailwind') }}
        </div>
    </div>
</div>
