@extends('layouts.admin')

@section('content')
    <div class="nav-left">
        <h2 style="color:white;">{{Auth::user()->name}}</h2>
        <div class="kotak" style="background-color:#cd000f;width:3em;height:.5em;border-radius:10px;margin-bottom:.5em;"></div>
        <a href="/">Dashboard</a>
        <a href="/admin/items">List Item</a>
        <a href="/admin/users">Users</a>
        <a href="/admin/sales" class="active">Sold Item</a>
        <a href="/admin/create">Create Item</a>
        <a href="/admin/category">Create Category</a>
    </div>
    <div class="transaksi-content">
            <div class="transaksi-all">
                <div class="orders">
                    <h3>{{$order->order_id}}</h3>
                    <p>{{$order->created_at->format('d-m-Y')}}</p>
                </div>
                <hr>
                <div class="transaksi-list">
                    <div class="transaksi-left">
                        <p>Name : {{$customer->name}}</p>
                        <p>Email : {{$customer->email}}</p>
                        <p>Phone Number : {{$customer->phone_number}}</p>
                    </div>
                    <div class="transaksi-right">
                        <p>Address : {{$order->address}}</p>
                        <p>Postal Code : {{$order->pos}}</p>
                        <p>Total Items : {{$totalItems}}</p>
                    </div>
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Category</th>
                            <th scope="col">Name</th>
                            <th scope="col">Total Items</th>
                            <th scope="col">Total Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $o)
                        <tr>
                            <th scope="row">{{$loop->iteration}}</th>
                            <td>{{$o->category}}</td>
                            <td>{{$o->name}}</td>
                            <td>{{$o->quantity}}</td>
                            <td>Rp {{number_format($o->price * $o->quantity,0,'.','.')}}</td>
                        </tr>
                        @endforeach
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><strong>Total</strong></td>
                            <td>Rp {{number_format($totalPrice,0,'.','.')}}</td>
                        </tr>
                    </tbody>
                </table>
                <div class="transaksi-aksi">
                    <a href="/admin/sales">Back</a>
                </div>
            </div>
        </div>
@endsection