<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\JsonResponse;

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
}
