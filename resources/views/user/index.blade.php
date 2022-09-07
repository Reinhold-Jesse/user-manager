<x:component::layouts.dashboard>
    <x-slot name="header">
        <h2 class="font-semibold leading-tight">
            {{ __('User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container px-3 py-12 mx-auto">
            @livewire('user.index')
        </div>
    </div>
</x:component::layouts.dashboard>
