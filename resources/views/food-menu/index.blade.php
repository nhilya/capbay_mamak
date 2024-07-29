<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Food Menu') }}
        </h2>
    </x-slot>

    <style>
        .stretch-table th,
        .stretch-table td {
            width: 1%;
            white-space: nowrap;
        }
    </style>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (session('success'))
                        <div class="mb-4 text-green-500">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-medium text-gray-700">Food Menu</h3>
                        <a href="{{ route('food-menu.create') }}" class="bg-blue-500 text-gray-100 px-4 py-2 rounded">Add Menu</a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white border-collapse border stretch-table">
                            <thead class="bg-gray-200">
                                <tr>
                                    <th class="py-2 px-4 border-b border-gray-300 text-center">Code</th>
                                    <th class="py-2 px-4 border-b border-gray-300 text-center">Name</th>
                                    <th class="py-2 px-4 border-b border-gray-300 text-center">Description</th>
                                    <th class="py-2 px-4 border-b border-gray-300 text-center">Price</th>
                                    <th class="py-2 px-4 border-b border-gray-300 text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($foodMenus as $foodMenu)
                                    <tr class="bg-white">
                                        <td class="py-2 px-4 border-b border-gray-300 text-center">{{ $foodMenu->code }}</td>
                                        <td class="py-2 px-4 border-b border-gray-300 text-center">{{ $foodMenu->name }}</td>
                                        <td class="py-2 px-4 border-b border-gray-300 text-center">{{ $foodMenu->description }}</td>
                                        <td class="py-2 px-4 border-b border-gray-300 text-center">RM{{ $foodMenu->price }}</td>
                                        <td class="py-2 px-4 border-b border-gray-300 text-center">
                                            <a href="{{ route('food-menu.edit', $foodMenu->id) }}" class="bg-yellow-500 text-gray-100 px-2 py-1 rounded">Edit</a>
                                            <form action="{{ route('food-menu.destroy', $foodMenu->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-500 text-gray-100 px-2 py-1 rounded">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>