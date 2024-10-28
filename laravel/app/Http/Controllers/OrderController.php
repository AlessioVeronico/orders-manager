<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function list(Request $request)
    {
        try {
            $orders = OrderResource::collection(Order::with('products')->orderBy('created_at', 'DESC')->get());
            $res = [
                'code' => 200,
                'orders' => $orders
            ];

        } catch (\Exception $e) {
            $message = $e->getMessage();
            $res = [
                'code' => 400,
                'message' => $message
            ];
        }

        return response()->json($res);
    }

    public function filter(Request $request)
    {
        try {
            $filteredData = Order::query();

            if($request->input('name') !== null && $request->input('name') !== '' )
                $filteredData->where('name', 'ILIKE', '%' . $request->input('name') . '%');

            if($request->input('description') !== null && $request->input('description') !== '' )
                $filteredData->where('description', 'ILIKE', '%' . $request->input('description') . '%');

            if ($request->input('date') !== null)
                $filteredData->whereDate('date', $request->input('date'));

            $orders = OrderResource::collection($filteredData->with('products')->orderBy('created_at', 'DESC')->get());
            $res = [
                'code' => 200,
                'orders' => $orders
            ];
        } catch (\Exception $e) {
            $message = $e->getMessage();
            $res = [
                'code' => 400,
                'message' => $message
            ];
        }

        return response()->json($res);
    }

    public function save(Request $request)
    {
        try {
            $params = $request->input('params');

            if(isset($params['id'])) {
                $type = 'Updated';
                $order = Order::find($params['id']);
                $order->update($params);
            } else {
                $type = 'Created';
                $order = new Order;
                $order->fill($params);
                $order->save();
            }

            $order->products()->sync($params['selectedProductsIds']);

            $res = [
                'code' => 200,
                'message' => 'Order ' . $type,
                'id' => $order->id
            ];
        } catch(\Exception $e) {
            $message = $e->getMessage();
            $res = [
                'code' => 400,
                'message' => $message
            ];
        }

        return response()->json($res);
    }

    public function archive(Request $request, $id)
    {
        try {
            $order = Order::find($id);
            $order->products()->detach();
            $order->delete();

            $res = [
                'code' => 200,
                'message' => 'Order Deleted'
            ];

        } catch (\Exception $e) {
            $message = $e->getMessage();
            $res = [
                'code' => 400,
                'message' => $message
            ];
        }

        return response()->json($res);
    }
}
