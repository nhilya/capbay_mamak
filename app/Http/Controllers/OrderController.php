<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\FoodMenu;
use Illuminate\Http\Request;
use App\Services\PricingRulesService;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('orderItems.foodMenu')->get();
        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        $foodMenus = FoodMenu::all();
        return view('orders.create', compact('foodMenus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'food_menu_id' => 'required|array',
            'food_menu_id.*' => 'exists:food_menus,id',
            'quantity' => 'required|array',
            'quantity.*' => 'required|integer|min:1',
        ]);

        $pricingRules = new PricingRulesService();

        foreach ($request->food_menu_id as $index => $foodMenuId) {
            $foodMenu = FoodMenu::findOrFail($foodMenuId);
            for ($i = 0; $i < $request->quantity[$index]; $i++) {
                $pricingRules->scan($foodMenu);
            }
        }

        $totalPrice = $pricingRules->total();

        $order = Order::create(['total_price' => $totalPrice]);

        foreach ($request->food_menu_id as $index => $foodMenuId) {
            $quantity = $request->quantity[$index];
            $price = FoodMenu::find($foodMenuId)->price;

            OrderItem::create([
                'order_id' => $order->id,
                'food_menu_id' => $foodMenuId,
                'quantity' => $quantity,
                'price' => $price,
            ]);
        }

        return redirect()->route('orders.show', $order->id)->with('success', 'Order placed successfully!');
    }

    public function show($id)
    {
        $order = Order::with('orderItems.foodMenu')->findOrFail($id);
        return view('orders.show', compact('order'));
    }

    public function edit(Order $order)
    {
    }

    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->update(['status' => $request->input('status')]);

        return redirect()->route('dashboard')->with('success', 'Order status updated successfully!');
    }

    public function update(Request $request, Order $order)
    {
    }

    public function destroy(Order $order)
    {
    }
}