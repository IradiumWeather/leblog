<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __("Créer un post") }}
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="my-5">
            @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="block text-red-500">{{ $error }}</div>
            @endforeach
        @endif
        </div>
        <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data" class="mt-10">
            @csrf
            <x-label for="title" value="Le titre du post" />
            <x-input id="title" name="title" placeholder=""/>

            <x-label for="content" value="Contenu du post" />
            <textarea name="content" id="content" cols="30" rows="10">
            </textarea>

            <x-label for="image" value="image du post" />
            <x-input id="image" type="file" name="image" placeholder=""/>

            <x-label for="categorie" value="Categorie" />
            <select name="categorie" id="categorie">
                @foreach ($categorys as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>

            <x-button style="display: block !important;" class="mt-5"> Créer mon post</x-button>
        </form>
    </div>
</x-app-layout>
