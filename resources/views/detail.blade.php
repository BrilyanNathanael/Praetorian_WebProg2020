<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail</title>
    <link rel="stylesheet" href="/fontawesome/css/all.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="/css/detail.css">
</head>
<body>
    <section class="detail-page">
        <div class="header">
            <nav>
                <div class="nav-left">
                    <a href="/">
                        <h2>Mesunda</h2>
                    </a>
                </div>
                @auth
                <div class="nav-right">
                    <a href="/">Home</a>
                    <a href="/">Items</a>
                    <a href="cart">
                        Cart
                    </a>
                    <div class="dropdown">
                        <button class="drop-user">
                            {{Auth::user()->name}}
                            <i class="fas fa-chevron-down"></i>
                        </button>
                        <div class="drop-content">
                            <a href="/transaction">Transaction</a>
                            <a href="/logout">Logout</a>
                        </div>
                    </div>
                </div>
                @endauth
                @guest
                <div class="nav-right">
                    <a href="/login">Login</a>
                    <a href="/register">Register</a>
                </div>
                @endguest
            </nav>
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
                        <p>Name : {{$user->name}}</p>
                        <p>Email : {{$user->email}}</p>
                        <p>Phone Number : {{$user->phone_number}}</p>
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
                    <a href="/transaction">Back</a>
                </div>
            </div>
        </div>
        <div class="footer">
            <div class="footer-list">
                <div class="nav-footer">
                    <div class="nav-foot-left">
                        <a href="/">Home</a>
                        <a href="/">Items</a>
                    </div>
                    <div class="nav-foot-right">
                        <a href="/cart">Cart</a>
                        <a href="/transaction">Transactions</a>
                    </div>
                </div>
                <div class="contact">
                    <a href="https://www.instagram.com/">
                        <img src="/asset/instagram.png" alt="">
                    </a>
                    <a href="https://www.facebook.com/">
                        <img src="/asset/facebook.png" alt="">
                    </a>
                    <a href="https://www.whatsapp.com/">
                        <img src="/asset/whatsapp.png" alt="">
                    </a>
                </div>
            </div>
            <div class="foots">
                <h2>Mesunda</h2>
                <div class="foots-ident">
                    <p>&copy Web Programming Praetorian 2020</p>
                    <p>by Brilyan Nathanael R</p>
                </div>
            </div>
        </div>
    </section>
</body>
</html>