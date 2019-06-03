@extends('layouts.app')
@section('content')
    <h1>我的訂單<small>（共 {{$orders->total()}} 個訂單）</small></h1>
    @forelse($orders as $order)
        <div class="card @if($order->closed) border-secondary @else border-info @endif mb-3">
            <div class="card-header text-white @if($order->closed) bg-secondary @else bg-info @endif">
                訂單日期：{{ $order->created_at}}
                <span class="float-right">
                    訂單狀態：
                    @if($order->closed)
                        已完成
                    @else
                        處理中
                    @endif
                </span>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <tr>
                        <th colspan=2>商品名稱</th>
                        <th nowrap class="text-right">商品單價</th>
                        <th nowrap class="text-center">購買數量</th>
                        <th nowrap class="text-right">小計</th>
                    </tr>
                    @foreach($order->items as $item)
                        <tr>
                            <td>
                                <a target="_blank" href="/product/{{ $item->product_id }}">
                                    <img src="{{ $item->product->image_url }}" class="img-thumbnail" style="width: 120px;">
                                </a>
                            </td>
                            <td>
                                <a target="_blank" href="/product/{{ $item->product_id }}">
                                    <h5>{{ $item->product->title }}</h5>
                                </a>
                                @if(!$item->product->on_sale)
                                    <div class="warning">该商品已下架</div>
                                @endif
                            </td>
                            <td class="text-right">
                                {{ $item->product->price }} 元
                            </td>
                            <td class="text-center">
                                {{ $item->amount }}
                            </td>
                            <td class="text-right">
                                {{ $item->product->price * $item->amount }} 元
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <th colspan=5 class="text-right">
                            共計 {{ $order->total }} 元
                        </th>
                    </tr>
                </table>
            </div>
        </div>
    @empty
        <div class="alert alert-info">
            <h2>尚無訂單</h2>
        </div>
    @endforelse

    <div class="my-3">
        {{ $orders->links() }}
    </div>

@endsection
