<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class Order2Controller extends Controller
{
    public function index()
    {
        $orders = Order::all();
 
        return response()->json([
            'success' => true,
            'data' => $orders
        ]);
    }
 
    public function show($id)
    {
        $order = Order::findById($id);
 
        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Order not found '
            ], 400);
        }
 
        return response()->json([
            'success' => true,
            'data' => $order->toArray()
        ], 400);
    }
 
    public function store(Request $request)
    {
        $this->validate($request, [
            'book_id' => 'required',
        ]);
 
        $order = new Order();
        $order->book_id = $request->book_id;
        $order->user_id = auth()->user()->id;
        $order->status = 'Submitted';

        if ($order->save()) {
            return response()->json([
                'success' => true,
                'data' => $order,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Post not added'
            ], 500);
        }
            
    }
 
    public function update(Request $request, $id)
    {
        // $post = auth()->user()->posts()->find($id);
 
        // if (!$post) {
        //     return response()->json([
        //         'success' => false,
        //         'message' => 'Post not found'
        //     ], 400);
        // }
 
        // $updated = $post->fill($request->all())->save();
 
        // if ($updated)
        //     return response()->json([
        //         'success' => true
        //     ]);
        // else
        //     return response()->json([
        //         'success' => false,
        //         'message' => 'Post can not be updated'
        //     ], 500);
    }
 
    public function destroy($id)
    {
        // $post = auth()->user()->posts()->find($id);
 
        // if (!$post) {
        //     return response()->json([
        //         'success' => false,
        //         'message' => 'Post not found'
        //     ], 400);
        // }
 
        // if ($post->delete()) {
        //     return response()->json([
        //         'success' => true
        //     ]);
        // } else {
        //     return response()->json([
        //         'success' => false,
        //         'message' => 'Post can not be deleted'
        //     ], 500);
        // }
    }

    public function listSubmitted()
    {
        $orders = Order::latest()->paginate(5);
 
        return view('orders.index',compact('orders'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
}
