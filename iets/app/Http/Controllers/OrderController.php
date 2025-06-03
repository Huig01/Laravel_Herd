<?php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Products; // Assuming you have a Products model

class OrderController extends Controller
{
    // 📄 Lijst alle orders
    public function index()
    {
        $orders = Order::with(['customer', 'orderItems.product'])->get();
        return response()->json($orders);
    }

    public function create()
    {
        $products = Products::all();
        return view('Orders.CreateOrder', ['products' => $products]);
    }

    // 🆕 Nieuwe order aanmaken
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'order_date' => 'required|date',
            'status' => 'required|string',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.unit_price' => 'required|numeric|min:0',
        ]);

        DB::beginTransaction();

        try {
            $order = Order::create([
                'customer_id' => $validated['customer_id'],
                'order_date' => $validated['order_date'],
                'status' => $validated['status'],
            ]);

            foreach ($validated['items'] as $item) {
                $order->orderItems()->create($item);
            }

            DB::commit();

            return response()->json($order->load(['orderItems.product']), 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Failed to create order'], 500);
        }
    }

    // 🔍 Toon een specifieke order
    public function show($id)
    {
        $order = Order::with(['customer', 'orderItems.product'])->findOrFail($id);
        return response()->json($order);
    }

    // 🗑️ Verwijder een order
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return response()->json(['message' => 'Order deleted']);
    }
}
