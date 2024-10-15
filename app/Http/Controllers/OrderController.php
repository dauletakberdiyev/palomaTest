<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderCreateRequest;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

final class OrderController extends Controller
{
    public function index(): JsonResponse
    {
        $orders = Order::all()->load('place');

        return response()->json([
            'message' => 'All orders retrieved successfully.',
            'data' => $orders
        ]);
    }

    public function show(Order $order): JsonResponse
    {
        return response()->json([
            'message' => 'Order retrieved successfully.',
            'data' => $order->load(['place', 'orderDetails.product:id,title'])
        ]);
    }

    public function create(OrderCreateRequest $request): JsonResponse
    {
        $dto = $request->getDTO();

        $order = DB::transaction(function () use ($dto) {
            $order = new Order();
            $order->place_id = $dto->placeId;

            $totalCost = 0;
            foreach ($dto->products as $product)
            {
                $prod = Product::find($product['product_id']);
                $totalCost += $product['quantity'] * $prod->price;
            }
            $order->total_cost = $totalCost;

            $order->save();

            foreach ($dto->products as $product)
            {
                $orderDetail = new OrderDetails();
                $orderDetail->order_id = $order->id;
                $orderDetail->product_id = $product['product_id'];
                $orderDetail->quantity = $product['quantity'];

                $prod = Product::find($product['product_id']);
                $orderDetail->sum = $prod->price * $product['quantity'];

                $orderDetail->save();
            }

            return $order;
        });

        return response()->json([
            'message' => 'Order created successfully.',
            'data' => $order
        ]);
    }
}
