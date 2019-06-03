<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderItem;
use App\Product;
use DB;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $user = $request->user();
        // 開啟一個資料庫交易
        DB::transaction(function () use ($user, $request) {
            // 建立一個訂單
            $order = new Order;
            $order->address = $request->address;
            $order->total = 0;
            $order->closed = 0;
            $order->user_id = $user->id;
            $order->save();

            $total = 0;
            // 計算所有購物車內容的數量及價格
            foreach ($request->amount as $product_id => $amount) {
                $product = Product::find($product_id);
                $item = new OrderItem;
                $item->order_id = $order->id;
                $item->product_id = $product_id;
                $item->amount = $amount;
                $item->price = $product->price;
                $item->save();
                $total += $product->price * $amount;
            }

            // 更新訂單總金額
            $order->update(['total' => $total]);

            // 將下單的商品從購物車中移除
            $user->carts()->delete();
        });

        return redirect()->route('index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
