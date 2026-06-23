@extends('layouts.app')
@section('title', $viewData['title'])
@section('subtitle', $viewData['subtitle'])
@section('content')
    @forelse ($viewData["orders"] as $order)
        <div class="card mb-4">
            <div class="card-header">
                Order #{{ $order->id }} {{-- getId() → id --}}
            </div>
            <div class="card-body">
                <b>Date:</b> {{ $order->created_at }}<br /> {{-- getCreatedAt() → created_at --}}
                <b>Total:</b> ${{ $order->total }}<br /> {{-- getTotal() → total --}}
                <table class="table table-bordered table-striped text-center mt-3">
                    <thead>
                        <tr>
                            <th scope="col">Item ID</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->items as $item) {{-- getItems() → items --}}
                            <tr>
                                <td>{{ $item->id }}</td> {{-- getId() → id --}}
                                <td>
                                    <a class="link-success" href="{{ route('product.show', ['id' => $item->product->id]) }}">
                                        {{-- getProduct()->getId() → product->id --}}
                                        {{ $item->product->name }} {{-- getName() → name --}}
