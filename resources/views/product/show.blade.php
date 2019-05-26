@extends('layouts.app') 
@section('title', $product->title) 
@section('content')
    <div class="card">
        <div class="card-body product-info">
            <div class="row">
                <div class="col-sm-5">
                    <img class="img-fluid" src="{{ $product->image_url }}" alt="{{ $product->title }}">
                </div>
                <div class="col-sm-7">
                    <div class="h2">{{ $product->title }}</div>
                    <div class="h3">特價 {{ $product->price }}元</div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">數量</span>
                        </div>
                        <input type="text" class="form-control input-sm" value="1">
                        <div class="input-group-append">
                            <span class="input-group-text">件</span>
                        </div>
                        <div class="input-group-append">
                            <button class="btn btn-primary btn-add-to-cart">加入購物車</button>
                        </div>
                    </div>                        
                    {!! $product->description !!}
                </div>
            </div>
        </div>
    </div>
@endsection