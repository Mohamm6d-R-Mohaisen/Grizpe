<!DOCTYPE html>
<html>
<head>
    <style>
        .order-table { border-collapse: collapse; width: 100%; }
        .order-table th, .order-table td { padding: 8px; text-align: left; }
        .border-b { border-bottom: 1px solid #e2e8f0; }
        .text-red-500 { color: #ef4444; }
    </style>
</head>
<body>
    <div class="lg:max-w-2xl mx-auto bg-white rounded-lg shadow-sm">
        <div class="p-6">
            <h2 class="text-xl font-bold mb-4">Your Order Summary #{{ $order->id }}</h2>
            <div class="border-b border-blue-500" style="width: 100%; height: 2px;"></div>
            <table class="w-full order-table">
                <thead>
                    <tr class="border-b">
                        <th>Product</th>
                        <th>Details</th>
                        <th>Qty</th>
                        <th class="text-right">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->products as $product)
                    <tr class="border-b">
                        <td>{{ $product->name }}</td>
                        <td class="details-cell">
                            @foreach($attributes as $key => $value)
                                {{ $key }}: 
                                {{ $value }}<br>
                            @endforeach
                        </td>
                        <td>{{ $product->quantity }}</td>
                        <td class="text-right text-red-500">${{ number_format($product->price * $product->quantity, 2) }}</td>
                    </tr>
                    @endforeach
                    <tr class="border-b">
                        <td colspan="3" class="font-medium">Subtotal:</td>
                        <td class="text-right text-red-500">${{ number_format($order->subtotal, 2) }}</td>
                    </tr>
                    <tr>
                        <td colspan="3" class="font-medium">Total:</td>
                        <td class="text-right text-red-500">${{ number_format($order->total, 2) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>