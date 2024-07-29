<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Welcome, ') . Auth::user()->name . '!' }}
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
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-medium text-gray-700">Order History</h3>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white border-collapse border stretch-table">
                            <thead class="bg-gray-200">
                                <tr>
                                    <th class="py-2 px-4 border-b border-gray-300 text-center">Order ID</th>
                                    <th class="py-2 px-4 border-b border-gray-300 text-center">Items</th>
                                    <th class="py-2 px-4 border-b border-gray-300 text-center">Total Price</th>
                                    <th class="py-2 px-4 border-b border-gray-300 text-center">Order Date</th>
                                    <th class="py-2 px-4 border-b border-gray-300 text-center">Status</th>
                                    <th class="py-2 px-4 border-b border-gray-300 text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                    <tr>
                                        <td class="py-2 px-4 border-b border-gray-300 text-center">{{ $order->id }}</td>
                                        <td class="py-2 px-4 border-b border-gray-300">
                                            @foreach($order->orderItems as $orderItem)
                                                <div class="mb-2">
                                                    <strong>{{ $orderItem->foodMenu->name }}</strong><br>
                                                    Quantity: {{ $orderItem->quantity }}<br>
                                                    Price: RM {{ $orderItem->price }}
                                                </div>
                                            @endforeach
                                        </td>
                                        <td class="py-2 px-4 border-b border-gray-300 text-center">RM {{ $order->total_price }}</td>
                                        <td class="py-2 px-4 border-b border-gray-300 text-center">{{ $order->created_at->format('Y-m-d H:i') }}</td>
                                        <td class="py-2 px-4 border-b border-gray-300 text-center">{{ $order->status }}</td>
                                        <td class="py-2 px-4 border-b border-gray-300 text-center">
                                            <form action="{{ route('orders.updateStatus', $order->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <select name="status" class="rounded">
                                                    <option value="Pending" {{ $order->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                                    <option value="Completed" {{ $order->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                                                </select>
                                                <button type="submit" class="bg-blue-500 text-gray-100 px-2 py-1 rounded">Update</button>
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