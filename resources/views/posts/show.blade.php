<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $post->title }}
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <img src="{{ asset('storage/'. $post->image) }}" alt="" srcset="" width="100px" height="100px">
        <p>{{ $post->content }}</p>
    </div>
</x-app-layout>
