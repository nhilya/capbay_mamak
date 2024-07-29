<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Take Order') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (session('success'))
                        <div class="mb-4 text-green-500">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="mb-4">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li class="text-red-500">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form id="orderForm" action="{{ route('orders.store') }}" method="POST">
                        @csrf
                        <table class="w-full mb-4">
                            <thead>
                                <tr>
                                    <th class="text-center p-2">Select</th>
                                    <th class="text-center p-2">Food Item</th>
                                    <th class="text-center p-2">Quantity</th>
                                    <th class="text-center p-2">Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($foodMenus as $foodMenu)
                                    <tr>
                                        <td class="text-center p-2">
                                            <input type="checkbox" name="food_menu_id[]" value="{{ $foodMenu->id }}" class="food-item-checkbox">
                                        </td>
                                        <td class="text-center p-2">{{ $foodMenu->name }}</td>
                                        <td class="text-center p-2">
                                            <input type="number" name="quantity[]" class="w-full quantity-input" min="1" value="1" disabled>
                                        </td>
                                        <td class="text-center p-2">RM {{ $foodMenu->price }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="flex justify-end mb-4">
                            <strong>Total Price: RM <span id="totalPrice">0.00</span></strong>
                        </div>
                        <div class="flex justify-end">
                            <button type="submit" class="bg-blue-500 text-gray-100 px-4 py-2 rounded">Place Order</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('orderForm');
            const checkboxes = document.querySelectorAll('.food-item-checkbox');
            const quantityInputs = document.querySelectorAll('.quantity-input');
            const totalPriceElement = document.getElementById('totalPrice');
            checkboxes.forEach((checkbox, index) => {
                checkbox.addEventListener('change', () => {
                    quantityInputs[index].disabled = !checkbox.checked;
                    updateTotalPrice();
                });
            });
            quantityInputs.forEach(input => {
                input.addEventListener('input', updateTotalPrice);
            });
            form.addEventListener('submit', function (event) {
                checkboxes.forEach((checkbox, index) => {
                    if (!checkbox.checked) {
                        checkbox.remove();
                        quantityInputs[index].remove();
                    }
                });
            });
            function updateTotalPrice() {
                let totalPrice = 0;
                checkboxes.forEach((checkbox, index) => {
                    if (checkbox.checked) {
                        const price = parseFloat(checkbox.closest('tr').querySelector('td:last-child').innerText.replace('RM ', ''));
                        const quantity = parseInt(quantityInputs[index].value);
                        totalPrice += price * quantity;
                    }
                });
                totalPriceElement.innerText = totalPrice.toFixed(2);
            }
        });
    </script>
</x-app-layout>