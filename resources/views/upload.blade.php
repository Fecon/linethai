<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Upload Images') }}
        </h2>
    </x-slot>

    @include('images.upload')
</x-app-layout>