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
    <div class="content-barang">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Invoice</th>
                    <th scope="col">Date</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Price</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach($groupInvoice as $invoice => $invoices)
                <?php $totalQuantity = 0; ?>
                <?php $totalPrice = 0; ?>
                @foreach($invoices as $i)
                    <?php $totalQuantity = $totalQuantity + $i->quantity; ?>
                    <?php $totalPrice = $totalPrice + ($i->price * $i->quantity); ?>
                @endforeach
    
                @foreach($invoices as $i)
                    <tr>
                        <td>{{$i->order_id}}</td>
                        <td>{{$i->created_at->format('d-m-Y')}}</td>
                        <td>{{$totalQuantity}}</td>
                        <td>Rp {{number_format($totalPrice,0,'.','.')}}</td>
                        <td class="aksi">
                            <a href="/admin/detail-order/{{$i->id}}">Detail</a>
                        </td>
                    </tr>
                    @break
                @endforeach
            @endforeach
            </tbody>
        </table>
    </div>
@endsection