@extends('layouts.admin')

@section('content')
    <div class="nav-left">
        <h2 style="color:white;">{{Auth::user()->name}}</h2>
        <div class="kotak" style="background-color:#cd000f;width:3em;height:.5em;border-radius:10px;margin-bottom:.5em;"></div>
        <a href="/" class="active">Dashboard</a>
        <a href="/admin/items">List Item</a>
        <a href="/admin/users">Users</a>
        <a href="/admin/sales">Sold Item</a>
        <a href="/admin/create">Create Item</a>
        <a href="/admin/category">Create Category</a>
    </div>
    <div class="content">
        <div class="welcoming">
            <h2>Welcome, Admin {{Auth::user()->name}}!</h2>
            <div class="ajakan">
                <p>Is there something new?</p>
                <div class="baru">
                    <a href="/admin/create">
                        <div class="barang">
                            Item
                        </div> 
                    </a>
                    <a href="/admin/category">
                        <div class="kategori">
                            Category
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="keterangan">
            <div class="list">
                <div class="list-info">
                    <h2>{{$users}}</h2>
                    <h4>Users</h4>
                </div>
                <img src="/asset/user.png" alt="" width="40px" height="40px">
            </div>
            <div class="list">
                <img src="/asset/cart-admin.png" alt="" width="40px" height="40px">
                <div class="list-info">
                    <h2>{{$items}}</h2>
                    <h4>Items</h4>
                </div>
            </div>
            <div class="list">
                <div class="list-info">
                    <h2>{{$order}}</h2>
                    <h4>Sold</h4>
                </div>
                <img src="/asset/sale.png" alt="" width="40px" height="40px">
            </div>
            <div class="list">
                <img src="/asset/wallet.png" alt="" width="40px" height="40px">
                <div class="list-info">
                    <h2>Rp {{number_format($fee,0,'.','.')}}</h2>
                    <h4>Income</h4>
                </div>
            </div>
        </div>
    </div>
@endsection