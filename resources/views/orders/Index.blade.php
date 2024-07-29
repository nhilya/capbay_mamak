<!DOCTYPE html>
<html>
<head>
    <title>Order History</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <style>
        .order-table {
            width: 100%;
            border-collapse: collapse;
        }
        .order-table th, .order-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        .order-table th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto mt-10">
        <h1 class="text-center text-3xl font-bold mb-10">Order History</h1>

        @if (session('success'))
            <div class="mb-4 text-green-500">
                {{ session('success') }}
            </div>
        @endif

        <table class="order-table">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Item Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total Price</th>
                    <th>Order Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    @foreach($order->orderItems as $orderItem)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $orderItem->foodMenu->name }}</td>
                            <td>{{ $orderItem->quantity }}</td>
                            <td>${{ $orderItem->price }}</td>
                            <td>${{ $order->total_price }}</td>
                            <td>{{ $order->created_at->format('Y-m-d H:i') }}</td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>