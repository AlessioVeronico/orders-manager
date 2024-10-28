<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function list(Request $request)
    {
        try {
            $products = ProductResource::collection(Product::orderBy('created_at', 'DESC')->get());
            $res = [
                'code' => 200,
                'products' => $products
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
                $product = Product::find($params['id']);
                $product->update($params);
            } else {
                $type = 'Created';
                $product = new Product;
                $product->fill($params);
                $product->save();
            }

            $res = [
                'code' => 200,
                'message' => 'Product ' . $type,
                'id' => $product->id
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
            $product = Product::find($id);
            $product->orders()->detach();
            $product->delete();

            $res = [
                'code' => 200,
                'message' => 'Product Deleted'
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
