<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Order Details') }}
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

                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white border-collapse border stretch-table">
                            <thead class="bg-gray-200">
                                <tr>
                                    <th class="py-2 px-4 border-b border-gray-300 text-center">Name</th>
                                    <th class="py-2 px-4 border-b border-gray-300 text-center">Description</th>
                                    <th class="py-2 px-4 border-b border-gray-300 text-center">Quantity</th>
                                    <th class="py-2 px-4 border-b border-gray-300 text-center">Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->orderItems as $orderItem)
                                    <tr class="bg-white">
                                        <td class="py-2 px-4 border-b border-gray-300 text-center">{{ $orderItem->foodMenu->name }}</td>
                                        <td class="py-2 px-4 border-b border-gray-300 text-center">{{ $orderItem->foodMenu->description }}</td>
                                        <td class="py-2 px-4 border-b border-gray-300 text-center">{{ $orderItem->quantity }}</td>
                                        <td class="py-2 px-4 border-b border-gray-300 text-center">RM {{ $orderItem->price }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4 flex justify-between">
                        <a href="{{ route('dashboard') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Back to Order History</a>
                        <strong>Total Price: RM {{ $order->total_price }}</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>