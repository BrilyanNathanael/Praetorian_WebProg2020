<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/fontawesome/css/all.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/transaction.css">
    <title>Transaction</title>
</head>
<body>
    <section class="transaction-page">
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
        <div class="transaction-orders">
            @if($transaction == 0)
            <div class="no-trans">
                <img src="/asset/null-1.png" alt="" width="300px">
                <p>Looks like you don't have a transaction history...</p>
            </div>
            @else
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Invoice</th>
                        <th scope="col">Date</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Price</th>
                        <th scope="col" style="display:flex;justify-content:center;">Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($groupInvoice as $invoice => $invoices)
                    <?php $items = 0; ?>
                    <?php $prc = 0; ?>
                    @foreach($invoices as $i)
                        @if($i->user_id == $user->id)
                            <?php $items = $items + $i->quantity; ?>
                            <?php $prc = $prc + ($i->price * $i->quantity); ?>
                        @endif
                    @endforeach
    
                    @foreach($invoices as $i)
                        @if($i->user_id == $user->id)
                            <tr>
                                <td>{{$i->order_id}}</td>
                                <td>{{$i->created_at->format('Y-m-d')}}</td>
                                <td>{{$items}}</td>
                                <td>Rp {{number_format($prc,0,'.','.')}}</td>
                                <td class="aksi">
                                    <a href="/detail/{{$i->id}}">Detail</a>
                                </td>
                            </tr>
                        @endif
                        @break
                    @endforeach
                @endforeach
                </tbody>
            </table>
            @endif
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