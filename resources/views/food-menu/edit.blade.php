<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Food Menu Item') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if ($errors->any())
                        <div class="mb-4 text-red-500">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('food-menu.update', $foodMenu->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="code" class="block text-gray-700">Code</label>
                            <input type="text" name="code" id="code" value="{{ $foodMenu->code }}" class="mt-1 block w-full" required>
                        </div>
                        <div class="mb-4">
                            <label for="name" class="block text-gray-700">Name</label>
                            <input type="text" name="name" id="name" value="{{ $foodMenu->name }}" class="mt-1 block w-full" required>
                        </div>
                        <div class="mb-4">
                            <label for="description" class="block text-gray-700">Description</label>
                            <textarea name="description" id="description" class="mt-1 block w-full">{{ $foodMenu->description }}</textarea>
                        </div>
                        <div class="mb-4">
                            <label for="price" class="block text-gray-700">Price</label>
                            <input type="number" name="price" id="price" value="{{ $foodMenu->price }}" class="mt-1 block w-full" step="0.01" required>
                        </div>
                        <div class="flex justify-center">
                            <button type="submit" class="bg-blue-500 text-gray-100 px-4 py-2 rounded">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>